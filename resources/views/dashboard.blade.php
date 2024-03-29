@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3 >Your Blog Posts</h3>
                        @if (count($posts)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/" class="btn btn-primary">View</a></td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-danger">Edit</a></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                        <p>You have no posts</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection
