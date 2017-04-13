<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <script type="text/javascript" src='/Public/Js/jquery-1.7.2.min.js'></script>
    <script type='text/javascript' src='/Public/layer/layer.js'></script>
    <script type='text/javascript' src='/Public/layer/dialog.js'></script>
   
    <title><?php echo (C("WEBNAME")); ?>-修改个人资料</title>
    <link rel="stylesheet" href="/Public/Theme/default/Css/nav.css" />
    <link rel="stylesheet" href="/Public/Theme/default/Css/edit.css" />
    <link rel="stylesheet" href="/Public/Uploadify/uploadify.css"/>
    <script type="text/javascript" src='/Public/Js/jquery-1.7.2.min.js'></script>
    <script type="text/javascript" src='/Public/Js/nav.js'></script>
    <script type='text/javascript' src='/Public/Js/city.js'></script>
    
    <script type='text/javascript' src='/Public/Js/edit.js'></script>
    <script type="text/javascript" src='/Public/Uploadify/jquery.uploadify.min.js'></script>
    <script type="text/javascript" src="/Public/Js/jquery-validate.js"></script>
    <script type='text/javascript'>
        
        var address = "<?php echo ($user["location"]); ?>";
        var constellation = "<?php echo ($user["constellation"]); ?>";
        var PUBLIC = '/Public';
        var uploadUrl = '<?php echo U("Common/uploadFace");?>';
        var sid = '<?php echo session_id();?>';
        var ROOT = '';
        var saveFace="<?php echo U('saveFace');?>";

    </script>
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
    <!--=====右侧=====-->
        <div id='right'>
            <ul id='sel-edit'>
                <li class='edit-cur'>基本信息</li>
                <li>修改头像</li>
                <li>修改密码</li>
            </ul>
            <div class='form'>
                <form  method='post' id="editinfo">
                    <p>
                        <label for=""><span class='red'>*</span>昵称：</label>
                        <input type="text" name='nickname' value='<?php echo ($user["username"]); ?>' class='input'/>
                    </p>
                    <p>
                        <label for="">真实名称：</label>
                        <input type="text" name='truename' value='<?php echo ($user["truename"]); ?>' class='input'/>
                    </p>
                    <p>
                        <label for=""><span class='red'>*</span>性别：</label>
                        <input type="radio" name='sex' value='1' <?php if($user["sex"] == "男"): ?>checked='checked'<?php endif; ?>/>&nbsp;男&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name='sex' value='2' <?php if($user["sex"] == "女"): ?>checked='checked'<?php endif; ?>/>&nbsp;女
                    </p>
                    <p>
                        <label for=""><span class='red'>*</span>所在地：</label>
                        <select name="province" id="">
                            <option value="">请选择</option>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="city">
                            <option value="">请选择</option>
                        </select>
                    </p>
                    <p>
                        <label for="">星座：</label>
                        <select name="night" id="">
                            <option value="">请选择</option>
                            <option value="白羊座">白羊座</option>
                            <option value="金牛座">金牛座</option>
                            <option value="双子座">双子座</option>
                            <option value="巨蟹座">巨蟹座</option>
                            <option value="狮子座">狮子座</option>
                            <option value="处女座">处女座</option>
                            <option value="天秤座">天秤座</option>
                            <option value="天蝎座">天蝎座</option>
                            <option value="射手座">射手座</option>
                            <option value="魔羯座">魔羯座</option>
                            <option value="水瓶座">水瓶座</option>
                            <option value="双鱼座">双鱼座</option>
                        </select>
                    </p>
                    <p>
                        <label for="" class='intro'>一句话介绍自己：</label>
                        <textarea name="intro"><?php echo ($user["intro"]); ?></textarea>
                    </p>
                    <p>
                        <input type="submit" value='保存修改' class='edit-sub'/>
                    </p>
                </form>
            </div>
            <div class='form hidden'>
                <form  method='post' id="save_face">
                    <div class='edit-face'>
                        <img src="<?php echo ($user['face180']); ?>" width='180' height='180' id='face-img'/>
                        <p>
                            <input type="file" name='face' id='face'/>
                        </p>
                        <p>
                            <input type="hidden" name='face180' value=''/>
                            <input type="hidden" name='face80' value=''/>
                            <input type="hidden" name='face50' value=''/>
                            <input type="submit" value='保存修改' class='edit-sub' />
                        </p>
                    </div>
                </form>
            </div>
            <div class='form hidden'>
                <form action="<?php echo U('editPwd');?>" method='post' name='editPwd'>
                    <p class='account'>登录邮箱：<span>admin@admin.com</span></p>
                    <p>
                        <label for=""><span class='red'>*</span>旧密码：</label>
                        <input type="password" name='old' class='input'/>
                    </p>
                    <p>
                        <label for=""><span class='red'>*</span>新密码：</label>
                        <input type="password" name='new' class='input' id='new'/>
                    </p>
                    <p>
                        <label for=""><span class='red'>*</span>确认密码：</label>
                        <input type="password" name='newed' class='input'/>
                    </p>
                    <p>
                        <input type="submit" value='确认修改' class='edit-sub'/>
                    </p>
                </form>
            </div>
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