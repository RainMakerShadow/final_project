<?php

namespace App\Http\Livewire\ProductsCategories;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\Menu;
use App\Models\ProductsCategories;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProductsCategories extends Component
{
    use WithFileUploads;

    public $product_category;
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
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }
    public function handleBottomBack(){
        return redirect()->route('products-categories.show');
    }

    public function submit(){ //Добавление

        $this->validate();
        if($this->image) (new UpLoadImage)->upLoadImage('public/image/products-categories', $this->transLiterate['file_name'], $this->image);
        foreach ($this->menu as $item ){
            if ($item->id == $this->selected){
                $this->link=$item->link.$this->link;
            }
        }
        ProductsCategories::create([
            'title' => $this->title,
            'img_title' => ($this->img_title)?:$this->title,
            'img' => ($this->image) ? $this->transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension(): '',
            'img_alt' => $this->img_title,
            'img_descr' => $this->img_descr,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'menus_id' => $this->selected,
            'link' => $this->link,

        ]);
        return redirect()->route('products-categories.show');
    }
    public function render()
    {
        $menu=$this->menu;
        return view('products-categories.add-products-categories', compact('menu'))->layout('layouts.admin')->layout('layouts.admin');
    }
}
