<?php

namespace App\Models;

use Framework\Core\Model;

class WorkoutExercise extends Model
{
    protected static ?string $tableName = 'workout_exercise';
    protected static array $columnsMap = [
        'workout_id' => 'workoutId',
        'exercise_id' => 'exerciseId',
    ];
    protected static ?array $fillable = ['workoutId', 'exerciseId'];

    public ?int $id = null;
    public int $workoutId = 0;
    public int $exerciseId = 0;
}
