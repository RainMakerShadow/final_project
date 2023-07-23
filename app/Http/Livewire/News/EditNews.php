<?php

namespace App\Http\Livewire\News;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditNews extends Component
{
    use WithFileUploads;

    public $news_categories;
    public $news_id;
    public $news;
    public $category_selected;
    public $category;
    public $content;


    public $title;
    public $image;
    public $imageUrl;
    public $img_title;
    public $img_alt;
    public $img_descr;
    public $description;
    public $keywords;
    public $link;
    public $img_file_name;
    public $transLiterate;




    public function mount($id){
        $this->news_id=$id;
        $this->news = News::find($id);
        $this->category_selected = NewsCategory::all();

        $this->title = $this->news->title;
        $this->img_title = $this->news->img_title;
        $this->img_alt = $this->news->img_alt;
        $this->img_descr = $this->news->img_descr;
        $this->description = $this->news->description;
        $this->keywords = $this->news->keywords;
        $this->link = $this->news->link;
        $this->image = $this->news->img;
        $this->category=$this->news->category_id;
        $this->content=$this->news->content;
        $this->imageUrl=Storage::url('image/news/'.$this->news->img);
        foreach ($this->category_selected as $category){
            if($category->id == $this->news->category_id){
                $this->category=$category->id;
            }
        }

    }

    protected $rules = [
        'title' => 'required',
    ];

    public function upLoadImage() //Сохранение файла на сервер
    {
        $this->image->storeAs('public/image/news', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл
    }

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }

    public function handleBottomBack(){
        return redirect()->route('news.show');
    }

    public function submit()
    {

        $this->validate();
        $transLiterate= (new Transliterate)->transLiterate($this->title);
        $article=News::find($this->news_id);

        if(is_object($this->image)){
            $this->validate([
                'image' => 'required|file|max:4096',
            ]);
            (new UpLoadImage)->UpLoadImage('public/image/articles-categories', $transLiterate['file_name'], $this->image);
        }
        foreach ($this->category_selected as $item ){
            if ($item->id == $this->category){
                $this->link=$item->link.'/'.$transLiterate['file_name'];
            }
        }

        $article->update([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => (is_object($this->image))?$transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():$article->img,
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => ($this->description)?:$this->title,
            'keywords' => ($this->keywords)?:$this->title,
            'link' =>$this->link,
            'content' => $this->content,

        ]);
        $article->category_id=$this->category;
        $article->save();
        return redirect()->route('news.show');
    }
    public function render()
    {
        return view('news.edit-news')->layout('layouts.admin');
    }
}
