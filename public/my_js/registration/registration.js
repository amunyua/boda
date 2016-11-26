
// REGISTRATION DATE
$('.regdate').datepicker({
    dateFormat : 'dd-mm-yy',
    prevText : '<i class="fa fa-chevron-left"></i>',
    nextText : '<i class="fa fa-chevron-right"></i>',
    onSelect : function(selectedDate) {
        $('#finishdate').datepicker('option', 'minDate', selectedDate);
    }
});

$('#b_role').on('change', function(){
    var role = $(this).val();
    // alert('working');

    if(role == 'Administrator'){
        $('#role').attr('readonly', 'readonly').val('SYS_ADMIN');
    }else if(role == 'Staff'){
        $('#role').attr('readonly', 'readonly').val('STAFF');
    }else if(role == 'Client'){
        $('#role').attr('readonly', 'readonly').val('CLIENT');
    }
});

// DO NOT REMOVE : GLOBAL FUNCTIONS!
$(document).ready(function() {

    pageSetUp();

    //Bootstrap Wizard Validations

    var $validator = $("#wizard-1").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            b_role: {
                required: true
            },
            firstname: {
                required: true,
                minlength: 3,
                maxlength: 15
            },
            surname: {
                required: true,
                minlength: 3,
                maxlength: 15
            },
            role: {
                required: true
            },
            id_no: {
                required: true,
                minlength: 8,
                maxlength: 12
            },
            county: {
                required: true,
            },
            city: {
                required: true,
            },
            phone_no: {
                required: true,
                minlength: 10
            },
            postal_address: {
                required: true
            },
            physical_address: {
                required: true
            },
            contact_type: {
                required: true
            }
        },

        messages: {
            firstname: {
                required: "Please specify your First name",
                minlength:  "Minimum characters 3",
                maxlength:  "Maximum characters 15"
            },
            surname: {
               required: "Please specify your Surname",
               minlength:  "Minimum characters 3",
               maxlength:  "Maximum characters 15"
            },
            id_no: {
                required: "Please specify National id or Phone Number",
                minlength:  "Minimum characters 8",
                maxlength:  "Maximum characters 15"
            },
            email: {
                required: "You must specify the email address",
                email: "The email address must be in the format of name@domain.com"
            },
            county: "Please provide county location",
            city: "Please provide city name",
            postal_address: "Please provide postal address",
            physical_address: "Please provide physical address",
            phone_no: {
                required: "Please provide mobile number",
                minlength: "Minimum characters 10 e.g 0700 000 000",
                maxlength: "Maximum characters 10 e.g 254 700 000 000",
            },
            role: "You must select the Role first"
        },

        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#bootstrap-wizard-1').bootstrapWizard({
        'tabClass': 'form-wizard',
        'onNext': function (tab, navigation, index) {
            var $valid = $("#wizard-1").valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            } else {
                if(index == 4){
                    $('#finish-btn').submit();
                }

                $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass('complete');
                $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                    .html('<i class="fa fa-check"></i>');
            }
        },
        'onLast': function(){
             $('#wizard-1').submit();
        }
    });


    // fuelux wizard
    var wizard = $('.wizard').wizard();

    wizard.on('finished', function (e, data) {
        //$("#fuelux-wizard").submit();
        //console.log("submitted!");
        $.smallBox({
            title: "Congratulations! Your form was submitted",
            content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
            color: "#5F895F",
            iconSmall: "fa fa-check bounce animated",
            timeout: 4000
        });

    });


})