@extends('layouts.default')
@section('title', 'home')
@section('content')
    <div class="jumbotron">
        <h1>Hello Laravel</h1>
        <p class="lead">
            Laravel study
        </p>
        <p>
            Begin here.
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">register</a>
        </p>
    </div>
@stop