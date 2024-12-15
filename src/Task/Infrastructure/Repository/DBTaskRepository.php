<?php


namespace Src\Task\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Src\Customer\Domain\Customer;
use Src\Task\Infrastructure\Models\EloquentTask;
use Src\Task\Domain\Repository\TaskRepository;
use Src\Task\Domain\Task;

class DBTaskRepository implements TaskRepository
{
    /**
     * 
     */
    public function findById(int $id, ?Customer $customer): ?Task
    {
        $query = DB::table('tasks')->where('id', $id);
        if ($customer) {
            $query->where('customer_id', $customer->getId());
        }
        $result = $query->first();
        return $result ? $this->toDomain($result, $customer) : null;
    }

    /**
     * 
     */
    public function findAll(?Customer $customer): array
    {
        $query = DB::table('tasks');
        if ($customer) {
            $query->where('customer_id', $customer->getId());
        }
        $results = $query->get();
        return array_map(fn($result) => $this->toDomain($result, $customer), $results->all());
    }


    /**
     *  Delete a user
     */
    public function save(Task $task): void
    {
        $eloquentTask = $task->getId() ? EloquentTask::find($task->getId()) : new EloquentTask();
        $eloquentTask->fill([
            'front' => $task->getFront(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'due_date' => $task->getDueDate(),
            'status' => $task->getStatus(),
            'tags' => $task->getTags(),
            'customer_id' => $task->getCustomer()->getId(),
        ]);

        $eloquentTask->save();
        $task->setId($eloquentTask->id);
        $task->setCreatedAt($eloquentTask->created_at);
        $task->setUpdatedAt($eloquentTask->updated_at);
    }

    /**
     *  Delete a user
     */
    public function delete(Task $task): void
    {
        DB::table('tasks')->where('id', $task->getId())->delete();
    }

    /**
     * 
     */
    private function toDomain($dbRow, ?Customer $customer): Task
    {
        $taks =  new Task(
            id: $dbRow->id,
            front: $dbRow->front,
            title: $dbRow->title,
            description: $dbRow->description,
            dueDate: $dbRow->due_date,
            status: $dbRow->status,
            customer: $customer,
            tags: json_decode($dbRow->tags),
            created_at: $dbRow->created_at,
            updated_at: $dbRow->updated_at
        );

        return $taks;
    }
}
