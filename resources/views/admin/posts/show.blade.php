@extends('layouts.app')

@section('content')
    <div class="container">

        <a class="mt-4" style="display: inline-block; text-decoration: none" href="{{route('admin.posts.index')}}"><< Back to posts</a>

        <h1 class="mt-3">{{ $post->title }} </h1>

        <span>Category: </span><span class="badge text-bg-warning">{{$post->category ? $post->category->name : 'Nessuna categoria'}}</span><br>

        @foreach ($post->tags as $tag)
        <span>Tags: </span><span class="badge text-bg-secondary">{{$tag->name}}</span>
        @endforeach

        <br><br>

        <p class="w-50">{{$post->content}}</p><br>
        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
    </div>
@endsection
