<?php

namespace App\Http\Livewire\Articles;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\ArticleCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Article;

class AddArticles extends Component
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
    public $articles_categories;
    public $selected = 1;
    public $transLiterate;
    public $content;

    protected $rules = [
        'title' => 'required',
    ];

    public function mount(){
        $this->articles_categories=ArticleCategory::all();
    }
    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);

    }

    public function handleBottomBack(){
        return redirect()->route('articles.show');
    }

    public function submit(){ //Добавление

        $this->validate();
        if($this->image) (new UpLoadImage)->upLoadImage('public/image/articles', $this->transLiterate['file_name'], $this->image);
        foreach ($this->articles_categories as $item ){
            if ($item->id == $this->selected){
                $this->link=$item->link.$this->link;
            }
        }
        Article::create([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => ($this->image)?$this->transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():'',
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => ($this->description)?:$this->title,
            'keywords' => ($this->keywords)?:$this->title,
            'category_id' => $this->selected,
            'link' => '/sorti-vinogradu'.$this->link,
            'content' => $this->content,

        ]);
        return redirect()->route('articles.show');
    }
    public function render()
    {
        return view('articles.add-articles')->layout('layouts.admin');
    }
}
