function showComment(post_id) {		//user ajax to show comment
    var isShow = document.getElementById(post_id);
    if (isShow.className == 'collapse') {
        $.ajax({         
            type: "GET",
            url: post_id+"/comments",
            success: function( returnData ) {
                returnData.forEach(function(element) {
                    var pobj = $("#comment"+post_id);
                    var node = document.createElement("a");
                    node.className = 'btn btn-outline-secondary btn-sm';
                    node.innerHTML = element.name;
                    var route = "";
                    node.setAttribute("href", route);
                    pobj.append(node);

                    var updateTime = document.createElement("small");
                    updateTime.className = 'text-muted';
                    updateTime.innerHTML = 'Last updated at ' + element.updated_at;
                    pobj.append(updateTime);

                    var content = document.createElement("div");
                    content.className = 'card card-body';
                    content.innerHTML = element.comment;
                    pobj.append(content);
                });
            }
        });
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
                'comment': comment
            },
            success: function( msg ) {
                $("#comment_content"+post_id).val('');	// clear comment div
            }
        });
    }
}