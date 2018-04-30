// bootstrap wizard//

$('input[type="checkbox"].custom-checkbox').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    increaseArea: '20%'
});

$("#commentForm").bootstrapValidator({
    fields: {
        first_name: {
            validators: {
                notEmpty: {
                    message: 'The fisrt name is required'
                }
            },
            required: true,
            minlength: 3
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: 'The last name is required'
                }
            },
            required: true,
            minlength: 3
        },
        company_name: {
            validators: {
                notEmpty: {
                    message: 'The company name is required'
                }
            },
            required: true,
            minlength: 3
        },
        password: {
            validators: {
                different: {
                    field: 'first_name,last_name',
                    message: 'Password should not match first or last name'
                }
            }
        },
        password_confirm: {
            validators: {
                identical: {
                    field: 'password'
                },
                different: {
                    field: 'first_name,last_name',
                    message: 'Confirm Password should match with password'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'The email address is required'
                },
                emailAddress: {
                    message: 'The input is not a valid email address'
                }
            }
        },
        activate: {
            validators: {
                notEmpty: {
                    message: 'Please check the checkbox to activate'
                }
            }
        },
        group: {
            validators:{
                notEmpty:{
                    message: 'You must select a group'
                }
            }
        }
    }
});

$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function(tab, navigation, index) {
    },
    onTabClick: function(tab, navigation, index) {
        return true;
    },
    onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;

        // If it's the last tab then hide the last button and show the finish instead
        if ($current >= $total) {
            $('#rootwizard').find('.pager .next').hide();
            $('#rootwizard').find('.pager .finish').show();
            $('#rootwizard').find('.pager .finish').removeClass('disabled');
        } else {
            $('#rootwizard').find('.pager .next').show();
            $('#rootwizard').find('.pager .finish').hide();
        }
    }});


$('#rootwizard .finish').click(function () {
    document.getElementById("edituser").submit();
});