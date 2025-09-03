<?php

namespace Repository;

use Contracts\UserRepositoryInterface;
use Models\User;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function teste()
    {

    }

    public function create(User $user): void
    {
        $sql = "INSERT INTO users (name, email, password, token) VALUES (:name, :email, :password, :token)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "password" => $user->getPasswordHash(),
            "token" => $user->getToken(),
        ]);
    }

    public function update(User $user): void
    {
        // TODO: Implement update() method.
    }

    public function delete(string $id): void
    {
        // TODO: Implement delete() method.
    }

    public function findById(string $id): ?User
    {
        // TODO: Implement findById() method.
    }

    public function findByEmail(string $email): ?User
    {
        // TODO: Implement findByEmail() method.
    }
}