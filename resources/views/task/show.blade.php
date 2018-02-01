@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">{{ $task->name }}</div>
        <div class="card-block">
            @if(Auth::id() === $task->user_id)
                @if($task->status === $task::STATUS_PAUSE)
                    <p>
                        <strong>Status of the task:</strong> Pause |<a class="btn btn-primary btn-xs" href="{{ route('start', $task->id) }}" role="button">Start</a>
                    </p>
                @elseif ($task->status === $task::STATUS_STARTED)
                    <p>
                        <strong>Status of the task:</strong> Started |<a class="btn btn-primary btn-xs" href="{{ route('pause', $task->id) }}" role="button">Stop</a>
                    </p>
                @elseif ($task->status === $task::STATUS_COMPLETED)
                    <p><strong>The task is completed</strong></p>
                @endif
            @endif
            <br>
            <strong>Description: </strong><p>{{ $task->description }}</p>
        </div>
    </div>
@endsection
