<?php

namespace App\Services;

use App\Models\Developer;
use App\Models\Task;

class TaskPlanningService
{
    const WEEKLY_WORKING_HOURS_DEV = 45;

    public static function planAndDistributeTasks()
    {
        $taskDistribution = [];

        $tasks = Task::getAllTasksBySorting();
        $developers = Developer::getAllDevelopersBySorting();
        $sumOfLevelOfAllTasks = Task::getSumOfLevelAllTasks();

        $averageTimeDuration = round($sumOfLevelOfAllTasks
            / (self::WEEKLY_WORKING_HOURS_DEV * count($developers)));

        $week = 1;
        for (; $week <= $averageTimeDuration; $week++) {
            foreach ($developers as $developer) {
                $hours = 0;
                foreach ($tasks as $key => $task) {
                    if (
                        $hours + $task['duration'] <= self::WEEKLY_WORKING_HOURS_DEV
                        && $task['level'] <= $developer['capacityPerHour']
                    ) {
                        $taskDistribution[$week][$developer['name']][] = $task;
                        unset($tasks[$key]);
                        $hours += $task['duration'];
                    }
                }
            }

            if (empty($tasks)) break;
        }
        return ['totalWeeksNeeded' => $week - 1, 'taskDistribution' => $taskDistribution];
    }
}
