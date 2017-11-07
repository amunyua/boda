var DT = $('#inventory-items').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-inventory-items',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'item_name', name: 'item_name'},
        { data: 'item_code', name: 'item_code'},
        { data: 'category_id', name: 'category_id'}
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

    if(edit_id != false){
        $('#edit-item-id').val(edit_id);
        // open modal
        $('#edit-inventory').modal('show');
        $.ajax({
           url: 'get-inventory-edit-details/'+edit_id,
            dataType: 'json',
            success: function (data) {
                $('#category-id-edit').val(data.inventory_details.category_id);
                $('#item-code-edit').val(data.inventory_details.item_code);
                $('#item-name-edit').val(data.inventory_details.item_name);
            }
        });
    }
});

var DT = $('#motorbikes').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-bikes',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'vin', name: 'vin'},
        { data: 'chassis_number', name: 'chassis_number'},
        { data: 'model', name: 'model'},
        { data: 'status', name: 'status'},
        { data: 'price', name: 'price'},
        { data: 'attach_insurance', name: 'attach_insurance'}
    ]
});

$('#edit-bike-btn').on('click',function () {
    var edit_id = Common.onEditValidateSelection();

    if(edit_id != false){
        $('#edit-item-id').val(edit_id);
        // open modal
        $('#edit-inventory').modal('show');
        $.ajax({
            url: 'edit-bike-details/'+edit_id,
            dataType: 'json',
            success: function (data) {
                // $('#category-id-edit').val(data.inventory_details.category_id);
                // $('#item-code-edit').val(data.inventory_details.item_code);
                // $('#item-name-edit').val(data.inventory_details.item_name);
            }
        });
    }
});




var DT = $('#stock-transactions').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-stock-transactions',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'item_id', name: 'item_id'},
        { data: 'transaction_category', name: 'transaction_category'},
        { data: 'transaction_type', name: 'transaction_type'},
        { data: 'quantity', name: 'quantity'},
        { data: 'new_level', name: 'new_level'},
        { data: 'created_by', name: 'created_by'}
    ]
});

$('#attach-insurance-btn').on('click',function () {
    var edit_id = Common.onEditValidateSelection();

    if(edit_id != false) {
        // open modal
        $('#attach-insurance').modal('show');
        $.ajax({
            url: 'get-inventory-edit-details/'+edit_id,
            dataType: 'json',
            // success: function (data) {
            //     var type = data.type;
            //     if(type == 'motorbike'){
            //         show_hide(type);
            //         $('#mk-cat').val(data.inventory_details.parent_category_id);
            //         $('#e-model').val(data.inventory_details.subcategory_id);
            //         $('#vin').val(data.inventory_details.vin);
            //         $('#chassis_number').val(data.inventory_details.chassis_number);
            //         $('#quantity').val(data.inventory_details.quantity);
            //         $('#cost_price').val(data.inventory_details.cost_price);
            //         $('#inventory-status').val(data.inventory_details.status);
            //     }
            // }
        });
    }
});

// ISSUE AND EXPIRY DATE
var DT = $('#startdate').datepicker({
    dateFormat : 'dd-mm-yy',
    prevText : '<i class="fa fa-chevron-left"></i>',
    nextText : '<i class="fa fa-chevron-right"></i>',
    onSelect : function(selectedDate) {
        $('#finishdate').datepicker('option', 'minDate', selectedDate);
    }
});

var DT = $('#finishdate').datepicker({
    dateFormat : 'dd-mm-yy',
    prevText : '<i class="fa fa-chevron-left"></i>',
    nextText : '<i class="fa fa-chevron-right"></i>',
    onSelect : function(selectedDate) {
        $('#startdate').datepicker('option', 'maxDate', selectedDate);
    }
});