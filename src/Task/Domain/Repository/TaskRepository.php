<?php

namespace Src\Task\Domain\Repository;

use Src\Customer\Domain\Customer;
use Src\Task\Domain\Task;

interface TaskRepository
{
    public function findById(int $id, ?Customer $customer): ?Task;
    public function findAll(?Customer $customer): array;
    public function save(Task $task): void;
    public function delete(Task $task): void;
}
