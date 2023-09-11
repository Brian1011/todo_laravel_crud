<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'task_category_id',
        'due_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'due_date' => 'datetime',
    ];

    /**
     * Get the user that owns the todo.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the task category that owns the todo.
     */

    public function taskCategory()
    {
        return $this->belongsTo(TaskCategory::class);
    }

}
