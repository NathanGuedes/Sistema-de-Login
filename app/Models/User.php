<?php

namespace Models;

use DateMalformedStringException;
use DateTimeImmutable;
use Random\RandomException;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private string $token;

    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $activatedAt;

    /**
     * @param string $id
     * @param string $name
     * @param string $email
     * @param string $passwordHash
     * @param string $token
     * @param DateTimeImmutable $createdAt
     * @param DateTimeImmutable|null $updatedAt
     * @param DateTimeImmutable|null $activatedAt
     */
    public function __construct(string $id, string $name, string $email, string $passwordHash, string $token, DateTimeImmutable $createdAt, ?DateTimeImmutable $updatedAt, ?DateTimeImmutable $activatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->token = $token;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->activatedAt = $activatedAt;
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


}