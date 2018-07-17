@extends('layouts.index')

@section('content')
    @inject('PostPresenter', 'App\Presenters\PostPresenter')
    @foreach ($posts as $post)
        <div class='card w-75'>
            <div class='card-body'>
                <h5 class='btn btn-outline-secondary btn-sm'>{{$post->name}}</h5>
                <h5 class='card-title'>{{$post->title}}</h5>
                <small class='text-muted'>Last updated {{$post->updated_at}}</small>
                <p class='card-text'>{{$post->body}}</p>
            </div>
            <div class='card-footer'>
                <p>
                    <div class="form-inline">
                    {!! $PostPresenter->getLikeButton($post->id, $post->isActive) !!}
                    
                    <!-- <button type="button" class="btn btn-outline-success disabled" data-toggle="button" aria-pressed="false" data-toggle='tooltip' title='you have to login!'> -->
                        Like<span class='badge badge-light' id='countlike{{$post->id}}'>{{$post->count}}</span>
                    </button>
                    <button onclick="showComment({{$post->id}})" type='button' class='btn btn-outline-primary' data-toggle='collapse' data-target="#{{$post->id}}" aria-expanded='false' aria-controls='collapseExample'>
                        Comment
                    </button>
                    @if (Auth::check() && Auth::user()->id == $post->user_id)
                        <a href="{{ route('posts.edit', $post->id) }}" class='btn btn-primary'>Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    @endif
                    </div>
                </p>
                <div class='collapse' id="{{$post->id}}">
                    @if (Auth::check())
                        <div class='input-group mb-3'>
                            <div class='input-group-prepend'>
                                <span class='input-group-text' id='basic-addon1'>{{Auth::user()->name}}</span>
                            </div>
                            <input type='text' id='comment_content{{$post->id}}' class='form-control' placeholder='comment' aria-label='comment' aria-describedby='basic-addon1'>
                            <div class='input-group-append'>
                                <button onclick='leaveComment({{$post->id}})' class='btn btn-outline-secondary' type='button'>send</button>
                            </div>
                        </div>
                    @else
                        <p>you have to login to leave message</p>
                    @endif
                    <div id='comment{{$post->id}}'>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script src="{{asset('/js/comment.js')}}"></script>
    <script src="{{asset('/js/like.js')}}"></script>
@endsection