@extends('layouts.app')
@section('content')
    @if(count($posts)>0)
        @foreach ($posts as $post)
            <div class="card mb-2" style="width: 70%;">
            <div class="card-body">
                <h1 class="card-title"><a class="btn-link " href="/posts/{{$post->id}}">{{$post->title}}</a></h1>
                <small>Written on {{$post->created_at}}</small>
            </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
    <p>No posts found</p>
    @endif
@endsection