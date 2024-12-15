<?php

namespace Src\Task\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentTask extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'id',
        'front',
        'title',
        'description',
        'due_date',
        'status',
        'tags',
        'customer_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
        ];
    }

    /**
     * Get the customer that owns the task.
     */
    public function customer()
    {
        return $this->belongsTo(EloquentCustomer::class);
    }
}
