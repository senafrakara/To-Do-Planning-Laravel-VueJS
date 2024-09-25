<?php

namespace App\Providers;

interface TaskProviderInterface
{
    public function fetchTasks(): array;
}
