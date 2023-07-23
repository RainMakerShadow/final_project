<?php

namespace App\Http\Livewire\Articles;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Symfony\Component\Translation\t;

class EditArticles extends Component
{
    use WithFileUploads;

    public $articles_categories;
    public $article_id;
    public $article;
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
        $this->article_id=$id;
        $this->article = Article::find($id);
        $this->category_selected = ArticleCategory::all();

        $this->title = $this->article->title;
        $this->img_title = $this->article->img_title;
        $this->img_alt = $this->article->img_alt;
        $this->img_descr = $this->article->img_descr;
        $this->description = $this->article->description;
        $this->keywords = $this->article->keywords;
        $this->link = $this->article->link;
        $this->image = $this->article->img;
        $this->category=$this->article->category_id;
        $this->content=$this->article->content;
        $this->imageUrl=Storage::url('image/articles/'.$this->article->img);
        foreach ($this->category_selected as $category){
            if($category->id == $this->article->category_id){
                $this->category=$category->id;
            }
        }

    }

    protected $rules = [
        'title' => 'required',
    ];

    public function upLoadImage() //Сохранение файла на сервер
    {
        $this->image->storeAs('public/image/articles', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл
    }

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }

    public function handleBottomBack(){
        return redirect()->route('articles.show');
    }

    public function submit()
    {

        $this->validate();
        $transLiterate= (new Transliterate)->transLiterate($this->title);
        $article=Article::find($this->article_id);

        if(is_object($this->image)){
            $this->validate([
                'image' => 'required|file|max:4096',
            ]);
            (new UpLoadImage)->UpLoadImage('public/image/articles', $transLiterate['file_name'], $this->image);
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
        return redirect()->route('articles.show');
    }

    public function render()
    {
        return view('articles.edit-articles')->layout('layouts.admin');
    }
}
