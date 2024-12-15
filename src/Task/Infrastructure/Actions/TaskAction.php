<?php

namespace Src\Task\Infrastructure\Actions;

use Illuminate\Http\Request;

use Src\Customer\Application\CustomerUseCase;
use Src\Customer\Infrastructure\Traits\CustomerTrait;

use Src\Task\Application\Resources\TaskResource;
use Src\Task\Application\TaskUserCase;

/**
 * 
 */
class TaskAction
{

    use CustomerTrait;

    public function __construct(
        private CustomerUseCase $customerUserCase,
        private TaskUserCase $taskUserCase
    ) {}

    /**
     * 
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $customer = $this->getCustomer();
        $tasks = $this->taskUserCase->findAll($customer, $params);

        return response()->json(TaskResource::collection($tasks));
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        $customer = $this->getCustomer();
        $all = $request->all();
        $task = $this->taskUserCase->create($customer, $all);

        return new TaskResource($task);
    }

    /**
     * 
     */
    public function show(int $id)
    {
        $customer = $this->getCustomer();
        $task = $this->taskUserCase->show($id, $customer);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return new TaskResource($task);
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        $customer = $this->getCustomer();
        $all = $request->all();
        $task = $this->taskUserCase->update($id, $customer, $all);

        return new TaskResource($task);
    }

    /**
     * 
     */
    public function destroy(int $id)
    {
        $customer = $this->getCustomer();
        $this->taskUserCase->destroy($id, $customer);

        return response()->noContent();
    }
}
