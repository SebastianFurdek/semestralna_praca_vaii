<?php

namespace App\Models;

use Framework\Core\Model;

class Workout extends Model
{
    protected static ?string $tableName = 'workout';
    protected static array $columnsMap = [
        'user_id' => 'userId',
        'created_at' => 'createdAt',
    ];
    protected static ?array $fillable = ['name', 'userId'];

    public ?int $id = null;
    public int $userId = 1;
    public string $name = '';
    public ?string $createdAt = null;
}
