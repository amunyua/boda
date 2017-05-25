/**
 * Created by SATELLITE on 1/16/2017.
 */
$('#deposit-form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if(data.success){

            } else {

            }
        }
    });
})