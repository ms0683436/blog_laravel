@extends('layouts.index')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name ="title" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="body">Post Body</label>
        <textarea class="form-control" name="body" rows="5" placeholder="say something"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection