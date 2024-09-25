<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Factories\TaskProviderFactory;

class FetchTasks extends Command
{

    const PROVIDERS_NAME_LIST = [
        'taskprovider1',
        'taskprovider2'
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-tasks {provider?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Tasks From Provider APIs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $taskProviderName = ($this->argument('provider') !== null)  ? $this->argument('provider') : '';
        $tasks = [];
        try {
            if ($taskProviderName === '') {

                foreach ($this::PROVIDERS_NAME_LIST as $providerName) {
                    $tasks[] = $this->getProviderAndFetchData($providerName);
                }
                print_r($tasks);
            } else {
                $tasks[] = $this->getProviderAndFetchData($taskProviderName);
            }

            $this->createTaskModel($tasks);
        } catch (\Throwable $th) {
            $this->error("Error with Fetch Tasks and Insert " . $th);
            report($th);
            return [];
        }
    }

    private function createTaskModel($taskLists)
    {
        foreach ($taskLists as $taskList) {
            foreach ($taskList as $taskData) {
                Task::factory()->create([
                    'name' => $taskData['title'],
                    'duration' => $taskData['time'],
                    'level' => $taskData['level'],
                ]);
            }
        }
        $this->info('Tasks fetched and saved successfully.');
    }

    private function getProviderAndFetchData($provider)
    {
        $provider = TaskProviderFactory::getProvider($provider);
        return $provider->fetchTasks();
    }
}
