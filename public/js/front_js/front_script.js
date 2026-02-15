$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#sort").on('change', function() {
        var sort = $(this).val();
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        })
    });

    $(".fabric").on('click',function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
            $.ajax({
                url:url,
                method:"post",
                data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
                success:function(data) {
                    $('.filter_products').html(data);
                }
            })
    });

    $(".sleeve").on('click',function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        })
    });

    $(".pattern").on('click',function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        })
    });

    $(".fit").on('click',function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        })
    });

    $(".occasion").on('click',function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        })
    });

    function get_filter(class_name) {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
           filter.push($(this).val());
        });
        return filter;
    }

    $("#getPrice").change(function() {
        var size = $(this).val();
        if(size=="") {
            alert("გთხოვთ აირჩიოთ ზომა");
            return false;
        }
        var product_id = $(this).attr("product-id");
        $.ajax({
            url:'/get-product-price',
            data:{size:size,product_id:product_id},
            type:'post',
            success:function(resp) {
                if(resp['discount']>0) {
                    $(".getAttrPrice").html("<del>" + resp['product_price'] + " ₾.</del> " + resp['final_price']+" ₾.");
                }else {
                    $(".getAttrPrice").html(resp['product_price']+" ₾.");
                }

            },error:function() {
                alert("Error");
            }
        });
    });
    // Update Cart Items
    $(document).on('click','.btnItemUpdate',function(){
        if($(this).hasClass('qtyMinus')) {
            // if qtyMinus button gets clicked by User
            let quantity = $(this).prev().val();
            if(quantity<=1) {
                alert("პროდუქტის დასაშვები რაოდენობაა 1 ან მეტი!");
                return false;
            }else {
                new_qty = parseInt(quantity)-1;
            }
        }
        if($(this).hasClass('qtyPlus')) {
            // if qtyPlus button gets clicked by User
            let quantity = $(this).prev().prev().val();
            new_qty = parseInt(quantity)+1;
        }
        let cartid = $(this).data('cartid');
        $.ajax({
            data:{"cartid":cartid,"qty":new_qty},
            url:"/update-cart-item-qty",
            type:"post",
            success:function(resp) {
                if(resp.status==false) {
                    alert(resp.message);
                }
                $(".totalCartItems").html(resp.totalCartItems);
                $("#AppendCartItems").html(resp.view);
            },error:function() {
                alert("წარმოიშვა შეცდომა!");
            }
        });
    });

     // Delete Cart Items
     $(document).on('click','.btnItemDelete',function(){
        let cartid = $(this).data('cartid');
        let result = confirm("გსურთ კალათიდან პროდუქტის წაშლა?");
        if(result) {
            $.ajax({
                data:{"cartid":cartid},
                url:"/delete-cart-item",
                type:"post",
                success:function(resp) {
                    $(".totalCartItems").html(resp.totalCartItems);
                    $("#AppendCartItems").html(resp.view);
                },error:function() {
                    alert("წარმოიშვა შეცდომა!");
                }
            });
        }

    });

    // validate register form on keyup and submit
		$("#registerForm").validate({
			rules: {
				name: "required",
				mobile: {
					required: true,
					minlength: 9,
                    maxlength: 14,
                    digits: true
				},
				email: {
					required: true,
					email: true,
                    remote: "check-email"
				},
                password: {
					required: true,
					minlength: 6
				},
			},
			messages: {
				name: "გთხოვთ შეიყვანოთ სახელი / გვარი",
				mobile: {
					required: "გთხოვთ შეიყვანოთ ტელ. ნომერი",
					minlength: "ტელეფონის ნომერი დაუშვებელია 9 რიცხვზე ნაკლები",
                    maxlength: "ტელეფონის ნომერი დაუშვებელია 14 რიცხვზე მეტი",
                    digits: "გთხოვთ შეიყვანოთ ვალიდური ტელეფონის ნომერი"
				},
				email: {
					required: "გთხოვთ შეიყვანოთ თქვენი ელ.ფოსტის მისამართი",
					email: "გთხოვთ შეიყვანოთ ვალიდური ელ.ფოსტის მისამართი",
                    remote: "ელ.ფოსტა უკვე დარეგისტრირებულია"
				},
				password: {
					required: "გთხოვთ შეიყვანოთ პაროლი",
					minlength: "პაროლი უნდა შედგებოდეს მინიმუმ 6 სიმბოლოსგან",
				}
			}
		});


        // validate login form on keyup and submit
		$("#loginForm").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
                password: {
					required: true,
					minlength: 6
				},
			},
			messages: {
				email: {
					required: "გთხოვთ შეიყვანოთ თქვენი ელ.ფოსტის მისამართი",
					email: "გთხოვთ შეიყვანოთ ვალიდური ელ.ფოსტის მისამართი"
				},
				password: {
					required: "გთხოვთ შეიყვანოთ პაროლი",
					minlength: "პაროლი უნდა შედგებოდეს მინიმუმ 6 სიმბოლოსგან",
				}
			}
		});

        // update details form
		$("#accountForm").validate({
			rules: {
				name: {
                    required: true,
                  accept: "[a-zA-Z]+"
                },
				mobile: {
					required: true,
					minlength: 9,
                    maxlength: 14,
                    digits: true
				}
			},
			messages: {
				name: {
                    required: "გთხოვთ შეიყვანოთ სახელი / გვარი",
                    accept: "გთხოვთ შეიყვანოთ ვალიდური სახელი/გვარი"
                },
				mobile: {
					minlength: "ტელეფონის ნომერი დაუშვებელია 9 რიცხვზე ნაკლები",
                    maxlength: "ტელეფონის ნომერი დაუშვებელია 14 რიცხვზე მეტი",
                    digits: "გთხოვთ შეიყვანოთ ვალიდური ტელეფონის ნომერი"
				}
			}
		});

         // update details form
		$("#passwordForm").validate({
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
			}
		});

    // Check Current User Password
    $("#current_pwd").keyup(function() {
        let current_pwd = $(this).val();
        $.ajax({
            type: 'post',
            url: '/check-user-pwd',
            data: {current_pwd:current_pwd},
            success: function(resp) {
                if(resp=="false") {
                    $("#chkPwd").html("<font color='red'>მიმდინარე პაროლი არასწორია</font>");
                }else if(resp=="true") {
                    $("#chkPwd").html("<font color='green'>მიმდინარე პაროლი სწორია</font>");
                }
            },error: function() {
                alert("წარმოიშვა შეცდომა!");
            }
        });
    });

    // Apply Coupon
   $("#ApplyCoupon").submit(function() {
        let user = $(this).attr("user");
        if(user==1) {
            // do nothing
        }else {
            alert("გთხოვთ შეხვიდეთ თქვენს აქაუნთში კუპონის გამოსაყენებლად!");
            return false;
        }
        let code = $("#code").val();
        $.ajax({
            type: 'post',
            data: {code:code},
            url: '/apply-coupon',
            success: function(resp) {
                if(resp.message!="") {
                    alert(resp.message);
                }
                $(".totalCartItems").html(resp.totalCartItems);
                $("#AppendCartItems").html(resp.view);
                if(resp.couponAmount>=0) {
                    $(".couponAmount").text("0 ₾.");
                }else {
                    $(".couponAmount").text(resp.couponAmount+"₾.");
                }
                if(resp.grand_total>=0) {
                    $(".grand_total").text(resp.grand_total+"₾.");
                }

            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
   });

   // Delete Delivery Address
    $(document).on('click', '.addressDelete', function() {
        let result = confirm("გსურთ მისამართის წაშლა?");
        if(!result) {
            return false;
        }
    });
});
