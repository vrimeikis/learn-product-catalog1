<?php

declare(strict_types=1);

namespace Tests\Unit\Repositories;

use App\Repositories\UserRepository;
use Tests\TestCase;


/**
 * Class UserRepositoryTest
 * @package Tests\Unit\Repositories
 */
class UserRepositoryTest extends TestCase
{
    /**
     * @test
     * @group user-repository
     */
    public function it_should_create_singleton_instance(): void
    {
        $this->assertInstanceOf(UserRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @return UserRepository
     */
    private function getTestClassInstance(): UserRepository
    {
        return $this->app->make(UserRepository::class);
    }
}
