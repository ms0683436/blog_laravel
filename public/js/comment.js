function showComment(post_id) {		//user ajax to show comment
    var isShow = document.getElementById(post_id);
    if (isShow.className == 'collapse') {
        getComments(post_id);
    }else{
        document.getElementById('comment'+post_id).innerHTML = '';	//second click will clear comment div
    }
}

function leaveComment(post_id) {
    var comment = $("#comment_content"+post_id).val();
    if (comment) {
        $.ajax({
            type: "POST",
            url: post_id+"/comments",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'comment': comment,
                'last_comment_id': $('#comment'+post_id).children(".max").attr('id')
            },
            success: function(msg) {
                $("#comment_content"+post_id).val('');	// clear comment div
                pushComments(msg, post_id);
            }
        });
    }
}

function getComments(post_id) {
    $.ajax({         
        type: "GET",
        url: post_id+"/comments",
        success: function(returnData) {
            pushComments(returnData, post_id);
        }
    });
}

function pushComments(element, post_id) {
    var max_id = 0;
    element.forEach(function(element) {
        var pobj = $("#comment"+post_id);
        var node = document.createElement("a");
        node.className = 'btn btn-outline-secondary btn-sm';
        node.innerHTML = element.name;
        if (max_id < element.id) {
            node.className = 'btn btn-outline-secondary btn-sm max';
            node.setAttribute("id", element.id);
            max_id = element.id;
        }
        var content = document.createElement("div");
        content.className = 'card card-body';
        content.innerHTML = element.comment;
        pobj.prepend(content);

        var updateTime = document.createElement("small");
        updateTime.className = 'text-muted';
        updateTime.innerHTML = 'Last updated at ' + element.updated_at;
        pobj.prepend(updateTime);

        var route = "";
        node.setAttribute("href", route);
        pobj.prepend(node);
    });
}