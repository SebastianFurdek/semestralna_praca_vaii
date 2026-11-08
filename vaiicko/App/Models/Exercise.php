<?php

namespace App\Models;

use Framework\Core\Model;

class Exercise extends Model
{
    protected static ?string $tableName = 'exercise';
    protected static array $columnsMap = [
        'user_id' => 'userId',
        'created_at' => 'createdAt',
    ];
    protected static ?array $fillable = ['name', 'description', 'userId'];

    public ?int $id = null;
    public int $userId = 1;
    public string $name = '';
    public ?string $description = null;
    public ?string $createdAt = null;
}
