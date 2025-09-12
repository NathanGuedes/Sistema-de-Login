<?php

namespace Repository;

use Contracts\UserRepositoryInterface;
use Models\User;
use PDO;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function teste()
    {

    }

    public function create(User $user): void
    {
        $sql = "INSERT INTO users (name, email, password, token, token_validity, created_at) VALUES (:name, :email, :password, :token, :token_validity, :created_at)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "password" => $user->getPasswordHash(),
            "token" => $user->getToken(),
            "token_validity" => date('Y-m-d H:i:s', time() + 15 * 60),
            "created_at" => date('Y-m-d H:i:s')
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

    public function findById(string $id): bool|array
    {
        // TODO: Implement findById() method.
    }

    public function findByEmail(string $email): bool|array
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "email" => $email
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}