<?php

namespace Tests\Infrastructure\Persistence\Repository;

use App\Contract\Repository;
use App\Entity\User;
use App\Infrastructure\Persistence\Repository\UserInMemoryRepository;
use PHPUnit\Framework\TestCase;

class UserInMemoryRepositoryTest extends TestCase
{
    private Repository $repository;

    public function setUp(): void
    {
        $this->repository = new UserInMemoryRepository();
    }

    /**
     * @test
     */
    public function repository_ShouldSaveEntity(): void
    {
        $user = new User(1, 'Kayo', 'kayodw@gmail.com');
        $this->repository->insert($user);

        $this->assertCount(1, $this->repository->all());
    }

    /**
     * @test
     */
    public function repository_GetAllEntities_ShouldReturnAllEntities(): void
    {
        $this->repository->insert(new User(1, 'Kayo', 'kayodw@gmail.com'));
        $this->repository->insert(new User(2, 'Bruno', 'bruno@mail.com'));
        $this->repository->insert(new User(3, 'Kayo Bruno', 'kayobruno@gmail.com'));

        $this->assertCount(3, $this->repository->all());
    }

    /**
     * @test
     */
    public function repository_FindEntity_ShouldReturnCorrectEntity(): void
    {
        $this->repository->insert(new User(1, 'Kayo', 'kayodw@gmail.com'));
        /** @var User $user */
        $user = $this->repository->find(1);

        $this->assertEquals('Kayo', $user->getName());
        $this->assertEquals('kayodw@gmail.com', $user->getEmail());
    }

    /**
     * @test
     */
    public function repository_FindEntity_ShouldReturnNothingWhenEntityNoExists(): void
    {
        $this->repository->insert(new User(1, 'Kayo', 'kayodw@gmail.com'));
        $user = $this->repository->find(2);

        $this->assertNull($user);
    }

    /**
     * @test
     */
    public function repository_UpdateEntity_ShouldUpdateEntityProperties(): void
    {
        $this->repository->insert(new User(1, 'Kayo', 'kayo@gmail.com'));
        $userUpdated = new User(1, 'Kayo', 'kayodw@gmail.com');
        $this->repository->update($userUpdated->getId(), $userUpdated);

        /** @var User $user */
        $user = $this->repository->find(1);

        $this->assertEquals('Kayo', $user->getName());
        $this->assertEquals('kayodw@gmail.com', $user->getEmail());
    }

    /**
     * @test
     */
    public function repository_ShouldRemoveEntity(): void
    {
        $this->repository->insert(new User(1, 'Kayo', 'kayodw@gmail.com'));
        $this->repository->insert(new User(2, 'Bruno', 'bruno@mail.com'));
        $this->repository->insert(new User(3, 'Kayo Bruno', 'kayobruno@gmail.com'));

        $this->repository->delete(2);

        $this->assertCount(2, $this->repository->all());
    }
}
