@extends('layouts.app')
@section('content')
    @if(count($posts)>0)
        @foreach ($posts as $post)
            <div class="well">
            <h1><a class="btb-link " href="/posts/{{$post->id}}">{{$post->title}}</a></h1>
            <small>Written on {{$post->created_at}}</small>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
    <p>No posts found</p>
    @endif
@endsection