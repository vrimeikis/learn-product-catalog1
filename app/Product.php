<?php

declare(strict_types=1);

namespace App;


use Illuminate\Database\Eloquent\Model;


/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'price', 'context', 'active', 'cover',
    ];
}