$(document).ready(function () {
    show_hide('motorbike');
});
function show_hide(inv_type) {
    if(inv_type == 'motorbike'){
        $('.motorbike').show();
        $('.others').hide();
    }else{
        $('.others').show();
        $('.motorbike').hide();
    }
}

function list_options(data,html) {
    var count = data.length;
    if(count>0){
        html += '<option value="">Please select a category</option>';
        for (var i=0; i<count;i++){
            html += '<option value="'+data[i]['id'] +'">'+data[i]['category_name'] +'</option>'
        }
    }
    return html;
}

$('#inventory_type,.inventory_type').on('change',function () {
    var inv_type = $(this).val();
    show_hide(inv_type);
    if(inv_type != 'motorbike'){
        $('#other-inventory-cats,.other-inventory-cats').html('');
        var html ='';
        $.ajax({
           url: '/subcats/'+inv_type,
            dataType: 'json',
            success: function (data) {
               var options = list_options(data,html);
                $('#other-inventory-cats,.other-inventory-cats').html(options);
            }

        });
    }
});


$('#inventory-make,.inventory-make').on('change',function () {
    var id = $(this).val();
    $('#inventory-model,.inventory-model').html('');
    var html = '<option value="">Please select a model</option>';

    $.ajax({
        url: '/subcats/'+id,
        dataType: 'json',
        success: function (data) {
            var count = data.length;
            if(count>0){
                for (var i=0; i<count;i++){
                  html += '<option value="'+data[i]['id'] +'">'+data[i]['category_name'] +'</option>'
                }
            }
            $('#inventory-model,.inventory-model').html(html);
        }
    })
});

var DT = $('#inventory-items').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-inventory-items',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'inventory_type', name: 'inventory_type'},
        { data: 'parent_category_id', name: 'parent_category_id'},
        { data: 'subcategory_id', name: 'subcategory_id'},
        { data: 'vin', name: 'vin'},
        { data: 'status', name: 'status'},
        { data: 'quantity', name: 'quantity'},
        { data: 'cost_price', name: 'cost_price'}
    ]
});

$('#delete-inventory-btn').on('click',function () {
    var edit_ids = Common.onDeleteValidateSelection();

    if(edit_ids != false){
        // open modal
        $('#delete-inventory-item').modal('show');

        // populate the selected ids
        $('#edit_ids').val(edit_ids);

    }
});
$('#edit-inventory-btn').on('click',function () {
    var edit_id = Common.onEditValidateSelection();

    if(edit_id != false) {
        // open modal
        $('#edit-inventory').modal('show');
        $.ajax({
           url: 'get-inventory-edit-details/'+edit_id,
            dataType: 'json',
            success: function (data) {
                var type = data.type;
                if(type == 'motorbike'){
                    show_hide(type);
                    $('#mk-cat').val(data.inventory_details.parent_category_id);
                    $('#e-model').val(data.inventory_details.subcategory_id);
                    $('#vin').val(data.inventory_details.vin);
                    $('#chassis_number').val(data.inventory_details.chassis_number);
                    $('#quantity').val(data.inventory_details.quantity);
                    $('#cost_price').val(data.inventory_details.cost_price);
                    $('#inventory-status').val(data.inventory_details.status);
                }
            }
        });
    }
});