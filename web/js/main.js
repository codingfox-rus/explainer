$(function(){
    $('#query-form').on('submit', function(e){
        e.preventDefault();
        
        const form = $(this);
        
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            dataType: 'json',
            data: {
                query: form.find('#query').val()
            }
        }).done(function (data) {
            $('#query-result').html(data.html);
        });
        
        return false;
    });
});


