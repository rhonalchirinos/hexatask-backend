<?php

namespace Src\Task\Domain;

use DateTime;
use Illuminate\Support\Facades\Log;
use Src\Customer\Domain\Customer;

/**
 * Class Customer
 */
class Task
{
    private ?int $id;
    private ?string $front;
    private ?string $title;
    private ?string $description;
    private ?DateTime $dueDate;
    private ?string $status;
    private ?array $tags;
    private ?int $customer_id;
    private ?Customer $customer;

    private ?string $created_at;
    private ?string $updated_at;

    // generate constructor getter and setters 
    public function __construct(
        int|null $id,
        string|null $front,
        string|null $title,
        string|null $description,
        string|DateTime|null $dueDate,
        string|null $status,
        array|null $tags,
        Customer|null $customer,
        string|null $created_at,
        string|null $updated_at
    ) {

        $this->id = $id;
        $this->front = $front;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->tags = $tags;
        $this->customer = $customer;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;

        $this->customer = $customer;
        $this->customer_id = $customer ? $customer->getId() : null;

        if (is_string($dueDate)) {
            $this->dueDate = new DateTime($dueDate);
        }
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFront(): string|null
    {
        return $this->front;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function getDueDate(): DateTime|null
    {
        return $this->dueDate;
    }

    public function getStatus(): string|null
    {
        return $this->status;
    }

    public function getTags(): array|null
    {
        return $this->tags;
    }

    public function getCustomer(): Customer|null
    {
        return $this->customer;
    }

    public function getCustomerId(): int|null
    {
        return $this->customer_id;
    }

    public function getCreatedAt(): string|null
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string|null
    {
        return $this->updated_at;
    }

    // Setters

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFront(string $front): void
    {
        $this->front = $front;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setDueDate(DateTime $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
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
