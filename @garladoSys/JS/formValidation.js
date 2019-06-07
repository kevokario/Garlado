$(document).ready(function () {
    $('#login').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'

        }, fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'Please provide email'
                    },
                    stringLength: {
                        min: 9,
                        message: 'Email should contain atleast 10 characters'
                    },
                    emailAddress: {
                        message: 'Provide valid email address'
                    }
                }
            }, password: {
                validators: {
                    notEmpty: {
                        message: 'Please provide password'
                    },
                    stringLength: {
                        min: 9,
                        message: 'Email should contain atleast 5 characters'
                    }
                }
            }
        }
    });
});