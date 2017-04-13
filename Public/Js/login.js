$(function () {
	//jQuery Validate 表单验证
	
	/**
	 * 添加验证方法
	 * 以字母开头，5-17 字母、数字、下划线"_"
	 */
	var dialogIndex;
	jQuery.validator.addMethod("user", function(value, element) {   
	    var tel = /^[a-zA-Z][\w]{4,16}$/;
	    return this.optional(element) || (tel.test(value));
	}, " ");

	$('#login').validate({
		
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
				

			},
			pwd:{
				required:true,
				
				rangelength:[6,20]
			}
},
		messages:{
			account:{
				required:'账号不得为空',
				rangelength:'必须{0}-{1}位',
				user:'必须字母开头！',
				
			},
			pwd:{
				required:'密码不得为空！',
				rangelength:'必须是{0}-{1}位！'
			},
			
		}
	});
	$.validator.addMethod('user',function(value,element){
		var tel=/^[a-zA-Z][\w]{4,16}$/;
		return this.optional(element)||(tel.test(value));
	},"以字母开头，5-17 字母、数字、下划线'_'");

	$('#login').submit(function(e){
			e.preventDefault();
			var _this=this;
			if($(this).valid()){
				$.ajax({
					url:userLogin,
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
								location.href=shouye;
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
});