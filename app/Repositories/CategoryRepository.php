<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-09-06
 * Time: 20:04
 */

declare(strict_types = 1);

namespace App\Repositories;

use App\Category;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }
}