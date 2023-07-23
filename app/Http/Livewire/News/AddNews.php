<?php

namespace App\Http\Livewire\News;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\NewsCategory;
use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddNews extends Component
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
    public $news_categories;
    public $selected = 1;
    public $transLiterate;
    public $content;

    protected $rules = [
        'title' => 'required',
    ];

    public function mount(){
        $this->news_categories=NewsCategory::all();
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
        if($this->image) (new UpLoadImage)->upLoadImage('public/image/news', $this->transLiterate['file_name'], $this->image);
        foreach ($this->news_categories as $item ){
            if ($item->id == $this->selected){
                $this->link=$item->link.$this->link;
            }
        }
        News::create([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => ($this->image)?$this->transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():'',
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => ($this->description)?:$this->title,
            'keywords' => ($this->keywords)?:$this->title,
            'category_id' => $this->selected,
            'link' => $this->link,
            'content' => $this->content,

        ]);
        return redirect()->route('news.show');
    }
    public function render()
    {
        return view('news.add-news')->layout('layouts.admin');
    }
}
