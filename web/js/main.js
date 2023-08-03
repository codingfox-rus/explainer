$(function(){
    $('#query-form').on('submit', function(e){
        e.preventDefault();
        
        const form = $(this);
        
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: {
                query: form.find('#query').val()
            }
        }).done(function (data) {
            $('#query-result').text(data);
        });
        
        return false;
    });
});


