@extends('layouts.app')
@section('title', 'Tasks')
@section('content')
    <a class="btn btn-primary btn-xs" href="{{ route('task.create') }}" role="button">Create new task</a>
    <div class="card-block">
        <h3 class="card-title">List of the tasks</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Spent time</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>

                    <td>{{ $task->status }}</td>
                    @if($task->status === \App\Task::STATUS_STARTED)
                        <th scope="row">{{ \App\Task::getDuration($task->total_time, $task->id) }}</th>
                    @else
                        <th scope="row">{{ \App\Task::getDuration($task->total_time) }}</th>
                    @endif
                    <td>
                        <a class="btn btn-primary btn-xs"
                           href="{{ route('task.show', $task->id) }}"
                           role="button">Show
                        </a>
                        <a class="btn btn-primary btn-xs"
                           href="{{ route('task.edit', $task->id) }}"
                           role="button">Edit
                        </a>
                        {!! Form::open(['method' => 'DELETE','route' => ['task.destroy', $task->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-primary btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
