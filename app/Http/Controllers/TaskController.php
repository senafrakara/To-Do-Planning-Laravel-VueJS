<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Developer;
use App\Services\TaskPlanningService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getPlan()
    {
        return view('task-planning');
    }

    public function planAndDistributeTasks()
    {

        $distribution = TaskPlanningService::planAndDistributeTasks();

        return  response()->json($distribution);
    }
}
