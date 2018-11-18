@extends('layouts.app')
@section('content')
{{-- <h1>{{$title}}</h1>
<p>This is the laravel application from the "Laravel From Scratch" youtube series</p> --}}
<div class="jumbotron text-center">
    <h1 class="display-4">{{$title}}</h1>
    <p class="lead">This is the laravel application from the "Laravel From Scratch" youtube series    </p>
        <a href="/login" class="btn btn-primary btn-lg">Login</a>
        <a href="/register" class="btn btn-success btn-lg">Register</a>
</div>
@endsection

 