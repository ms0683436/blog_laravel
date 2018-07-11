@extends('layouts.index')

@section('title', '| Edit Blog Post')

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    <input name="_method" type="hidden" value="PUT">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name ="title" value="{{$post->title}}">
    </div>
    <div class="form-group">
        <label for="body">Post Body</label>
        <textarea class="form-control" name="body" rows="5">{{$post->body}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection