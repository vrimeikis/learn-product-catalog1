<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @method static whereSlug(string $getSlug)
 * @method static create(array $data)
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $title
 * @property string $slug
 * @property int $active
 * @property string|null $cover
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'cover',
        'active',
    ];
}
