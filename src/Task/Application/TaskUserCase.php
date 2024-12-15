<?php

namespace Src\Task\Application;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use Src\Customer\Domain\Customer;
use Src\Customer\Domain\Repository\CustomerRepository;
use Src\Task\Application\Data\TaskData;
use Src\Task\Domain\Repository\TaskRepository;
use Src\Task\Domain\Task;

class TaskUserCase
{
    /**
     * 
     */
    public function __construct(private TaskRepository $taskRepository, private CustomerRepository $customerRepository) {}

    /**
     * 
     */
    public function findAll(Customer $customer, $params): array
    {
        return $this->taskRepository->findAll($customer, $params);
    }

    /**
     * 
     */
    public function create(Customer $customer, array $data): Task
    {
        // validated data
        $validated  = TaskData::validate($data);
        $task = new Task(
            id: null,
            front: $validated['front'] ?? null,
            title: $validated['title'],
            description: $validated['description'],
            dueDate: $validated['dueDate'],
            status: $validated['status'],
            tags: $validated['tags'],
            customer: $customer,
            created_at: null,
            updated_at: null
        );
        $this->taskRepository->save($task);
        return $task;
    }

    /**
     * 
     */
    public function show(int $id, Customer $customer): ?Task
    {
        $customer = $this->taskRepository->findById($id, $customer);

        return $customer;
    }

    /**
     * 
     */
    public function update(int $id, Customer $customer, array $data): ?Task
    {
        // validate 
        $task = $this->taskRepository->findById($id, $customer);
        $validated = TaskData::validate($data);

        if (array_key_exists('front', $validated)) {
            $task->setFront($validated['front']);
        }

        if (array_key_exists('title', $validated)) {
            $task->setTitle($validated['title']);
        }

        if (array_key_exists('description', $validated)) {
            $task->setDescription($validated['description']);
        }

        if (array_key_exists('status', $validated)) {
            $task->setStatus($validated['status']);
        }

        if (array_key_exists('tags', $validated)) {
            $task->setTags($validated['tags']);
        }

        if (array_key_exists('dueDate', $validated)) {
            $task->setDueDate(new \DateTime($validated['dueDate']));
        }

        $this->taskRepository->save($task);
        return $task;
    }

    /**
     * 
     */
    public function destroy(int $id, Customer $customer): void
    {
        $task = $this->taskRepository->findById($id, $customer);
        $this->taskRepository->delete($task);
    }
}
