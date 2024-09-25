<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'level',
    ];

    public static function getAllTasksBySorting()
    {
        return self::all()->sortByDesc('level')->toArray();
    }

    public static function getSumOfLevelAllTasks()
    {
        return  self::sum('level');
    }
}
