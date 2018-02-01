@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="card-block">
        <div class="row">
            <div class="col-md-12">
                {!! Form::model($user, ['route' => ['profile.save'], 'files' => true]) !!}
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        @if($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="col-md-12">
                        {!! Form::label('description', 'About you', ['class' => 'col-form-label']) !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                        @if($errors->has('description'))
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <hr>
                        {!! Form::label('avatar', 'Avatar', ['class' => 'col-form-label']) !!}
                        {!! Form::file('avatar') !!}
                        @if($errors->has('avatar'))
                            <p class="text-danger">{{ $errors->first('avatar') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
@endsection
