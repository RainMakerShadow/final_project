<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\ProductsCategories;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditProduct extends Component
{
    use WithFileUploads;

    public $product;
    public $categories;
    public $title;
    public $keywords;
    public $description;
    public $price;
    public $discount;
    public $leftovers;
    public $selected;
    public $available=true;
    public $sale=false;
    public $new=false;
    public $image;
    public $img_title;
    public $img_descr;
    public $img_alt;
    public $productId;
    public $category_id;
    public $imageUrl;



    protected $rules = [
        'title' => 'required',
    ];

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

    public function upLoadImage() //Сохранение файла на сервер
    {
        $this->validate([
            'image' => 'required|file|max:4096',
        ]);

        $this->image->storeAs('public/image/products', $this->img_file_name.'.'.$this->image->getClientOriginalExtension()); // Путь, где будет сохранен файл


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

    public function submit()
    {

        $this->validate();
        $this->transliterate();

        $product=Product::find($this->productId);

        if(is_object($this->image)){
            $this->upLoadImage();
        }
        $product->update([
            'title' => $this->title,
            'img_title' => $this->img_title,
            'img' => (is_object($this->image))?$this->img_file_name.'.'.$this->image->getClientOriginalExtension():$product->img,
            'img_alt' => $this->img_alt,
            'img_descr' => $this->img_descr,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'price' => $this->price,
            'sale' => $this->sale,
            'discount' => $this->discount,
            'new' => $this->new,
            'available' => $this->available,
            'leftovers' => $this->leftovers,

        ]);
        $product->category_id=($this->category_id==$this->selected)?$this->category_id:$this->selected;
        $product->save();
        return redirect()->route('products.show');
    }

    public function mount($id)
    {

        $this->productId = $id;
        $this->product = Product::find($this->productId);
        $this->title=$this->product->title;
        $this->img_title=$this->product->img_title;
        $this->imageUrl=Storage::url('image/products/'.$this->product->img);
        //dd($this->image);
        $this->img_alt=$this->product->img_alt;
        $this->img_descr=$this->product->img_descr;
        $this->description=$this->product->description;
        $this->keywords=$this->product->keywords;
        $this->price=$this->product->price;
        $this->sale=$this->product->sale;
        $this->discount=$this->product->discount;
        $this->new=$this->product->new;
        $this->available=$this->product->available;
        $this->leftovers=$this->product->leftovers;
        $this->category_id=$this->product->category_id;
        $this->selected=$this->product->category_id;

        $this->categories = ProductsCategories::all();
    }
    public function render()
    {
        $product = $this->product;
        $categories = $this->categories;
        return view('products.edit-products', compact('product', 'categories'));
    }
}
