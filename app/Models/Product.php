<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_title',
        'img',
        'img_alt',
        'img_descr',
        'description',
        'keywords',
        'price',
        'sale',
        'discount',
        'new',
        'available',
        'leftovers',
        'category_id',
    ];

}
