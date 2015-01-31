$(document).ready(function () {
    $('.form')
        .on('change', '#url', function () {
            $('#result').html('');
            $('.error').html('');
        })
        .on('focus', '#result input, #url', function () {
            $(this).select();
        });
});
