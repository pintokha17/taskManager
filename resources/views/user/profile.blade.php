@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="card-block">
        <h3 class="card-title">{{ Auth::user()->name }}</h3>
        <p>{{ Auth::user()->description }}</p>
    </div>
@endsection
