<?php

namespace Src\Task\Application\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'front' => $this->getFront(),
            'title' => $this->getTitle(),
            'description' =>  $this->getDescription(),
            'dueDate' =>  $this->getDueDate(),
            'status' =>  $this->getStatus(),
            'customer' =>  $this->customer(),
            'tags' =>  $this->getTags(),
            'created_at' =>  $this->getCreatedAt(),
            'updated_at' =>  $this->getUpdatedAt(),
        ];
    }

    /**
     * 
     */
    public function customer()
    {
        /**
         * @var \Src\Customer\Domain\Customer $customer
         */
        $customer = $this->getCustomer();

        return [
            'id' => $customer->getId(),
            'name' => $customer->getFullName(),
        ];
    }
}
