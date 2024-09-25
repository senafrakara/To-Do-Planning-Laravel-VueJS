<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use App\Providers\TaskProviderInterface;

class TaskProvider2 implements TaskProviderInterface
{
    public function fetchTasks(): array
    {
        $response = Http::get('https://run.mocky.io/v3/8adf9f37-560f-4aec-b6b1-0e54c6c9ee1a');
        return json_decode($response, true)["data"];
    }
}
