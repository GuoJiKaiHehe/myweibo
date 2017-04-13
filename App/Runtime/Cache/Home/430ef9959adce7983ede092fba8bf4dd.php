<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <script type="text/javascript" src='/Public/Js/jquery-1.7.2.min.js'></script>
    <script type='text/javascript' src='/Public/layer/layer.js'></script>
    <script type='text/javascript' src='/Public/layer/dialog.js'></script>
   
	<title><?php echo (C("WEBNAME")); ?>-微博找人</title>
	<link rel="stylesheet" href="/Public/Theme/default/Css/nav.css" />
	<link rel="stylesheet" href="/Public/Theme/default/Css/sech_user.css" />
	<link rel="stylesheet" href="/Public/Theme/default/Css/bottom.css" />
	<script type="text/javascript" src='/Public/Js/jquery-1.7.2.min.js'></script>
     <script type="text/javascript" src='/Public/layer/layer.js'></script>
      <script type="text/javascript" src='/Public/layer/dialog.js'></script>
    <script type="text/javascript" src='/Public/Js/nav.js'></script>
<!--==========顶部固定导行条==========-->

<script type='text/javascript'>
    var delFollow = "<?php echo U('Common:delFollow');?>";
    var editStyle = "<?php echo U('Common:editStyle');?>";
    var getMsgUrl = "<?php echo U('Common:getMsg');?>";
    var wb={
            'module':"/index.php/Home",
            'me':"<?php echo session('user')['username'];?>",
            'uid':"<?php echo session('user')['id'];?>",

        };

</script>
</head>
<body>
<!--==========顶部固定导行条==========-->
    <div id='top_wrap'>
        <div id="top">
            <div class='top_wrap'>
                <div class="logo fleft"></div>
                <ul class='top_left fleft'>
                    <li class='cur_bg'><a href='/index.php'>首页</a></li>
                    <li><a href="<?php echo U('User/letter');?>">私信</a></li>
                    <li><a href="<?php echo U('User/comment');?>">评论</a></li>
                    <li><a href="<?php echo U('User/atme');?>">@我</a></li>
                </ul>
                <div id="search" class='fleft'>
                    <form action='<?php echo U("Search/searchUser");?>' method='get'>
                        <input type='text' name='keyword' id='sech_text' class='fleft' value='搜索微博、找人'/>
                        <input type='submit' value='' id='sech_sub' class='fleft'/>
                    </form>
                </div>
                <div class="user fleft">
                    <a href="<?php echo U('/u/' . session('user')['id']);?>"><?php echo session('user')['username'];?></a>

                </div>
                 <img src="<?php echo ($face); ?>" alt="" style="border-radius:50%;display:none;" width="50" height="50" class="myface" />
                <ul class='top_right fleft'>
                    <li title='快速发微博' class='fast_send'><i class='icon icon-write'></i></li>
                    <li class='selector'><i class='icon icon-msg'></i>
                        <ul class='hidden'>
                            <li><a href="<?php echo U('User/comment');?>">查看评论</a></li>
                            <li><a href="<?php echo U('User/letter');?>">查看私信</a></li>
                            <li><a href="<?php echo U('User/keep');?>">查看收藏</a></li>
                            <li><a href="<?php echo U('User/atme');?>">查看@我</a></li>
                        </ul>
                    </li>
                    <li class='selector'><i class='icon icon-setup'></i>
                        <ul class='hidden'>
                            <li><a href="<?php echo U('UserSetting/index');?>">帐号设置</a></li>
                            <li><a href="" class='set_model'>模版设置</a></li>
                            <li><a href="<?php echo U('Index/logout');?>">退出登录</a></li>
                        </ul>
                    </li>
                <!--信息推送-->
                    <li id='news' class='hidden'>
                        <i class='icon icon-news'></i>
                        <ul>
                            <li class='news_comment hidden'>
                                <a href="<?php echo U('User/comment');?>"></a>
                            </li>
                            <li class='news_letter hidden'>
                                <a href="<?php echo U('User/letter');?>"></a>
                            </li>
                            <li class='news_atme hidden'>
                                <a href="<?php echo U('User/atme');?>"></a>
                            </li>
                        </ul>
                    </li>
                <!--信息推送-->
                </ul>
            </div>
        </div>
    </div>
<!--==========顶部固定导行条==========-->
<!--==========加关注弹出框==========-->

<?php  $group = M('group')->where(array('uid' => session('user')['id']))->select(); ?>
    <script type='text/javascript'>
        var addFollow = "<?php echo U('Common/addFollow');?>";
    </script>

    <div id='follow'>
        <div class="follow_head">
            <span class='follow_text fleft'>关注好友</span>
        </div>
        <div class='sel-group'>
            <span>好友分组：</span>
            <select name="gid" id="gselect">
               
            </select>
        </div>
        <div class='fl-btn-wrap'>
            <input type="hidden" name='follow'/>
            <span class='add-follow-sub'>关注</span>
            <span class='follow-cencle'>取消</span>
        </div>
    </div>
<!--==========加关注弹出框==========-->

<!--==========自定义模版==========-->
    <div id='model' class='hidden'>
        <div class="model_head">
            <span class="model_text">个性化设置</span>
            <span class="close fright"></span>
        </div>
        <ul>
            <li style='background:url(/Public/Images/default.jpg) no-repeat;' theme='default'></li>
            <li style='background:url(/Public/Images/style2.jpg) no-repeat;' theme='style2'></li>
            <li style='background:url(/Public/Images/style3.jpg) no-repeat;' theme='style3'></li>
            <li style='background:url(/Public/Images/style4.jpg) no-repeat;' theme='style4'></li>
        </ul>
        <div class='model_operat'>
            <span class='model_save'>保存</span>
            <span class='model_cancel'>取消</span>
        </div>
    </div>
<!--==========自定义模版==========-->
<!--==========内容主体==========-->
	<div style='height:60px;opcity:10'></div>
    <div class="main">
    <!--=====左侧=====-->
        <!--=====左侧=====-->
    <div id="left" class='fleft'>
        <ul class='left_nav'>
            <li><a href="/index.php"><i class='icon icon-home'></i>&nbsp;&nbsp;首页</a></li>
            <li><a href="<?php echo U('User/atme');?>"><i class='icon icon-at'></i>&nbsp;&nbsp;提到我的</a></li>
            <li><a href="<?php echo U('User/comment');?>"><i class='icon icon-comment'></i>&nbsp;&nbsp;评论</a></li>
            <li><a href="<?php echo U('User/letter');?>"><i class='icon icon-letter'></i>&nbsp;&nbsp;私信</a></li>
            <li><a href="<?php echo U('User/keep');?>"><i class='icon icon-keep'></i>&nbsp;&nbsp;收藏</a></li>
        </ul>
        <div class="group">
            <fieldset><legend>分组</legend></fieldset>
            <ul>
                <?php $group = M("group")->where(array('uid' => session('uid')))->select(); ?>
                <li><a href="/index.php"><i class='icon icon-group'></i>&nbsp;&nbsp;全部</a></li>
                <?php if(is_array($group)): foreach($group as $key=>$v): ?><li>
                        <a href="<?php echo U('Index/index', array('gid' => $v['id']));?>"><i class='icon icon-group'></i>&nbsp;&nbsp;<?php echo ($v["name"]); ?></a>
                    </li><?php endforeach; endif; ?>
            </ul>
            <span id='create_group'>创建新分组</span>
            <?php $groups=M('group')->where(array('uid'=>session('user')['id']))->select(); ?>
            <ul>
            <?php if(is_array($groups)): foreach($groups as $key=>$group): ?><li><a href="<?php echo U('Index/index',array('gid'=>$group['id']));?>"><?php echo ($group['name']); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
    
    <!--==========创建分组==========-->
    <script type='text/javascript'>
        var addGroup = "<?php echo U('Common:addGroup');?>";
    </script>
    <div id='add-group'>
        <div class="group_head">
            <span class='group_text fleft'>创建好友分组</span>
        </div>
        <div class='group-name'>
            <span>分组名称：</span>
            <input type="text" name='name' id='gp-name'>
        </div>
        <div class='gp-btn-wrap'>
            <span class='add-group-sub'>添加</span>
            <span class='group-cencle'>取消</span>
        </div>
    </div>
    <!--==========创建分组==========-->
        <div id='right'>s
    		<p id='sech-logo'></p>
    		<div id='sech'>
    			<div>
	    			<form action="<?php echo U('searchUser');?>" method='get' name='search'>
	    				<input type="text" name='keyword' id='sech-cons' value='<?php if($keyword): echo ($keyword); else: ?>搜索微博、找人<?php endif; ?>'/>
	    				<input type="submit" value='搜&nbsp;索' id='sech-sub'/>
	    			</form>
    			</div>
    			<ul>
                    <li><span class='cur sech-type' url="<?php echo U('sechUser');?>">找人</span></li>
    				<li><span class='sech-type' url="<?php echo U('sechWeibo');?>">微博</span></li>
    			</ul>
    		</div>
    		<?php if(isset($result)): ?><div id='content'>
    			<?php if($result): ?><div class='view_line'>
	               用户
	            </div>
	            <ul>
                <h3> <strong>一共搜索出来<?php echo ($total); ?>条数据</strong></h3>
	            	<?php if(is_array($result)): foreach($result as $key=>$v): ?><li>
						<dl class='list-left'>
							<dt>
								<img src="
								<?php if($v["face80"]): echo substr($v['face80'],1);?>
								<?php else: ?>
									/Public/Images/noface.gif<?php endif; ?>" width='80' height='80'/>
							</dt>
							<dd>
								<a href="个人主页">
                                   <?php echo ($v['username']); ?>
                               
                                </a>
							</dd>
							<dd>
								<i class='icon icon-boy'></i>&nbsp;
								<span>
									<?php if($v["location"]): echo ($v["location"]); ?>
									<?php else: ?>
										该用户未填写所在地<?php endif; ?>
								</span>
							</dd>
							<dd>
								<span>关注 <a href="" class="follow_a"><?php echo ($v["follow"]); ?></a></span>
								<span class='bd-l '>粉丝 <a href="" class="fans_a"><?php echo ($v["fans"]); ?></a></span>
								<span class='bd-l '>微博 <a href=""><?php echo ($v["weibo"]); ?></a></span>
							</dd>
						</dl>
	    				<dl class='list-right'>
	    					<?php if($v["mutual"]): ?><dt>互相关注</dt>
	    						<dd class='del-follow' uid='<?php echo ($v["uid"]); ?>' type='1'>取消关注</dd>
    						<?php elseif($v["followed"]): ?>
                            	<dt>√&nbsp;已关注</dt>
                            	<dd class='del-follow' uid='<?php echo ($v["uid"]); ?>' type='1'>取消关注</dd>
                        	<?php else: ?>
	    						<dt class='add-fl' uid='<?php echo ($v["uid"]); ?>'>+&nbsp;关注</dt><?php endif; ?>
	    				</dl>
	    			</li><?php endforeach; endif; ?>
    			</ul>
        <style>
            .paginate a{
                width:15px;
                height:15px;
                border:1px solid #ccc;
                margin:0 5px;
                display:inline-block;
            }
            .paginate .current{
                background: #000;
                color:#fff;
                width:15px;
                height:15px;
                border:1px solid #ccc;
                margin:0 5px;
                display:inline-block;
            }
        </style>
    			<div style="text-align:center;padding:20px;" class="paginate"><?php echo ($page); ?></div>
    			<?php else: ?>
               
    				<p style='text-indent:7em;'>未找到与<strong style='color:red'><?php echo ($keyword); ?></strong>相关的用户</p><?php endif; ?>
	        </div><?php endif; ?>
    	</div>
    </div>
<!--==========内容主体结束==========-->
<!--==========底部==========-->
    <div id="bottom">
        
        <div id="copy">
            <div>
                <p>
                    版权所有：后盾网 京ICP备10027771号-1 站长统计 All rights reserved, houdunwang.com services for Beijing 2008-2012 
                </p>
            </div>
        </div>
    </div>

<!--[if IE 6]>
    <script type="text/javascript" src="/Public/Js/DD_belatedPNG_0.0.8a-min.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('#top','background');
        DD_belatedPNG.fix('.logo','background');
        DD_belatedPNG.fix('#sech_text','background');
        DD_belatedPNG.fix('#sech_sub','background');
        DD_belatedPNG.fix('.send_title','background');
        DD_belatedPNG.fix('.icon','background');
        DD_belatedPNG.fix('.ta_right','background');
    </script>
<![endif]-->
</body>
</html>