<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'capacityPerHour'];

    public static function getAllDevelopersBySorting()
    {
        return self::all()->sortByDesc('capacityPerHour')->map(function ($developer) {
            return [
                'name' => $developer->name,
                'capacityPerHour' => $developer->capacityPerHour,
            ];
        })->toArray();
    }
}
