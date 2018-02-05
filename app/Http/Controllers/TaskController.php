<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\TaskTime;
use Auth;
use DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskController extends Controller
{

    // Display a listing of the tasks.
    public function index()
    {
        $tasks = DB::table('tasks')
            ->select(DB::raw('tasks.*, sum(task_time.execution_time) as total_time'))
			->where('tasks.user_id', '=', Auth::id())
            ->leftJoin('task_time', 'tasks.id', '=', 'task_time.task_id')
            ->groupBy('tasks.id', 'tasks.name', 'tasks.description', 'tasks.status', 'user_id', 'created_at', 'updated_at')
            ->get();

        return view('task.index', [
            'tasks' => $tasks
        ]);
    }

    //Show the form for creating a new task.
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:tasks',
            'description' => 'required',
        ]);

        $task = new Task();
        $task->name = $request->get('name');
        $task->description = $request->get('description');
        $task->status = Task::STATUS_PAUSE;
        $task->user_id = Auth::id();

        $task->save();

        return redirect()->route('task.index');
    }

    // Display the selected task.
    public function show($id)
    {
        return view('task.show', [
            'task' => $this->findTask($id),
        ]);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        return view('task.edit', [
            'task' => $this->findTask($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:tasks',
            'description' => 'required',
        ]);

        $task = $this->findTask($id);
        $task->name = $request->get('name');
        $task->description = $request->get('description');

        $task->save();

        return redirect()->route('task.index');
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return redirect()->route('task.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function start($id)
    {
        $task = $this->findTask($id);
        $task->start();

        return redirect()->back();
    }

    public function pause($id)
    {
        $task = $this->findTask($id);
        $task->pause();

        return redirect()->back();
    }

    public function finish($id)
    {
        $task = $this->findTask($id);
        $task->complete();

        return redirect()->back();
    }

    /**
     * @param $id int
     * @return Task|null
     */
    protected function findTask($id)
    {
        $task = Task::find($id);

        if ($task === null || $task->user_id != Auth::id()) {
            throw new NotFoundHttpException('This task not found.');
        }

        return $task;
    }
}