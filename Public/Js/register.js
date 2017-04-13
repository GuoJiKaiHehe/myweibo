$(function () {
var dialogIndex;
	//点击刷新验证码
	var verifyUrl = $('#verify-img').attr('src');
	$('#verify-img').click(function () {
		$(this).attr('src', verifyUrl + '?rand=' + Math.random());
	});

	$('#register').validate({
		
		errorElement:'span',
		unhightlight:function(value){
			$(value).addClass('success').show();
			$(value).parent().find('span').addClass('success').show();
		},
		highlight:function(element,errorClass){
			//console.log($(element).parent().find('span'));
			$(element).parent().find('span').removeClass('success').show();
		},
		rules:{
			account:{
				required:true,
				rangelength:[5,17],
				user:true,
				remote:{
					url:checkAccount,
					type:'post',
					dataType:'json',
					data:{
						account:function(){
							return $('#account').val();
						}
					}
				}

			},
			pwd:{
				required:true,
				
				rangelength:[6,20]
			},
			pwded:{
				equalTo:'#pwd'
			},
			uname:{
				required:true,
				rangelength:[2,10],
				remote:{
					url:checkUname,
					type:'post',
					data:{
						uname:function(){
							return $('#uname').val();
						}
					}
				}
			},
			verify:{
				required:true,
				rangelength:[4,4],
				remote:{
					url:checkVerify,
					type:'post',
					data:{
						verify:function(){
							return $('#verify').val();
						}
					}
				}
			}
		},
		messages:{
			account:{
				required:'账号不得为空',
				rangelength:'必须{0}-{1}位',
				user:'必须字母开头！',
				remote:'用户已经存在'
			},
			pwd:{
				required:'密码不得为空！',
				
				rangelength:'必须是{0}-{1}位！'
			},
			pwded:{
				equalTo:'必须和密码一致',
			},
			uname:{
				required:'不的为空',
				rangelength:'必须是{0}-{1}位！',
				remote:'昵称已经存在！'
				
			},
			verify:{
				required:'验证码不得为空！',
				rangelength:'必须是4位',
				remote:'验证码错误！'
			}
		}
	});
	$.validator.addMethod('user',function(value,element){
		var tel=/^[a-zA-Z][\w]{4,16}$/;
		return this.optional(element)||(tel.test(value));
	},"以字母开头，5-17 字母、数字、下划线'_'");

	$('#register').submit(function(e){
			e.preventDefault();
			var _this=this;
			if($(this).valid()){
				$.ajax({
					url:addUser,
					type:'post',
					dataType:'json',
					data:$(_this).serialize(),
					beforeSend:function(fon){
						dialogIndex=dialog.loading('正在提交数据中...');
					},
					success:function(data){
						dialog.close(dialogIndex);
						if(data.error=='0'){
							dialog.smile(data.msg);
							setTimeout(function(){
								_this.reset();
								location.href='/Login/index';
							},1000)
						}else{
							dialog.sad(data.msg);
						}
					},
					error:function(){
						dialog.close(dialogIndex);
					}
				})
			}else{
				dialog.sad('请填写正确信息再提交');
			}
	});

	//jQuery Validate 表单验证
	
	/**
	 * 添加验证方法
	 * 以字母开头，5-17 字母、数字、下划线"_"
	 */
/*	jQuery.validator.addMethod("user", function(value, element) {   
	    var tel = /^[a-zA-Z][\w]{4,16}$/;
	    return this.optional(element) || (tel.test(value));
	}, "以字母开头，5-17 字母、数字、下划线'_'");

	$('form[name=register]').validate({
		errorElement : 'span',
		success : function (label) {
			label.addClass('success');
		},
		rules : {
			account : {
				required : true,
				user : true,
				remote : {
					url : checkAccount,
					type : 'post',
					dataType : 'json',
					data : {
						account : function () {
							return $('#account').val();
						}
					}
				}
			},
			pwd : {
				required : true,
				user : true
			},
			pwded : {
				required : true,
				equalTo : "#pwd"
			},
			uname : {
				required : true,
				rangelength : [2,10],
				remote : {
					url : checkUname,
					type : 'post',
					dataType : 'json',
					data : {
						uname : function () {
							return $('#uname').val();
						}
					}
				}
			},
			verify : {
				required : true,
				remote : {
					url : checkVerify,
					type : 'post',
					dataType : 'json',
					data : {
						verify : function () {
							return $('#verify').val();
						}
					}
				}
			}
		},
		messages : {
			account : {
				required : '账号不能为空',
				remote : '账号已存在'
			},
			pwd : {
				required : '密码不能为空'
			},
			pwded : {
				required : '请确认密码',
				equalTo : '两次密码不一致'
			},
			uname : {
				required : '请填写您的昵称',
				rangelength : '昵称在2-10个字之间',
				remote : '昵称已存在'
			},
			verify : {
				required : ' ',
				remote : ' '
			}
		}
	});*/

});