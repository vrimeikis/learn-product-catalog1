<?php

namespace Tests\Unit\Repositories;

use App\Repositories\CategoryRepository;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    /**
     * @test
     * @group category
     * @group category-repository
     */
    public function it_should_make_singleton_instance(): void
    {
        $this->assertInstanceOf(CategoryRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @return CategoryRepository
     */
    private function getTestClassInstance(): CategoryRepository
    {
        return $this->app->make(CategoryRepository::class);
    }
}
