@extends('layouts.app')

@section('title', 'Change password')

@section('content')
    <div class="card-block">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => ['profile.changePassword']]) !!}
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::label('current_password', 'Current password', ['class' => 'col-form-label']) !!}
                        {!! Form::password('current_password', ['class' => 'form-control']) !!}
                        @if($errors->has('current_password'))
                            <p class="text-danger">{{ $errors->first('current_password') }}</p>
                        @endif
                    </div>
                    <div class="col-md-12">
                        {!! Form::label('new_password', 'New password', ['class' => 'col-form-label']) !!}
                        {!! Form::password('new_password', ['class' => 'form-control']) !!}
                        @if($errors->has('new_password'))
                            <p class="text-danger">{{ $errors->first('new_password') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ Form::submit('Change password', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
@endsection
