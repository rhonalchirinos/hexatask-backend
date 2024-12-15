<?php


namespace Src\Customer\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Src\Customer\Domain\Customer;
use Src\Customer\Domain\Repository\CustomerRepository;
use Src\Customer\Infrastructure\Models\EloquentCustomer;

class DBCustomerRepository implements CustomerRepository
{
    /**
     * 
     */
    public function findById(int $id): ?Customer
    {
        $result = DB::table('customers')->where('id', $id)->first();
        return $result ? $this->toDomain($result) : null;
    }

    /**
     * 
     */
    public function findAll(): array
    {
        $results = DB::table('customers')->get();

        return array_map(fn($result) => $this->toDomain($result), $results->all());
    }


    /**
     *  Delete a user
     */
    public function save(Customer $customer): void
    {

        $eloquentCustomer = $customer->getId() ? EloquentCustomer::find($customer->getId()) : new EloquentCustomer();
        $eloquentCustomer->fill([
            'full_name' => $customer->getFullName(),
            'email' => $customer->getEmail(),
            'password' => $customer->getPassword(),
        ]);

        $eloquentCustomer->save();
        $customer->setId($eloquentCustomer->id);
    }

    /**
     *  Delete a user
     */
    public function delete(Customer $user): void
    {
        DB::table('customers')->where('id', $user->getId())->delete();
    }

    /**
     * 
     */
    private function toDomain($dbRow): Customer
    {
        return new Customer(
            id: $dbRow->id,
            full_name: $dbRow->full_name,
            email: $dbRow->email,
            password: $dbRow->password,
            created_at: $dbRow->created_at,
            updated_at: $dbRow->updated_at
        );
    }
}
