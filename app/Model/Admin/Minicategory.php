<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Minicategory extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id', 'minicategory_name'
    ];
}
