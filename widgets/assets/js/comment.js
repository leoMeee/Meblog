$(document).on('beforeSubmit', '#comment-form', function (e) {

    var form = $('#comment-form');

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function (response) {
            if (response.success) {
                window.location.reload();
            } else {
                alert("无法发布评论")
            }
        }
    });


    return false;
});
