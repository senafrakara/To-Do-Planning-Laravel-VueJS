<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use App\Providers\TaskProviderInterface;

class TaskProvider1 implements TaskProviderInterface
{
    public function fetchTasks(): array
    {
        $response = Http::get('https://run.mocky.io/v3/e1316a2c-8802-4023-bd59-80e9ba2e732d');

        return json_decode($response, true)["data"];
    }
}
