<?php


namespace App\Factories;

use App\Providers\TaskProvider1;
use App\Providers\TaskProvider2;
use App\Providers\TaskProviderInterface;


class TaskProviderFactory
{
    public static function getProvider(string $provider): TaskProviderInterface
    {
        switch ($provider) {
            case 'taskprovider1':
                return new TaskProvider1();
            case 'taskprovider2':
                return new TaskProvider2();
            default:
                throw new \InvalidArgumentException("Provider not found");
        }
    }
}
