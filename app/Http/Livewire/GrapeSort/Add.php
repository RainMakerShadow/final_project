<?php

namespace App\Http\Livewire\GrapeSort;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\GrapesSort;

class Add extends Component
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
    public $transLiterate;
    public $content;

    protected $rules = [
        'title' => 'required',
    ];

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);

    }

    public function handleBottomBack(){
        return redirect()->route('grapes-sort.show');
    }

    public function submit(){ //Добавление

        $this->validate();
        if($this->image) (new UpLoadImage)->upLoadImage('public/image/grapes', $this->transLiterate['file_name'], $this->image);

        GrapesSort::create([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => ($this->image)?$this->transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():'',
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => ($this->description)?:$this->title,
            'keywords' => ($this->keywords)?:$this->title,
            'link' => '/sorti-vinogradu'.$this->link,
            'content' => $this->content,

        ]);
        return redirect()->route('grapes-sort.show');
    }
    public function render()
    {
        return view('grapes-sort.add')->layout('layouts.admin');
    }
}
