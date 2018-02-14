<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use DB;
use Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        //if the post method, we accept data from the form
        if ($request->isMethod('POST'))
        {
            Task::fieldIsEmpty($request->get('date_from'), $request->get('date_to'));

            $dateFrom = new \DateTime($request->get('date_from'));
            $dateTo = new \DateTime($request->get('date_to'));

            $dateTo->modify('+1 day');
            //set datetime format
            $dateFromFormatted = $dateFrom->format('Y-m-d H:i');
            $dateToFormatted = $dateTo->format('Y-m-d H:i');

            if ($dateFrom > $dateTo)
                return redirect()->back()->with('error', 'incorrect input');

            //query for searching records from table Tasks and TaskTime
            $tasks = DB::table('tasks')
                ->select(DB::raw('tasks.*, SUM(timestampdiff(
                          second,
                          GREATEST(start, "'. $dateFromFormatted .'"),
                          LEAST(pause, "'. $dateToFormatted .'"))) as total_time'))
                ->where([
                    ['tasks.user_id', '=', Auth::id()]
                ])
                ->whereRaw("(GREATEST(start, '{$dateFromFormatted}') AND LEAST(pause, '{$dateToFormatted}')) OR pause IS NULL AND start <= '{$dateToFormatted}'")
                ->rightJoin('task_time', 'tasks.id', '=', 'task_time.task_id')
                ->groupBy('tasks.id', 'tasks.name', 'tasks.description', 'tasks.status', 'user_id', 'created_at', 'updated_at')
                ->get();

        } else { //searching all the records from table
            $tasks = DB::table('tasks')
                ->select(DB::raw('tasks.*, sum(timestampdiff(second, task_time.start, task_time.pause)) as total_time'))
				->where([
					['tasks.user_id', '=', Auth::id()],
                ])
                ->rightJoin('task_time', 'tasks.id', '=', 'task_time.task_id')
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