require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });
    $('#comment_form').submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                var response = JSON.parse(data);
                if (typeof response === 'number')
                {
                    $('#comment_form')
                        .parent()
                        .empty()
                        .prepend('<div style="color: green">Ваше сообщение успешно отправлено</div>');
                }
                else
                {
                    $('#comment_form')
                        .parent()
                        .prepend('<div class="error" style="color: red">'+ response.error + '</div>');
                    window.setTimeout(function () {
                        $('.error').remove();
                    }, 2000)
                }

                console.log(data); // show response from the php script.
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                $('#comment_form')
                    .parent()
                    .prepend('<div class="error" style="color: red">'+ msg + '</div>');
                window.setTimeout(function () {
                    $('.error').remove();
                }, 2000)
                console.log(msg);
            }
        });
    });

    $('.delete_btn').click(function() {
        let post_id = $(this).data('post_id');
        if (confirm('Are you sure you want to delete this post?')) {
            delete_post(post_id, $(this));
        }
        else {
            return false;
        }
    });
    $('.reply_btn').click(function() {
       let comment_id = $(this).parents('.comment_item').data('comment_id');
       $('#comment_form input[name="parent_id"]').val(comment_id);
       let comment_text = $(this).parents('.comment_item').find('.comment_text').text();
       $('.reply_to_text').text(comment_text.substring(0, 50));
    });
});
function delete_post(post_id, $delete_btn) {
    $.ajax({
        type: "DELETE",
        url: '/articles/' + post_id,
        success: function (data) {
            var response = JSON.parse(data);
            if (response.hasOwnProperty('success') && response.success == '1') {
                $delete_btn.parents('.post_item').remove();
            }
            console.log(data); // show response from the php script.
        },
    });
}
