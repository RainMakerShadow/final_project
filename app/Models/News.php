<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
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
        'category_id',
        'link',
        'content',
    ];
}
