// edit route


// delete route
$('#delete-route-btn').on('click', function(){
    var count = $('tr.select_tr').length;

    if(count) {
        if(!confirm('Are you sure you want to delete the selected records?')){
            return false;
        }

        var ids = [];
        $('tr.select_tr').each(function () {
            var route_id = $(this).find('td:first').text();
            ids.push(route_id);

            // ajax
            $.ajax({
                url: 'delete-route/'+route_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if(data.success){

                    }
                }
            });
        });
    }else{
        alert('You must select at least one record!');
    }
});