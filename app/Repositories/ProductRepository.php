<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository extends Repository
{
    const DEFAULT_PER_PAGE = 10;
    /**
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }

}