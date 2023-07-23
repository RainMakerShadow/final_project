<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrapesSort extends Model
{
    use HasFactory;
    protected $table = 'grapes_sort';
    protected $fillable = [
        'title',
        'img_title',
        'img',
        'img_alt',
        'img_descr',
        'description',
        'keywords',
        'link',
        'content',
        'category_id',
    ];
}
