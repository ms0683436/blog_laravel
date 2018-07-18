function likeFunction(object_id, object) {
    var isActive = document.getElementById('like'+object_id).getAttribute("aria-pressed");
    var type = (isActive == 'true') ? 'DELETE' : 'POST';
    var route = (isActive == 'true') ? "unlike" : "like";
    // console.log(isActive)
    $.ajax({         
        type: type,
        url: route,
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'object_id': object_id,
            'object': object
        },
        success: function( returnData ) {
            $('#countlike'+object_id).html(returnData)
        }
    });
}