$(function(){
    $('#query-form').on('submit', function(e){
        e.preventDefault();
        
        const form = $(this);
        const spinner = form.find('.spinner-border');
        spinner.removeClass('d-none');
        
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            dataType: 'json',
            data: {
                query: form.find('#query').val()
            }
        }).done(function (data) {
            $('#query-result').html(data.html);
            spinner.addClass('d-none');
        });
        
        return false;
    });
});


