<?php

namespace App\Http\Livewire\ArticlesCategories;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\ArticleCategory;
use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;


class AddArticlesCategories extends Component
{

    use WithFileUploads;

    public $title;
    public $image;
    public $imageUrl;
    public $img_title;
    public $img_alt;
    public $img_descr;
    public $description;
    public $keywords;
    public $link;
    public $menu;
    public $selected = 1;
    public $transLiterate;

    protected $rules = [
        'title' => 'required',
    ];

    public function mount(){
        $this->menu=Menu::all();
    }
    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link=strtolower($this->transLiterate['file_name']);

    }

    public function handleBottomBack(){
        return redirect()->route('articles-categories.show');
    }

    public function submit(){ //Добавление

        $this->validate();
        if($this->image) (new UpLoadImage)->upLoadImage('public/image/articles-categories', $this->transLiterate['file_name'], $this->image);

        ArticleCategory::create([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => ($this->image)?$this->transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():'',
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => ($this->description)?:$this->title,
            'keywords' => ($this->keywords)?:$this->title,
            'menus_id' => $this->selected,
            'link' => $this->link,

        ]);
        return redirect()->route('articles-categories.show');
    }
    public function render()
    {
        $menu=$this->menu;
        return view('articles-categories.add-articles-categories', compact('menu'))->layout('layouts.admin');
    }
}
