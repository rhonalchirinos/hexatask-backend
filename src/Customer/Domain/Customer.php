<?php

namespace Src\Customer\Domain;

/**
 * Class Customer
 */
class Customer
{
    private ?int $id;
    private ?string $full_name;
    private ?string $email;
    private ?string $password;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct(
        int $id = null,
        string $full_name = null,
        string $email = null,
        string $password = null,
        string $created_at = null,
        string $updated_at = null
    ) {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }


    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
