<?php

namespace App\Http\Livewire\NewsCategories;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\Menu;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditNewsCategories extends Component
{
    use WithFileUploads;

    public $news_categories;
    public $news_categories_id;
    public $title;
    public $image;
    public $imageUrl;
    public $img_title;
    public $img_alt;
    public $img_descr;
    public $description;
    public $keywords;
    public $menu_id;
    public $link;
    public $menu;
    public $selected;
    public $img_file_name;
    public $transLiterate;




    public function mount($id){
        $this->news_categories_id=$id;
        $this->news_categories = NewsCategory::find($id);
        $this->menu=Menu::all();
        $this->title = $this->news_categories->title;
        $this->img_title = $this->news_categories->img_title;
        $this->img_alt = $this->news_categories->img_alt;
        $this->img_descr = $this->news_categories->img_descr;
        $this->description = $this->news_categories->description;
        $this->keywords = $this->news_categories->keywords;
        $this->menu_id = $this->news_categories->menus_id;
        $this->link = $this->news_categories->link;
        $this->image = $this->news_categories->img;
        $this->imageUrl=Storage::url('image/news-categories/'.$this->news_categories->img);
        if(count($this->menu)<$this->menu_id){
            $this->selected=1;
        }
        else{
            $this->selected=$this->menu_id;
        }

    }

    protected $rules = [
        'title' => 'required',
    ];

    public function upLoadImage() //Сохранение файла на сервер
    {
        $this->image->storeAs('public/image/news-categories', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл
    }

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }

    public function submit()
    {

        $this->validate();
        $transLiterate= (new Transliterate)->transLiterate($this->title);
        $news_category=NewsCategory::find($this->news_categories_id);

        if(is_object($this->image)){
            $this->validate([
                'image' => 'required|file|max:4096',
            ]);
            (new UpLoadImage)->UpLoadImage('public/image/products-categories', $transLiterate['file_name'], $this->image);
        }
        $news_category->update([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => (is_object($this->image))?$transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():$news_category->img,
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'link' => $this->link

        ]);
        $news_category->menus_id=$this->selected;
        $news_category->save();
        return redirect()->route('news-categories.show');
    }

    public function render()
    {
        $news_categories=$this->news_categories;
        $menu=$this->menu;
        return view('news-categories.show-news-categories', compact('news_categories', 'menu'));
    }
}
