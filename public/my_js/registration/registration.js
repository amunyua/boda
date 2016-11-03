// var MF = {
//     houseKeeping: function(){
//         var role = $(this).val();
//
//         switch (role){
//             case 'STUDENT':
//                 $('#postal_address').attr('disabled', 'disabled').removeAttr('required');
//                 $('#adm_no').attr('placeholder', 'Admission No');
//                 break;
//
//             case 'GUARDIAN':
//                 $('#adm_no').attr('placeholder', 'ID No');
//                 break;
//
//             case 'TEACHER':
//                 $('#adm_no').attr('placeholder', 'ID No');
//                 $('#kra_pin').removeAttr('disabled');
//                 $('#nssf_no').removeAttr('disabled');
//                 $('#nhif_no').removeAttr('disabled');
//                 break;
//
//             case 'SS':
//                 $('#adm_no').attr('placeholder', 'ID No');
//                 $('#kra_pin').removeAttr('disabled');
//                 $('#nssf_no').removeAttr('disabled');
//                 $('#nhif_no').removeAttr('disabled');
//                 break;
//         }
//     }
// }

// MF.houseKeeping();
// $('#role').on('change', function(){
//     MF.houseKeeping();
// });

// REGISTRATION DATE
$('.regdate').datepicker({
    dateFormat : 'dd-mm-yy',
    prevText : '<i class="fa fa-chevron-left"></i>',
    nextText : '<i class="fa fa-chevron-right"></i>',
    onSelect : function(selectedDate) {
        $('#finishdate').datepicker('option', 'minDate', selectedDate);
    }
});


// $(function(){
//     $('#finish-btn').click(function(){ alert('working'); });
// });