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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    /**
     * @param array $columns
     * @return Collection
     * @throws \Exception
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->makeQuery()->get($columns);
    }

    /**
     * @param array $data
     * @return Model
     * @throws \Exception
     */
    public function create(array $data = []): Model
    {
        return $this->makeQuery()->create($data);
    }

    /**
     * @param array $data
     * @param $fieldValue
     * @param string $fieldName
     * @return int
     * @throws \Exception
     */
    public function update(array $data, $fieldValue, string $fieldName = 'id'): int
    {
        return $this->makeQuery()->where($fieldName, $fieldValue)->update($data);
    }
}