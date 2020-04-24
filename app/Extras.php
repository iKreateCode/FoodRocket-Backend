<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extras extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category_id', 'price', 'image',
    ];
}