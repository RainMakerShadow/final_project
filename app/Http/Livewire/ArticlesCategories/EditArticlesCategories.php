<?php

namespace App\Http\Livewire\ArticlesCategories;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\ArticleCategory;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditArticlesCategories extends Component
{
    use WithFileUploads;

    public $articles_categories;
    public $articles_categories_id;
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
        $this->articles_categories_id=$id;
        $this->articles_categories = ArticleCategory::find($id);
        $this->menu=Menu::all();
        $this->title = $this->articles_categories->title;
        $this->img_title = $this->articles_categories->img_title;
        $this->img_alt = $this->articles_categories->img_alt;
        $this->img_descr = $this->articles_categories->img_descr;
        $this->description = $this->articles_categories->description;
        $this->keywords = $this->articles_categories->keywords;
        $this->menu_id = $this->articles_categories->menus_id;
        $this->link = $this->articles_categories->link;
        $this->image = $this->articles_categories->img;
        $this->imageUrl=Storage::url('image/articles-categories/'.$this->articles_categories->img);
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
        $this->image->storeAs('public/image/articles-categories', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл
    }

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }

    public function submit()
    {

        $this->validate();
        $transLiterate= (new Transliterate)->transLiterate($this->title);
        $articles_categories=ArticleCategory::find($this->articles_categories_id);

        if(is_object($this->image)){
            $this->validate([
                'image' => 'required|file|max:4096',
            ]);
            (new UpLoadImage)->UpLoadImage('public/image/articles-categories', $transLiterate['file_name'], $this->image);
        }
        $articles_categories->update([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => (is_object($this->image))?$transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():$articles_categories->img,
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'link' => $this->link

        ]);
        $articles_categories->menus_id=$this->selected;
        $articles_categories->save();
        return redirect()->route('articles-categories.show');
    }

    public function render()
    {
        $articles_categories=$this->articles_categories;
        $menu=$this->menu;
        return view('articles-categories.edit-articles-categories', compact('articles_categories', 'menu'));
    }
}
