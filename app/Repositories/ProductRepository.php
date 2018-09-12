<?php
/**
 * Created by PhpStorm.
 * User: justi
 * Date: 2018-09-12
 * Time: 18:53
 */
declare(strict_types=1);

namespace App\Repositories;

use App\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }
}