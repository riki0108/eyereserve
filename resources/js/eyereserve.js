// タブで表示内容切り替え機能
$(function(){
    $("#clickLogin").on("click" ,function(){
        console.log("login");
        $("#clickRegistration").addClass("active");
        $("#clickLogin").removeClass("active");

        $("#registration").addClass("none");
        $("#login").removeClass("none");

    })

    $("#clickRegistration").on("click" ,function(){
        console.log("registration");
        $("#clickLogin").addClass("active");
        $("#clickRegistration").removeClass("active");

        $("#login").addClass("none");
        $("#registration").removeClass("none");

    })
});

// 非同期で入力値のチェック
$(function(){
    console.log("validate");
	$('#reg').validate({
		rules:{
            tel:{
                number:true,
            },
            mail2:{
                equalTo:'input[name=mail]',
            },
            password:{
                password:true,
            }
		},
		messages:{
			tel:{
                number:"数字で入力してください"
            },
            mail2:{
                equalTo:'メールアドレスと確認用メールアドレスが一致しません。'
            }
		},
		errorPlacement:function(error,element){
            if(element.attr("name")=="tel"){
				error.insertAfter("#telError");
			}
			else if(element.attr("name")=="mail2"){
				error.insertAfter("#mailError");
			}
			else if(element.attr("name")=="password"){
				error.insertAfter("#passwordError");
			}
        },
        highlight: function(element, errorClass) {
            $(element).fadeOut(function() {
              $(element).fadeIn()
            })
        },
        submitHandler:function(form){
            // ボタンを非活性
            $('#submit_button').prop('disabled', true);
            form.submit();
        }
    });
    jQuery.validator.addMethod(
        "password",
        function(val,elem){
          reg = new RegExp("^[0-9a-zA-Z]+$");
          return this.optional(elem) || reg.test(val);
        },
        "パスワードは半角英数字で入力してください"
      );
});