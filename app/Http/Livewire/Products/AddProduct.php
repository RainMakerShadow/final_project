<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\ProductsCategories;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;
    public $image;
    public $categories;
    public $title;
    public $keywords;
    public $description;
    public $price;
    public $discount;
    public $selected;
    public $available=true;
    public $sale=false;
    public $new=false;
    public $transliteratedTitle;
    public $leftovers;
    public $img_file_name;

    public $img_title;
    public $img_descr;
    public $img_alt;

    public function mount(){
        $this->categories=ProductsCategories::all();
        $this->selected=1;
    }

    public function checkSale($checked, $targetId) //Проверка чекбоксов Новинка и Распродажа
    {
        if ($targetId == 'sale') {
            if ($checked) {
                $this->sale = true;
            } else {
                $this->sale = false;
            }
        }

        elseif ($targetId == 'new'){
            if ($checked) {
                $this->new = true;
            } else {
                $this->new = false;
            }
        }

        elseif ($targetId == 'available'){
            if ($checked) {
                $this->new = true;
            } else {
                $this->new = false;
            }
        }
    }

    protected $rules = [
        'title' => 'required',
/*        'price' => 'required',
        'sale' => 'required',
        'available' => 'required',
        'image'=>'required',*/
    ];

    public function upLoadImage() //Сохранение файла на сервер
    {
        $this->validate([
            'image' => 'required|file|max:4096',
        ]);

        $this->image->storeAs('/image/products/', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл


    }

    public function handleBottomBack(){
        return redirect()->route('products.show');
    }


    public function transliterate() //Транслитерация title для названия изображения, img_alt, img_descr
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E', 'Ж' => 'ZH',
            'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '', 'Э' => 'E', 'Ю' => 'YU',
            'Я' => 'YA',
        );

        $this->transliteratedTitle = strtr($this->title, $converter);
        $this->img_file_name = preg_replace('/\s+/', '-', $this->transliteratedTitle); // замена пробелов на дефисы
        $this->img_file_name = preg_replace('/[^a-zA-Z0-9\-]/', '', $this->img_file_name); // удаление всех символов, кроме латиницы, цифр и дефисов
        $this->img_file_name = strtolower($this->img_file_name);
    }

    public function submit(){ //Добавление товара
       $this->validate();
       $this->transliterate();
       if($this->image) $this->upLoadImage();
       Product::create([
          'title' => $this->title,
          'img_title' => (!$this->img_title) ? $this->title : $this->img_title,
          'img' => ($this->image)?$this->img_file_name.'.'.$this->image->getClientOriginalExtension():'',
          'img_alt'=> (!$this->img_alt) ? $this->title : $this->img_alt,
           'img_descr' => (!$this->img_descr) ? $this->title : $this->img_descr,
           'description' => $this->description,
           'keywords' => $this->keywords,
           'price' => $this->price,
           'sale' => $this->sale,
           'discount' => $this->discount,
           'new' => $this->new,
           'available' => $this->available,
           'leftovers' => $this->leftovers,
           'category_id' => $this->selected,
       ]);
        return redirect()->route('products.show');
    }

    public function render()
    {
        $categories=$this->categories;
        return view('products.add-product', compact('categories'))->layout('layouts.admin');
    }
}
