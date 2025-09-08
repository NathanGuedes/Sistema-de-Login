<?php

namespace Models;

use DateTimeImmutable;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private string $token;

    private ?DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $activatedAt;

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $token
     */
    public function __construct(string $name, string $email, string $password, string $token)
    {
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $this->token = $token;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getActivatedAt(): ?DateTimeImmutable
    {
        return $this->activatedAt;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setActivatedAt(?DateTimeImmutable $activatedAt): void
    {
        $this->activatedAt = $activatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}