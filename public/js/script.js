$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});

    $('.btn-recount').click(function(e){
        $(this).addClass('disabled').attr('disabled', true);
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Пересчитать');

        $.ajax({
            url: '/recount',
            type: 'POST',
            dataType: 'JSON',
            success: function (response) {
                setTimeout(function(){
                    location.reload();
                }, 5000);
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    $('.ajax-form').submit(function(e){
        e.preventDefault();

        var $this = $(this);
        $this.find('input[type="text"]').removeClass('error');
        $this.find('button[type="submit"]').addClass('disabled').attr('disabled', true);
        $.ajax({
            url: $this.attr('action'),
            type: 'POST',
            data: $this.serialize(),
            dataType: 'JSON',
            success: function (response) {
                $this.find('button[type="submit"]').html('<i class="fa fa-check"></i> Сохранить');

                $this.find('button[type="submit"]').removeClass('disabled').attr('disabled', false);
            },
            error: function (response) {
                $.each(response.responseJSON, function(index, value){
                    $this.find('input[name="'+index+'"]').addClass('error');
                });

                $this.find('button[type="submit"]').removeClass('disabled').attr('disabled', false);
            }
        });
    });
})