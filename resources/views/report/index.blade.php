@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {!! Form::open(['url' => route('report'), 'class' => 'form-horizontal', 'method' => 'post'])!!}
            <div class="form-group row">
                <!-- field for: from -->
                {!! Form::label('date_from', 'Set time from:', ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-2">
                    <input type="date" name="date_from" step="1" min="2017-01-01" max="2030-12-31" value="<?= Request::get('date_from') ?>" class="form-control">
                </div>
                <!-- field for: to -->
                {!! Form::label('date_to', 'To:', ['class' => 'col-md-1 col-form-label']) !!}
                <div class="col-md-2">
                    <input type="date" name="date_to" step="1" min="2017-01-01" max="2030-12-31" value="<?= Request::get('date_to') ?>" class="form-control">
                </div>

                <div class="col-md-4">
                    {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="card-block">
        <h3 class="card-title">Total spent time: {{ \App\Task::getDuration($totalTime) }}</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Spent time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <th scope="row">{{ $task->name }}</th>

                    @if($task->status === \App\Task::STATUS_STARTED)
                        <th scope="row">{{ \App\Task::getDuration($task->total_time, $task->id) }}</th>
                    @else
                        <th scope="row">{{ \App\Task::getDuration($task->total_time) }}</th>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
