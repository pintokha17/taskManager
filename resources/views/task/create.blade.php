@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-block">
                        <h3 class="card-title">Inputs</h3>
                        {!! Form::open(['url' => route('task.store'), 'class' => 'form-horizontal', 'method' => 'post'])!!}
                            <div class="form-group row">
                                {!! Form::label('name', 'Name*', ['class' => 'col-md-3 col-form-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter name of the task...']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'description*', ['class' => 'col-md-3 col-form-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Enter name of the task...']) !!}
                                </div>
                            </div>
                        <div class="form-group row">
                            <div class="col-md-9">
                                {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
