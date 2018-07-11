@extends('layouts.index')

@section('content')
    @foreach ($posts as $post)
        <div class='card w-75'>
            <div class='card-body'>
                <h5 class='card-title'>{{$post->title}}</h5>
                <small class='text-muted'>Last updated {{$post->updated_at}}</small>
                <p class='card-text'>{{$post->body}}</p>
            </div>
            <div class='card-footer'>
                <p>
                    @if (Auth::check())
                        <button type="button" class="btn btn-outline-success active" id="like{{$post->id}}" onclick="" data-toggle="button" aria-pressed="false">
                    @else
                        <button type="button" class="btn btn-outline-success disabled" data-toggle="button" aria-pressed="false" data-toggle='tooltip' title='you have to login!'>
                    @endif
                            Like<span class='badge badge-light' id=''></span>
                        </button>
                    <button onclick="showComment({{$post->id}})" type='button' class='btn btn-outline-primary' data-toggle='collapse' data-target="#{{$post->id}}" aria-expanded='false' aria-controls='collapseExample'>
                        Comment
                    </button>
                    @if (Auth::check() && Auth::user()->id == $post->user_id)
                        <a href="{{ route('posts.edit', $post->id) }}" class='btn btn-primary'>Edit</button>
                        <a href="" class='btn btn-danger'>Delete</a>
                    @endif
                </p>
                <div class='collapse' id="{{$post->id}}">
                    @if (Auth::check())
                        <div class='input-group mb-3'>
                            <div class='input-group-prepend'>
                                <span class='input-group-text' id='basic-addon1'>{{Auth::user()->name}}</span>
                            </div>
                            <input type='text' id='comment_content{{$post->id}}' class='form-control' placeholder='Username' aria-label='Username' aria-describedby='basic-addon1'>
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
    <script>
        function showComment(post_id) {		//user ajax to search comment
            //issue click other comment button the first comment will disappear
            var isShow = document.getElementById(post_id);
            if (isShow.className == 'collapse') {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var returnData = JSON.parse(this.responseText);
                        console.log(returnData)
                        returnData.forEach(function(element) {
                            
                            //console.log(element);
                            var pobj = document.getElementById('comment'+post_id);
                            var node = document.createElement("a");
                            node.className = 'btn btn-outline-secondary btn-sm';
                            node.innerHTML = element[1];
                            var route = "posts.php?current_user_page_id=" + element[0];
                            node.setAttribute("href", route);
                            pobj.appendChild(node);

                            var updateTime = document.createElement("small");
                            updateTime.className = 'text-muted';
                            updateTime.innerHTML = 'Last updated at ' + element[3];
                            pobj.appendChild(updateTime);

                            var content = document.createElement("div");
                            content.className = 'card card-body';
                            content.innerHTML = element[2];
                            pobj.appendChild(content);

                        });
                    }
                };
                xmlhttp.open("GET", "{{ route('comment', $post->id) }}", true);
                // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	//post must add this
                xmlhttp.send();
            }else{
                document.getElementById('comment'+post_id).innerHTML = '';	//second click will clear comment div
            }
        }

        function leaveComment(post_id) {
            console.log(post_id)
            var comment = document.getElementById('comment_content'+post_id).value;
            console.log(comment)
            if (comment) {
                var xmlhttp = new XMLHttpRequest();
                var data = "mode=leaveMessage&post_id=" + post_id + "&comment=" + comment;
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('comment'+post_id).innerHTML = '';	// clear comment div
                        var returnData = JSON.parse(this.responseText);
                        returnData.forEach(function(element) {
                            
                            //console.log(element);
                            var pobj = document.getElementById('comment'+post_id);
                            var node = document.createElement("a");
                            node.className = 'btn btn-outline-secondary btn-sm';
                            node.innerHTML = element[1];
                            var route = "posts.php?current_user_page_id=" + element[0];
                            node.setAttribute("href", route);
                            pobj.appendChild(node);

                            var updateTime = document.createElement("small");
                            updateTime.className = 'text-muted';
                            updateTime.innerHTML = 'Last updated at ' + element[3];
                            pobj.appendChild(updateTime);

                            var content = document.createElement("div");
                            content.className = 'card card-body';
                            content.innerHTML = element[2];
                            pobj.appendChild(content);
                            document.getElementById('comment_content'+post_id).value = '';	// clear comment input
                        });
                    }
                };
                xmlhttp.open("POST", "controller/commentController.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	//post must add this
                xmlhttp.send(data);
            }
        }
    </script>
@endsection