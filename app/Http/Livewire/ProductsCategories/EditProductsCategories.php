<?php

namespace App\Http\Livewire\ProductsCategories;

use App\Models\Menu;
use App\Models\ProductsCategories;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Actions\MyActions\Transliterate;
 use App\Actions\MyActions\UpLoadImage;
use Livewire\WithFileUploads;

class EditProductsCategories extends Component
{
    use WithFileUploads;

    public $product_category;
    public $product_category_id;
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
        $this->product_category_id=$id;
        $this->product_category = ProductsCategories::find($id);
        $this->menu=Menu::all();
        $this->title = $this->product_category->title;
        $this->img_title = $this->product_category->img_title;
        $this->img_alt = $this->product_category->img_alt;
        $this->img_descr = $this->product_category->img_descr;
        $this->description = $this->product_category->description;
        $this->keywords = $this->product_category->keywords;
        $this->menu_id = $this->product_category->menus_id;
        $this->link = $this->product_category->link;
        $this->image = $this->product_category->img;
        $this->imageUrl=Storage::url('image/products-categories/'.$this->product_category->img);
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
        $this->image->storeAs('public/image/products-categories', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл
    }

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }

    public function handleSelectMenu($elem){
        $this->selected=$elem;
    }
    public function submit()
    {

        $this->validate();
        $transLiterate= (new Transliterate)->transLiterate($this->title);
        $category=ProductsCategories::find($this->product_category_id);

        if(is_object($this->image)){
            $this->validate([
                'image' => 'required|file|max:4096',
            ]);
            (new UpLoadImage)->UpLoadImage('public/image/products-categories', $transLiterate['file_name'], $this->image);
        }
        $category->update([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => (is_object($this->image))?$transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():$category->img,
            'img_alt' => (!$this->img_alt)?$this->img_title:$this->img_alt,
            'img_descr' => (!$this->img_descr)?$this->img_title:$this->img_descr,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'link' => $this->link

        ]);
        $category->menus_id=$this->selected;
        $category->save();
        return redirect()->route('products-categories.show');
    }

    public function render()
    {
        $product_category=$this->product_category;
        $menu=$this->menu;
        return view('products-categories.edit-products-categories', compact('product_category', 'menu'));
    }
}
