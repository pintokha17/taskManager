<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\TaskTime;
use DB;
use Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        //if the post method, we accept data from the form
        if ($request->isMethod('POST'))
        {
            $dateFrom = new \DateTime($request->get('date_from'));
            $dateTo = new \DateTime($request->get('date_to'));
            $dateTo->modify('+1 day');

            if ($dateFrom->getTimestamp() > $dateTo->getTimestamp())
            {
                return redirect()->back()->with('error', 'incorrect input');
            }

            //query for searching records from table Tasks and TaskTime
            $tasks = DB::table('tasks')
                ->select(DB::raw('tasks.*, sum(task_time.execution_time) as total_time'))
                ->where([
                    ['task_time.start', '>=', $dateFrom->getTimestamp()],
                    ['task_time.pause', '<=', $dateTo->getTimestamp()],
					['tasks.user_id', '=', Auth::id()]
                ])
                ->leftJoin('task_time', 'tasks.id', '=', 'task_time.task_id')
                ->groupBy('tasks.id', 'tasks.name', 'tasks.description', 'tasks.status', 'user_id', 'created_at', 'updated_at')
                ->get();

        } else { //searching all the records from table
            $tasks = DB::table('tasks')
                ->select(DB::raw('tasks.*, sum(task_time.execution_time) as total_time'))
				->where([
					['tasks.user_id', '=', Auth::id()],
                ])
                ->leftJoin('task_time', 'tasks.id', '=', 'task_time.task_id')
                ->groupBy('tasks.id', 'tasks.name', 'tasks.description', 'tasks.status', 'user_id', 'created_at', 'updated_at')
                ->get();
        }

        $totalTime = Task::getTotalTime($tasks);

        return view('report.index', [
            'tasks' => $tasks,
            'totalTime' => $totalTime,
        ]);
    }
}