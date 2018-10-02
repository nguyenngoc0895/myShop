$(document).ready(function () {

    // $("#current_pwd").keyup(function () {
    //     var current_pwd = $("#current_pwd").val();
    //     $.ajax({
    //         type: 'get',
    //         url: '/admin/check-pwd',
    //         data: {
    //             'current_pwd': current_pwd
    //         },
    //         success: function (resp) {
    //             console.log(resp);
    //             if (resp == "false") {
    //                 $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
    //             } else if (resp == "true") {
    //                 $("#chkPwd").html("<font color='green'>Current Password is correct</font>");
    //             }
    //         },
    //         error: function (e) {
    //             console.log(e)
    //             // alert(e);
    //         }
    //     });
    // });
    $("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp=="false"){
					$("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
				}else if(resp=="true"){
					$("#chkPwd").html("<font color='green'>Current Password is correct</font>");
				}
			}
		});
	});

    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();

    $('select').select2();

    // add category Validation
    $("#add_category").validate({
        rules: {
            category_name: {
                required: true
            },
            parent_id: {
                required: true
            },
            description: {
                required: true
            },
            slug: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // edit category Validation
    $("#edit_category").validate({
        rules: {
            category_name: {
                required: true
            },
            description: {
                required: true
            },
            slug: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    //delete category
    $("#deleteCategory").click(function () {
        if (confirm("nghĩ lại xem chú?")) {
            return true;
        }
        return false;
    })

    $("#number_validate").validate({
        rules: {
            min: {
                required: true,
                min: 10
            },
            max: {
                required: true,
                max: 24
            },
            number: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

        // add Product Validation
        $("#add_product").validate({
            rules: {
                category_id: {
                    required: true
                },
                product_name: {
                    required: true
                },
                product_code: {
                    required: true
                },
                product_color: {
                    required: true
                },
                price: {
                    required: true,
                    number: true
                },
                image: {
                    required: true
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });

    $("#password_validate").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
});
