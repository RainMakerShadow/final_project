<?php

namespace App\Http\Livewire\GrapeSort;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\GrapesSort;

class Edit extends Component
{
    use WithFileUploads;

    public $grape_id;
    public $grape;
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
        $this->grape_id=$id;
        $this->grape = GrapesSort::find($id);

        $this->title = $this->grape->title;
        $this->img_title = $this->grape->img_title;
        $this->img_alt = $this->grape->img_alt;
        $this->img_descr = $this->grape->img_descr;
        $this->description = $this->grape->description;
        $this->keywords = $this->grape->keywords;
        $this->link = $this->grape->link;
        $this->image = $this->grape->img;
        $this->content=$this->grape->content;
        $this->imageUrl=Storage::url('image/grapes/'.$this->grape->img);

    }

    protected $rules = [
        'title' => 'required',
    ];

    public function upLoadImage() //Сохранение файла на сервер
    {
        $this->image->storeAs('public/image/grapes', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл
    }

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }

    public function handleBottomBack(){
        return redirect()->route('grapes-sort.show');
    }

    public function submit()
    {

        $this->validate();
        $transLiterate= (new Transliterate)->transLiterate($this->title);
        $grape=GrapesSort::find($this->grape_id);

        if(is_object($this->image)){
            $this->validate([
                'image' => 'required|file|max:4096',
            ]);
            (new UpLoadImage)->UpLoadImage('public/image/grapes', $transLiterate['file_name'], $this->image);
        }

        $grape->update([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => (is_object($this->image))?$transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():$grape->img,
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => ($this->description)?:$this->title,
            'keywords' => ($this->keywords)?:$this->title,
            'link' =>$this->link,
            'content' => $this->content,

        ]);
        $grape->save();
        return redirect()->route('grapes-sort.show');
    }

    public function render()
    {
        return view('grapes-sort.edit')->layout('layouts.admin');
    }
}
