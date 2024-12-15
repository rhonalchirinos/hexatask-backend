<?php

namespace Src\Task\Application\Data;

use DateTime;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Data;
use Src\Task\Domain\Task;

class TaskData extends Data
{

    public function __construct(
        private ?int $id,
        private ?string $front,
        private ?string $title,
        private ?string $description,
        private string|DateTime|null $dueDate,
        private ?string $status,
        private ?array $tags,
        private ?int $customer_id,
    ) {
        if (is_string($this->dueDate)) {
            $this->dueDate = new DateTime($this->dueDate);
        }
    }

    // public static function fromModel(Task $task): self
    // {
    //     return new self(
    //         id: $task->getId(),
    //         front: $task->getFront(),
    //         title: $task->getTitle(),
    //         description: $task->getDescription(),
    //         dueDate: $task->getDueDate(),
    //         status: $task->getStatus(),
    //         tags: $task->getTags(),
    //         customer_id: $task->getCustomerId()
    //     );
    // } 

    /**
     * 
     */
    public static function rules(): array
    {
        return [
            'front' => ['nullable', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'dueDate'  => ['nullable', 'date'],
            'status'  => ['required', 'string', 'max:120'],
            'tags' => ['nullable', 'array',]
        ];
    }
}
