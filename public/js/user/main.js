/*price range*/

//  $('#sl2').slider();

// 	var RGBChange = function() {
// 	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
// 	};	
		
/*scroll to top*/

$(document).ready(function () {
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function () {

	///change price for product
    $("#selectSize").change(function () {
        var idSize = $(this).val();
        if (idSize == "") {
            return false;
        }
        $.ajax({
            type: 'get',
            url: '/get-product-price',
            data: { idSize: idSize },
			success: function (res) {

				var arr = res.split('#');
				$("#getPrice").html("Giá: " + arr[0] + " $");
				$("#price").val(arr[0]);
				if (arr[1] == 0) {
					$("#cartButton").hide();
					$("#Availability").text("Hết Hàng");
				} else {
					$("#cartButton").show();
					$("#Availability").text("Còn Hàng");
				}

            }, error: function () {
                alert('Error');
            }
        });
	});
	
	///easyzoom image
	// replace main image with alternate image
	$(".changeImage").click(function () {
		var image = $(this).attr('src');
		$("#mainImage").attr("src", image);
	})

	// Instantiate EasyZoom instances
	var $easyzoom = $('.easyzoom').easyZoom();

	// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);

		e.preventDefault();

		// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});

	// Setup toggles example
	var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

	$('.toggle').on('click', function() {
		var $this = $(this);

		if ($this.data("active") === true) {
			$this.text("Switch on").data("active", false);
			api2.teardown();
		} else {
			$this.text("Switch off").data("active", true);
			api2._init();
		}
	});

	/// Validate Register form on keyup an submit
	$("#registerForm").validate({
		rules: {
			email: {
				required: true,
				email: true,
				remote: "/check-email"
			},
			name: {
				required: true,
				minlength: 2,
				accept: "[a-zA-Z]+"
			},
			password: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			name: {
				required: "Vui lòng điền tên của bạn",
				minlength: "Tên của bạn tối thiểu phải 2 ký tự",
				accept: "Tên của bạn phải bao gồm chữ cái"
			},
			password: {
				required: "Vui lòng điền mật khẩu",
				minlength: "mật khẩu của bạn tối thiểu phải 6 ký tự"
			},
			email: {
				required: "Vui lòng điền địa chỉ email",
				email: "Vui lòng điền đúng dạng email",
				remote: "Địa chỉ email này đã tồn tại"
			}
		}
	});

	/// Validate Register form on keyup an submit
	$("#LoginForm").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
		},
		messages: {
			password: {
				required: "Vui lòng điền mật khẩu"
			},
			email: {
				required: "Vui lòng điền địa chỉ email",
				email: "Vui lòng điền đúng dạng email"
			}
		}
	});

		/// Validate account form on keyup an submit
		$("#AccountForm").validate({
			rules: {
				name: {
					required: true,
					minlength: 2,
					accept: "[a-zA-Z]+"
				},
				address: {
					required: true
				},
				city: {
					required: true
				},
				state: {
					required: true
				},
				country: {
					required: true
				},
				phone_number: {
					required: true
				}
			},
			messages: {
				name: {
					required: "Vui lòng tên của bạn",
					minlength: "Tối thiểu phải 2 ký tự",
					accept: "Tên của bạn phải bao gồm chữ cái"
				},
				address: {
					required: "Vui lòng điền địa chỉ của bạn",
				},
				city: {
					required: "Vui lòng điền thành phố của bạn",
				},
				city: {
					required: "Vui lòng điền thành phố của bạn",
				},
				state: {
					required: "Vui lòng điền quận/huyện của bạn",
				},
				phone_number: {
					required: "Vui lòng điền số điện thoại của bạn",
				}
			}
		});

	/// password REGISTER Strength js
	$('#RegPassword').passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeImg : "images/user/eye.svg"
	});

	//LOGIN
	$('#LogPassword').passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: false,
		eyeImg : "images/user/eye.svg"
	});

	/// Copy billing address to shipping address script
	$("#billtoship").on('click', function () {
		if (this.checked) {
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_country").val($("#billing_country").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_phone_number").val($("#billing_phone_number").val());
		} else { 
			$("#shipping_name").val('');
			$("#shipping_country").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_address").val('');
			$("#shipping_phone_number").val('');
		}
	});

});

function selectPaymentMethod() {
	if ($('#Paypal').is(':checked') || $('#COD').is(':checked')) {
		//
	}else {
		alert('Please select Payment Method');
		return false;
	}

}
