/**
 * 首页
 * @author Carmen
 */
$(function () {
	//tab 切换；
	$('.view_line strong').click(function(){
		location.href='http://www.mywb.com/index.php/Index/index/type/'+$(this).attr('type')+'.html'
	})
	/**
	 * 上传微博图片
	 */
	$('#picture').uploadify({
		swf : PUBLIC + '/Uploadify/uploadify.swf',	//引入Uploadify核心Flash文件
		uploader : uploadUrl,	//PHP处理脚本地址
		width : 120,	//上传按钮宽度
		height : 30,	//上传按钮高度
		buttonImage : PUBLIC + '/Uploadify/browse-btn.png',	//上传按钮背景图地址
		fileTypeDesc : 'Image File',	//选择文件提示文字
		fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',	//允许选择的文件类型
		overrideEvents:['onSelectError','onSelect','onDialogClose'],
		formData : {'session_id' : sid},
		onSelectError : function (file, errorCode, errorMsg) {
			switch(errorCode) {
				case -110:
					dialog('上传文件大于1024kb');
				break;
			}
		},
		//上传成功后的回调函数
		onUploadSuccess : function (file, data, response) {
			
			var data=$.parseJSON(data);
			if (data) {
				$('.upload-btn input[name=source]').val(data.source);
				$('.upload-btn input[name=max]').val(data.max);
				$('.upload-btn input[name=medium]').val(data.mid);
				$('.upload-btn input[name=mini]').val(data.mini);
				var image='<img src="'+data.min+'"  />';
			var inputs='<input type="hidden" name="source" value='+data.source+' >'+
                '<input type="hidden" name="max" value='+data.max+' />'+
                '<input type="hidden" name="medium" value='+data.mid+' />'+
                '<input type="hidden" name="mini" value='+data.min+' />';
               var li='<li style="position:none;display:inline-block;">'+image+inputs+'</li>';
               console.log(li);
               if($('#picShow').is(':hidden')){
               		$('#picShow').show();
               }
				$('#picShow .pic_list').append(li);
			} else {
				dialog.sad('上传图片失败！');
			}
		}
	});

	






	/**
	 * 发布转入框效果
	 */
	$('.send_write textarea').focus(function () {
		//获取焦点时改变边框背景
		$('.ta_right').css('backgroundPosition', '0 -50px');
		//转入文字时
		$(this).css('borderColor', '#FFB941').keyup(function () {
			var content = $(this).val();
			//调用check函数取得当前字数
			var lengths = check(content);
			if (lengths[0] > 0) {//当前有输入内容时改变发布按钮背景
				$('.send_btn').css('backgroundPosition', '-133px -50px');
			} else {//内容为空时发布按钮背景归位
				$('.send_btn').css('backgroundPosition', '-50px -50px');
			};
			//最大允许输入140字个
			if (lengths[0] >= 140) {
				$(this).val(content.substring(0, Math.ceil(lengths[1])));
			}
			var num = 140 - Math.ceil(lengths[0]);
			var msg = num < 0 ? 0 : num;
			//当前字数同步到显示提示
			$('#send_num').html(msg);
		});
	//失去焦点时边框背景归位
	}).blur(function () {
		$(this).css('borderColor', '#CCCCCC');
		$('.ta_right').css('backgroundPosition', '0 -69px');
	});
	//内容提交时处理
	$('form[name=weibo]').submit(function (e) {
		e.preventDefault();
		var _this=this;
		//var cons = $('textarea', this);
		if ($(_this).find('textarea[name=content]').val() == '') {//内容为空时闪烁输入框
			var timeOut = 0;
			var glint = setInterval(function () {
				if (timeOut % 2 == 0) {
					cons.css('background','#FFA0C2');
				} else {
					cons.css('background','#fff');
				}
				timeOut++;
				if (timeOut > 7) {
					clearInterval(glint);
					cons.focus();
				}
			}, 100);
			return false;
		}else{
			var imgs=[];
			if($('#picShow .pic_list li').length>0){
				var lis=$('#picShow .pic_list li');
				console.log(lis);
				
				for(var i=0;i<lis.length;i++){

					imgs[i]
					var inputs=lis.eq(i).find('input');
					imgs[i]={};
					console.log(inputs);
					for(var j=0;j<inputs.length;j++){
						
						imgs[i][inputs.eq(j).attr('name')]=inputs.eq(j).val();
					}
				}
				//二维数组；
				console.log(imgs);
			}
			var dialogIndex;
			$.ajax({
				url:wb['module']+'/Index/sendWeibo',
				type:'post',
				dataType:'json',
				data:{
					'images':imgs,
					'content':$(_this).find('textarea[name=content]').val()
				},
				beforeSend:function(){
					dialogIndex=dialog.loading();
				},
				success:function(data){
					dialog.close(dialogIndex);
					if(data.error='0'){
						dialog.smile('发布成功！');
						var temp=$('#ajax_send').html();



var content=$(_this).find('textarea[name=content]').val().replace(/\[\[([\u4e00-\u9fa5]+)\]\]/ig,jiexibiaoqing);

	content=content.replace(/@(([\S]+)\s|([\S]+)$)/ig,'<a href="/u/$1">@$1</a>');
						temp=temp.replace(/#内容#/,content);
						temp=temp.replace(/#wid#/g,data.wid);
						temp=temp.replace(/#uid#/,wb['uid']);
						temp=temp.replace(/#用户名#/,wb['me']);

						var strimg='<ol>';

						if(imgs.length==1){
							for(var i =0 ;i<imgs.length;i++){
		strimg+='<li style="float:left;margin:5px;border:1px solid #ccc;padding:2px;border-radius:5px;"><img src="'+imgs[i]['medium']+'" medium="'+imgs[i]['medium']+'" max="'+imgs[i]['max']+'" source="'+imgs[i]['source']+'" class="wb_figure"  /></li>';
							}
						}else{
							for(var i =0 ;i<imgs.length;i++){
								strimg+='<li style="float:left;margin:5px;border:1px solid #ccc;padding:2px;border-radius:5px;" ><img src="'+imgs[i]['mini']+'" medium="'+imgs[i]['medium']+'" max="'+imgs[i]['max']+'" source="'+imgs[i]['source']+'" class="wb_figure"  /></li>';
							}
						}
						strimg+='</ol>';
						
						var idom='<div class="wb_img clear" >'+
                                '#图片#'+
                                '<div class="img_tool clear" style="display:none;">'+
                                    '<ul>'+
                                        '<li>'+
                                            '<i class="icon icon-packup"></i>'+
                                            '<span class="packup">&nbsp;收起</span>'+
                                        '</li>'+
                                        '<li>|</li>'+
                                        '<li>'+
                                            '<i class="icon icon-bigpic"></i>'
                                            '<a href="__ROOT__/Uploads/Pic/#max#" "target=_blank">&nbsp;查看大图</a>'+
                                       '</li>'+
                                    '</ul>'+
                                    '<div class="img_info">'+
                                    '<img src="__ROOT__/Uploads/Pic/#medium#"/>'+
                                    '</div>'+
                                '</div>'+
                           ' </div>';

                           idom=idom.replace(/#图片#/g,strimg);


                       temp=temp.replace('#thumb#',idom);
                       temp=temp.replace(/#myface#/,$('.myface').attr('src'));
						$('.view_line').after(temp);
						$('#picShow .pic_list').html('');
						$(_this).find('textarea[name=content]').val('');

					}else{
						dialog.sad(data.msg);
					}
				},
				error:function(){
					dialog.close(dialogIndex);
				}
			})
		}

	});

	//显示图片上传框
	$('.icon-picture').click(function () {
		$('#phiz').hide();
		$('#upload_img').show();
	});


	$('body').on('click','.packup',function(){
		$(this).parent().parent().parent().hide(1000);
	})
	/**
	 * 图片点击放大处理
	 */
	/*$('.mini_img').click(function () {
		$(this).hide().next().show();
	});
	$('.img_info img').click(function () {
		$(this).parents('.img_tool').hide().prev().show();
	});
	$('.packup').click(function () {
		$(this).parent().parent().parent().hide().prev().show();
	});
	$('.turn_mini_img').click(function () {
		$(this).hide().next().show();
	});
	$('.turn_img_info img').click(function () {
		$(this).parents('.turn_img_tool').hide().prev().show();
	});*/

	
	 $('body').on('click','.wb_figure',function(){

	 	
	 	if($(this).parent().parent().next().is(':hidden')){
	 		var img_info=$(this).parent().parent().next().show(1000);

	 		
	 		if(img_info.find('img').length<1){
	 			alert('');
	 			var img='<div class="img_info">'+
	                '<img src="/Uploads/Pic/#medium#"/>'+
	                '</div>';
	 			img_info.find('ul').after(img);
	 		}
	 		img_info.find('img').attr('src',$(this).attr('medium'));
	 	//alert($(this).attr('source'));
	 	img_info.find('a[target=_blank]').attr('href',$(this).attr('source'));
	 	}
	 	

	 });


	 	/**
	 * 转发框处理
	 */
	 	$('body').on('click','.turn',function(){
var mul=0;
var tid=$(this).attr('tid');
	 	if($(this).attr("mul")=='true'){
	 		mul=1;
	 	}

	 	//获取原微内容并添加到转发框
	 //	console.log($(this).parent().parent().parent());
	 	var orgObj = $(this).parent().parent().parent().prev();
	 	console.log(orgObj);
	 	var author = $.trim(orgObj.find('.author').html());
	 	var content = orgObj.find('.content p').html();
	 	var wid = $(this).attr('id');
	 	//alert(author);
	 //	alert(wid);
	 	var cons = '';
	 	content2=content.replace(/\<img\s+(.*)+title="(.*)"\>/gi,'\[\[$2\]\]');
	 	//多重转发时，转发框内容处理
	 	if (wid) {
	 		author = orgObj.find('.author a').html();
	 		cons = replace_weibo(' // @' + author + ' : ' + content2);
	 		author = $.trim(orgObj.find('.turn_name').html());
	 		//content = orgObj.find('.turn_cons p').html();
	 	}

	 	$('.turn_main p').html(author + ' : ' + content);
	 	$('.turn-cname').html(author);
	 	$('form[name=turn] textarea').val(cons);

		$('form[name=turn]').find('p').html(content);
	 	//提取原微博ID
	 	
	 	$('form[name=turn] input[name=id]').val($(this).attr('id'));
	 	$('form[name=turn] input[name=tid]').val();

	 	//隐藏表情框
	 	$('#phiz').hide();
	 	//点击转发创建透明背景层
	 	createBg('opacity_bg');
	 	//定位转发框居中
	 	var turnLeft = ($(window).width() - $('#turn').width()) / 2;
	 	var turnTop = $(document).scrollTop() + ($(window).height() - $('#turn').height()) / 2;
	 	$('#turn').css({
	 		'left' : turnLeft,
	 		'top' : turnTop
	 	}).fadeIn().find('textarea').focus(function () {
	 		$(this).css('borderColor', '#FF9B00').keyup(function () {
				var content = $(this).val();
				var lengths = check(content);  //调用check函数取得当前字数
				//最大允许输入140个字
				if (lengths[0] >= 140) {
					$(this).val(content.substring(0, Math.ceil(lengths[1])));
				}
				var num = 140 - Math.ceil(lengths[0]);
				var msg = num < 0 ? 0 : num;
				//当前字数同步到显示提示
				$('#turn_num').html(msg);
			});
	 	}).focus().blur(function () {
	 		$(this).css('borderColor', '#CCCCCC');	//失去焦点时还原边框颜色
	 	});

	 	$('form[name=turn]').submit(function(e){
	 		//alert('');
	 	e.preventDefault();
		var _this=this;
		//var cons = $('textarea', this);
		if ($(_this).find('textarea[name=content]').val() == '') {//内容为空时闪烁输入框
			var timeOut = 0;
			var glint = setInterval(function () {
				if (timeOut % 2 == 0) {
					cons.css('background','#FFA0C2');
				} else {
					cons.css('background','#fff');
				}
				timeOut++;
				if (timeOut > 7) {
					clearInterval(glint);
					cons.focus();
				}
			}, 100);
			return false;
		}else{
			var imgs=[];
			var becomment=$(_this).find('input[name=becomment]').attr("checked")=='checked' ? wid : 0;

			var dialogIndex;
			$.ajax({
				url:wb['module']+'/Index/sendWeibo',
				type:'post',
				dataType:'json',
				data:{
					'id':wid,
					'content':$(_this).find('textarea[name=content]').val(),
					'mul':mul? tid : 0,
					'becomment':becomment,
				},
				beforeSend:function(){
					dialogIndex=dialog.loading();
				},
				success:function(data){
					dialog.close(dialogIndex);
					if(data.error='0'){
						dialog.smile('转发成功');
						location.reload();


						
						var temp=$('#ajax_send').html();



var content=$(_this).find('textarea[name=content]').val().replace(/\[\[([\u4e00-\u9fa5]+)\]\]/ig,jiexibiaoqing);

	content=content.replace(/@(([\S]+)\s|([\S]+)$)/ig,'<a href="/u/$1">@$1</a>');
						temp=temp.replace(/#内容#/,content);
						temp=temp.replace(/#wid#/g,data.wid);
						temp=temp.replace(/#uid#/,wb['uid']);
						temp=temp.replace(/#用户名#/,wb['me']);

						var strimg='<ol>';

						
						strimg+='</ol>';
						
						var idom='<div class="wb_img clear" >'+
                                '#图片#'+
                                '<div class="img_tool clear" style="display:none;">'+
                                    '<ul>'+
                                        '<li>'+
                                            '<i class="icon icon-packup"></i>'+
                                            '<span class="packup">&nbsp;收起</span>'+
                                        '</li>'+
                                        '<li>|</li>'+
                                        '<li>'+
                                            '<i class="icon icon-bigpic"></i>'
                                            '<a href="__ROOT__/Uploads/Pic/#max#" "target=_blank">&nbsp;查看大图</a>'+
                                       '</li>'+
                                    '</ul>'+
                                    '<div class="img_info">'+
                                    '<img src="__ROOT__/Uploads/Pic/#medium#"/>'+
                                    '</div>'+
                                '</div>'+
                           ' </div>';

                           idom=idom.replace(/#图片#/g,strimg);


                       temp=temp.replace('#thumb#',idom);
                       temp=temp.replace(/#myface#/,$('.myface').attr('src'));
						$('.view_line').after(temp);
						
						$(_this).find('textarea[name=content]').val('');

					}else{
						dialog.sad(data.msg);
					}
				},
				error:function(){
					dialog.close(dialogIndex);
				}
			})
		}

	 	})

	 });
	drag($('#turn'), $('.turn_text'));  //拖拽转发框

	/**
	 * 滚动获取微博列表；
	 * 
	 */

	/**
	 * 收藏微博
	 */

	$('body').on('click','.keep',function(){

	
		var wid = $(this).attr('wid');
		var msg = '';

		$.post(keepUrl, {wid : wid}, function (data) {
			if (data == 1) {
				msg = '收藏成功';
			}

			if (data == -1) {
				msg = '已收藏';
			}

			if (data == 0) {
				msg = '收藏失败';
			}

			dialog.smile(msg);
			setTimeout(function(){
				location.reload();
			}, 1000);
		}, 'json');
		
	});


	/**
	 * 评论框处理
	 */
	//点击评论时异步提取数据
		
		$('body').on('click','.comment',function(e){
			e.preventDefault();
		
		if(!$(this).parent().parent().parent().next().next().is(':hidden')){
			var commentLoad = $(this).parent().parent().parent().next().hide();
			var commentList = commentLoad.next().hide();
			
		}else{
		//异步加载状态DIV
		var commentLoad = $(this).parent().parent().parent().next();
		var commentList = commentLoad.next();

		//提取当前评论按钮对应微博的ID号
		var wid = $(this).attr('wid');
		//异步提取评论内容
		//if()
		$.ajax({
			url : getComment,
			data : {wid : wid},
			dataType : 'html',
			type : 'post',
			beforeSend : function () {
				commentLoad.show();
			},
			success : function (data) {
				if (data) {
					commentList.find('.com_box').html(data);

				}
			},
			complete : function () {
				commentLoad.hide();
				commentList.show().find('textarea').val('').focus();
			}
		});

	}
	});

	//评论输入框获取焦点时改变边框颜色
	$('.comment_list textarea').focus(function () {
		$(this).css('borderColor', '#FF9B00');
	}).blur(function () {
		$(this).css('borderColor', '#CCCCCC');
	}).keyup(function () {
		var content = $(this).val();
		var lengths = check(content);  //调用check函数取得当前字数
		//最大允许输入140个字
		if (lengths[0] >= 140) {
			$(this).val(content.substring(0, Math.ceil(lengths[1])));
		}
	});

	//回复
	$('.reply a').live('click', function () {
		var reply = $(this).parent().siblings('a').html();
		$(this).parents('.comment_list').find('textarea').val('回复@' + reply + ' ：');
		return false;
	});
	//提交评论

	$('body').on('click','.comment_btn',function(){
		var _this=this;
		var commentList = $(this).parent().parent();
		var _textarea = commentList.find('textarea');
		//console.log(_textarea);
		var content = _textarea.val();
		console.log(content);
		//评论内容为空时不作处理
		if (content == '') {
			_textarea.focus();
			return false;
		}

		//提取评论数据
		var cons = {
			content : content,
			wid : $(_this).attr('wid'),
			uid : $(_this).attr('uid'),
			
		};

		$.post(commentUrl, cons, function (data) {
			if (data) {
					$(_textarea).val('');
					//window.location.reload();
					commentList.find('ul').after(data);
					console.log(commentList.prev().prev().find('.comment').find('span'));
					//location.reload();
					commentList.prev().prev().find('.comment').find('span')
									.text(parseInt(commentList.prev().prev().find('.comment').find('span').text())+1)
			} else {
				dialog.sad('评论失败！');
			}
		}, 'html');
	});

	/**
	 * 评论异步分类处理
	 */
	$('.comment-page dd').live('click', function () {
		var commentList = $(this).parents('.comment_list');
		var commentLoad = commentList.prev();
		var wid = $(this).attr('wid');
		var page = $(this).attr('page');
		//异步提取评论内容
		$.ajax({
			url : getComment,
			data : {wid : wid, page : page},
			dataType : 'html',
			type : 'post',
			beforeSend : function () {
				commentList.hide().find('dl').remove();
				commentLoad.show();
			},
			success : function (data) {
				if (data != 'false') {
					commentList.append(data);
				}
			},
			complete : function () {
				commentLoad.hide();
				commentList.show().find('textarea').val('').focus();
			}
		});
	});

	/**
	 * 删除微博
	 */
	$('.weibo').hover(function () {
		$(this).find('.del-li').show();
	}, function () {
		$(this).find('.del-li').hide();
	});
	$('.del-weibo').click(function () {
		var wid = $(this).attr('wid');
		var isDel = confirm('确认要删除该微博？');
		var obj = $(this).parents('.weibo');

		if (isDel) {
			$.post(delWeibo, {wid : wid}, function (data) {
				if (data) {
					obj.slideUp('slow', function () {
						obj.remove();
					});
				} else {
					alert('删除失败请重试...');
				}
			}, 'json');
		}
	});



    /**
     * 表情处理
     * 以原生JS添加点击事件，不走jQuery队列事件机制
     */
  	var phiz = $('.phiz');
  	$('body').on('click','.phiz',function(){

  	
  			//定位表情框到对应位置
			$('#phiz').show().css({
				'left' : $(this).offset().left,
				'top' : $(this).offset().top + $(this).height() + 5
    		});
    		//为每个表情图片添加事件
            var phizImg = $("#phiz img");
            var sign = this.getAttribute('sign');
            for (var i = 0; i < phizImg.length; i++){
            	phizImg[i].onclick = function () {
				var content = $('textarea[sign = '+sign+']');
				content.val(content.val() + '[[' + $(this).attr('title') + ']]');
				$('#phiz').hide();
            	}
            }
  	
  		})
  	//关闭表情框
	$('.close').hover(function () {
		$(this).css('backgroundPosition', '-100px -200px');
	}, function () {
		$(this).css('backgroundPosition', '-75px -200px');
	}).click(function () {
		$(this).parent().parent().hide();
		$('#phiz').hide();
		if ($('#turn').css('display') == 'none') {
			$('#opacity_bg').remove();
		};
	});

});




/**
 * 统计字数
 * @param  字符串
 * @return 数组[当前字数, 最大字数]
 */
function check (str) {
	var num = [0, 140];
	for (var i=0; i<str.length; i++) {
		//字符串不是中文时
		if (str.charCodeAt(i) >= 0 && str.charCodeAt(i) <= 255){
			num[0] = num[0] + 0.5;//当前字数增加0.5个
			num[1] = num[1] + 0.5;//最大输入字数增加0.5个
		} else {//字符串是中文时
			num[0]++;//当前字数增加1个
		}
	}
	return num;
}

/**
 * 替换微博内容，去除 <a> 链接与表情图片
 */
function replace_weibo (content) {
	content = content.replace(/<img.*?title=['"](.*?)['"].*?\/?>/ig, '[$1]');
	content = content.replace(/<a.*?>(.*?)<\/a>/ig, '$1');
	return content.replace(/<span.*?>\&nbsp;(\/\/)\&nbsp;<\/span>/ig, '$1');
}



