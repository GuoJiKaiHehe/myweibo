<?php if (!defined('THINK_PATH')) exit();?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <script type="text/javascript" src='/Public/Js/jquery-1.7.2.min.js'></script>
    <script type='text/javascript' src='/Public/layer/layer.js'></script>
    <script type='text/javascript' src='/Public/layer/dialog.js'></script>
   
    <title><?php echo (C("WEBNAME")); ?>-首页</title>
    <link rel="stylesheet" href="/Public/Theme/default/Css/nav.css" />
    <link rel="stylesheet" href="/Public/Theme/default/Css/index.css" />
    <link rel="stylesheet" href="/Public/Theme/default/Css/bottom.css" />
    <link rel="stylesheet" href="/Public/Uploadify/uploadify.css"/>
    
    <script type="text/javascript" src='/Public/Js/nav.js'></script>
    <script type="text/javascript" src='/Public/Uploadify/jquery.uploadify.min.js'></script>
     <script type="text/javascript" src='/Public/Js/Pinyin.js'></script>
    <script type="text/javascript" src='/Public/Js/index.js'></script>
    <script type='text/javascript'>
        var PUBLIC = '/Public';
        var uploadUrl = '<?php echo U("Common/uploadPic");?>';
        var sid = '<?php echo session_id();?>';
        var ROOT = '';
        var commentUrl = "<?php echo U('Index/sendComment');?>";
        var getComment = '<?php echo U("Index/getComment");?>';
        var keepUrl = '<?php echo U("Index/keep");?>';
        var delWeibo = '<?php echo U("Index/delWeibo");?>';
    </script>

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
                    <?php  $count=M('atme')->where(array('uid'=>session('user')['id']))->count(); ?>
                    <li><a href="<?php echo U('User/atme');?>">@我<span class="label label-default" style="color:#fff;padding:3px;border-radius:3px;border:1px solid #fff;"><?php echo ($count); ?></span></a></li>
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
    <div id="left" class='fleft' >
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
    <!--=====中部=====-->
        <div id="middle" class='fleft'>
        <!--微博发布框-->
            <div class='send_wrap'>
                <div class='send_title fleft'></div>
                <div class='send_prompt fright'>
                    <span>你还可以输入<span id='send_num'>140</span>个字</span>
                </div>
                <div class='send_write'>
                    <form action='<?php echo U("sendWeibo");?>' method='post' name='weibo'>
                        <textarea sign='weibo' name='content'></textarea>
                        <span class='ta_right'></span>
                        <div class='send_tool'>
                            <ul class='fleft'>
                                <li title='表情'><i class='icon icon-phiz phiz' sign='weibo'></i></li>
                                <li title='图片'><i class='icon icon-picture'></i>
                                <!--图片上传框-->
            <style>
            .clear:after{
                content:' ';
                display:block;
                clear:both;
                visibility: hidden;
            }
                #picShow{
                    border-top:1px solid #ccc;
                    width:auto;
                    height:auto;
                }
               
                #picShow .pic_list{
                    width:auto;
                    height:auto;

                }
                 #picShow .pic_list li{
                    display:inline-block;
                    float:none;
                    margin:5px;
                    padding:2px;
                    border:1px solid #ccc;
                    overflow: hidden;
                    border-radius: 8px;
                    width:80;
                    height:80px;
                }
                 #picShow .pic_list li img{
                    display:block;
                    border:none;
                 }
                 #upload_img{
                    min-height:140px;
                 }
                 #middle .send_wrap .send_tool ul li  #upload_img li{
                            float:left;
                            position:static;

                 }
            </style>
                                    <div id="upload_img" class='hidden clear' style="min-height:140px;">
                                        <div class='upload-title'><p>本地上传</p><span class='close'></span></div>
                                        <div class="upload-btn">
                                            <input type="file" name="picture" id="picture" />
                                        </div>
                                        
                                        <div id='picShow' class="clear">
                                            <ul class="pic_list clear" style="height:100%;width:100%;">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                <!--图片上传框-->

                                    
                                </li>
                            </ul>
                            <input type='submit' value='' class='send_btn fright' title='发布微博按钮'/>
                        </div>
                    </form>
                </div>
            </div>
        <!--微博发布框-->
        <style>
            .view_line a{
                text-decoration: none;display:block;
                color:#fff;
            }
        </style>
            <div class='view_line'>
                <strong type="all" <?php if(I('get.type') == 'all'): ?>class="current"<?php endif; ?> >全部微博</strong>
                <strong type="follow"  <?php if(I('get.type') == 'follow'): ?>class="current"<?php endif; ?> >我关注的</strong>
                <strong type="original"  <?php if(I('get.type') == 'original'): ?>class="current"<?php endif; ?> >原创的</strong>
                <strong type="video" <?php if(I('get.type') == 'video'): ?>class="current"<?php endif; ?> >视频</strong>
                <strong type="music"<?php if(I('get.type') == 'music'): ?>class="current"<?php endif; ?>  >音乐</strong>
                 <strong type="pic"<?php if(I('get.type') == 'pic'): ?>class="current"<?php endif; ?>  >图片</strong>
            </div>
<?php if(!$weibo): ?>没有发布的微博
<?php else: ?>
<style>
.weibo img{
    cursor:pointer;
}
    .weibo .content{
        margin:8px 4px;
    }
</style>
<?php if(is_array($weibo)): foreach($weibo as $key=>$v): if($v['isturn'] == 0): ?><!--====================普通微博样式====================-->
            <div class="weibo">
                <!--头像-->
                <div class="face">
                    <a href="<?php echo U('/u/'.$v['uid']);?>" width="50" height="50" style="width:50px;height:50px;display:block;overflow:hidden;"/>
                        <img src="/<?php echo ($v['face']); ?>" alt="" width="50" height="50">
                    </a>
                </div>
                <div class="wb_cons">
                    <dl>
                    <!--用户名-->
                        <dt class='author'>
                            <a href="<?php echo U('/u/'.$v['uid']);?>"><?php echo ($v["username"]); ?></a>
                        </dt>
                    <!--发布内容-->
                        <dd class='content'>
                            <p><?php echo ($v['content']); ?></p>
                        </dd>
                    <!--微博图片-->
                    <?php if($v['images']): ?><dd>
                        
                            <div class='wb_img clear'>
                            <!--小图-->
                                <ol><?php if($v['isfigure'] == 1): if(is_array($v['images'])): $i = 0; $__LIST__ = $v['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li style="float:left;margin:5px;border:1px solid #ccc;padding:2px;border-radius:5px;margin:5px;">
                                    <img src="<?php echo ($img['medium']); ?>" alt="" class="wb_figure" max="<?php echo ($img['max']); ?>" source="<?php echo ($img['source']); ?>" medium="<?php echo ($img['medium']); ?>">
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                        <?php if(is_array($v['images'])): $i = 0; $__LIST__ = $v['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li style="float:left;margin:5px;border:1px solid #ccc;padding:2px;border-radius:5px;margin:5px;">
                                            <img src="<?php echo ($img['mini']); ?>" alt="" class="wb_figure" max="<?php echo ($img['max']); ?>" source="<?php echo ($img['source']); ?>" medium="<?php echo ($img['medium']); ?>"></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </ol>
                                <div class="img_tool hidden clear" style="display:none">
                                    <ul>
                                        <li>
                                            <i class='icon icon-packup'></i>
                                            <span class='packup'>&nbsp;收起</span>
                                        </li>
                                        <li>|</li>
                                        <li>
                                            <i class='icon icon-bigpic'></i>
                                            <a href="/Uploads/Pic/<?php echo ($v["max"]); ?>" target='_blank'>&nbsp;查看大图</a>
                                        </li>
                                    </ul>
                                <!--中图-->
                                    <div class="img_info">
                                    <img src="/Uploads/Pic/<?php echo ($v["medium"]); ?>"/>
                                    </div>
                                </div>
                            </div>
                        </dd><?php endif; ?>
                    </dl>
                <!--操作-->
                    <div class="wb_tool" style="">
                    <!--发布时间-->
                        <span class="send_time"><?php echo ($v['create_at']); ?></span>
                        <ul>
                        <?php if(isset($_SESSION["uid"]) && $_SESSION["uid"] == $v["uid"]): ?><li class='del-li hidden'><span class='del-weibo' wid='<?php echo ($v["id"]); ?>'>删除</span></li>
                            <li class='del-li hidden'>|</li><?php endif; ?>
                            <li><span class='turn' id='<?php echo ($v["id"]); ?>'>转发<?php if($v["turn"]): ?><span>(<?php echo ($v["turn"]); ?>)</span><?php endif; ?></span></li>
                            <li>|</li>
                            <li class='keep-wrap'>
                                <span class='keep' wid='<?php echo ($v["id"]); ?>'>收藏<?php if($v["keep"]): ?><span>(<?php echo ($v["keep"]); ?>)</span><?php endif; ?></span>
                                <div class='keep-up hidden'></div>
                            </li>
                            <li>|</li>
                            <li><span class='comment' wid='<?php echo ($v["id"]); ?>'>评论

                            <?php if($v["comment"]): ?><span>(<?php echo ($v["comment"]); ?>)</span><?php endif; ?></span></li>
                        </ul>
                    </div>
                <!--=====回复框=====-->
                    <div class='comment_load hidden'>
                        <img src="/Public/Images/loading.gif">评论加载中，请稍候...
                    </div>
                    <div class='comment_list hidden'>
                        <textarea name="" sign='comment<?php echo ($key); ?>'></textarea>
                        <ul>
                            <li class='phiz fleft' sign='comment<?php echo ($key); ?>'></li>
                            <li class='comment_turn fleft'>
                                <label>
                                    <input type="checkbox" name=''/>同时转发到我的微博
                                </label>
                            </li>
                            <li class='comment_btn fright' wid='<?php echo ($v["id"]); ?>' uid='<?php echo ($v["uid"]); ?>'>评论<span><?php echo ($v[comment]); ?></span></li>
                        </ul>
                        <div class="com_box">
                                        
                        </div>
                    </div>
                <!--=====回复框结束=====-->
                </div>
            </div>

           <!--=====转发微博=====-->  
<?php else: ?>
<div class="weibo">
            <!--头像-->
                <div class="face">
                    <a href="<?php echo U('/u/'.$v['uid']);?>">
                        <img src="/<?php echo ($v['face']); ?>" width='50' height='50'/>
                    </a>
                </div>
                <div class="wb_cons">
                    <dl>
                    <!--用户名-->
                        <dt class='author'>
                            <a href="<?php echo U('/u/'.$v['uid']);?>"><?php echo ($v["username"]); ?></a>
                        </dt>
                    <!--发布内容-->
                        <dd class='content'>
                            <p><?php echo ($v['content']); ?></p>
                        </dd>
                    <!--转发的微博内容-->
                   
                        <dd>
                            <div class="wb_turn">
                                <dl>
                                <!--原作者-->
                                    <dt class='author'>
                                        <a href="<?php echo U('/u/'.$v['isturn']['uid']);?>">@<?php echo ($v['isturn']['username']); ?>
                                        </a>
                                    </dt>
                                <!--原微博内容-->
                                    <dd class='content'>
                                        <p><?php echo ($v['isturn']['content']); ?></p>
                                    </dd>
                                <!--原微博图片-->
                        <?php if($v['isturn']['images']): ?><dd>
                        
                            <div class='wb_img clear'>
                            <!--小图-->
                                <ol>
                                <?php if($v['isturn']['isfigure'] == 1): if(is_array($v['isturn']['images'])): $i = 0; $__LIST__ = $v['isturn']['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li style="float:left;margin:5px;border:1px solid #ccc;padding:2px;border-radius:5px;margin:5px;">
                                    <img src="<?php echo ($img['medium']); ?>" alt="" class="wb_figure" max="<?php echo ($img['max']); ?>" source="<?php echo ($img['source']); ?>" medium="<?php echo ($img['medium']); ?>">
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                        <?php if(is_array($v['isturn']['images'])): $i = 0; $__LIST__ = $v['isturn']['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li style="float:left;margin:5px;border:1px solid #ccc;padding:2px;border-radius:5px;margin:5px;">
                                            <img src="<?php echo ($img['mini']); ?>" alt="" class="wb_figure" max="<?php echo ($img['max']); ?>" source="<?php echo ($img['source']); ?>" medium="<?php echo ($img['medium']); ?>"></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </ol>
                                <div class="img_tool hidden clear" style="display:none">
                                    <ul>
                                        <li>
                                            <i class='icon icon-packup'></i>
                                            <span class='packup'>&nbsp;收起</span>
                                        </li>
                                        <li>|</li>
                                        <li>
                                            <i class='icon icon-bigpic'></i>
                                            <a href="/Uploads/Pic/" target='_blank'>&nbsp;查看大图</a>
                                        </li>
                                    </ul>
                                <!--中图-->
                                    <div class="img_info">
                                    <img src=""/>
                                    </div>
                                </div>
                            </div>
                        </dd><?php endif; ?>
                                </dl>
                                <!--转发微博操作-->
                                <div class="turn_tool">
                                    <span class='send_time'>
                                        <?php echo ($v["create_at"]); ?>
                                    </span>
                                    <ul>
                                        <li>
                                        <a href="javascript:void(0)"  class="turn" id="<?php echo ($v['isturn']['id']); ?>">转发
                                        <?php if($v["isturn"]["turn"]): ?><span>(<?php echo ($v['isturn']['turn']); ?>)</span><?php endif; ?>
                                        </a></li>
                                        <li>|</li>
                                        <li><a href="javascript:void(0)" wid='<?php echo ($v["isturn"]["id"]); ?>' class="comment">评论
                                        <?php if($v["isturn"]["comment"]): ?><span>(<?php echo ($v['isturn']['comment']); ?>)</span><?php endif; ?>
                                        </a></li>
                                    </ul>
                                </div>
                                <div class='comment_load hidden'>
                                    <img src="/Public/Images/loading.gif">评论加载中，请稍候...
                                </div>
                                <div class='comment_list hidden'>
                                    <textarea name="" sign='comment<?php echo ($key); ?>' style="width:90%"></textarea>
                                    <ul>
                                        <li class='phiz fleft' sign='comment<?php echo ($key); ?>'></li>
                                        <li class='comment_turn fleft'>
                                            <label>
                                                <input type="checkbox" name=''/>同时转发到我的微博
                                            </label>
                                        </li>
                                        <li class='comment_btn fright' wid="<?php echo ($v['isturn']['id']); ?>" uid="<?php echo ($v['isturn']['uid']); ?>">评论</li>
                                    </ul>
                                    <div class="com_box">
                                        
                                    </div>
                                </div>
                            </div>
                        </dd>
                  
                    </dl>
                    <!--操作-->
                    <div class="wb_tool">
                        <!--发布时间-->
                        <span class="send_time">
                            <?php echo ($v["create_at"]); ?>
                        </span>
                        <ul>
                        <?php if(isset($_SESSION["uid"]) && $_SESSION["uid"] == $v["uid"]): ?><li class='del-li hidden'><span class='del-weibo' wid='<?php echo ($v["id"]); ?>'>删除</span></li>
                            <li class='del-li hidden'>|</li><?php endif; ?>
                            <li><span class='turn' id='<?php echo ($v["id"]); ?>' tid='<?php echo ($v["isturn"]["id"]); ?>' mul="true">转发<?php if($v["turn"]): ?><span>(<?php echo ($v["turn"]); ?>)</span><?php endif; ?></span></li>
                            <li>|</li>
                            <li class='keep-wrap'>
                                <span class='keep' wid='<?php echo ($v["id"]); ?>'>收藏<?php if($v["keep"]): ?><span>(<?php echo ($v["keep"]); ?>)</span><?php endif; ?></span>
                                <div class='keep-up hidden'></div>
                            </li>
                            <li>|</li>
                            <li><span class='comment' wid='<?php echo ($v["id"]); ?>'>评论<?php if($v["comment"]): ?><span>(<?php echo ($v["comment"]); ?>)</span><?php endif; ?></span></li>
                        </ul>
                    </div>
                    <!--回复框-->
                    <div class='comment_load hidden'>
                        <img src="/Public/Images/loading.gif">评论加载中，请稍候...
                    </div>
                    <div class='comment_list hidden'>
                        <textarea name="" sign='comment<?php echo ($key); ?>'></textarea>
                        <ul>
                            <li class='phiz fleft' sign='comment<?php echo ($key); ?>'></li>
                            <li class='comment_turn fleft'>
                                <label>
                                    <input type="checkbox" name=''/>同时转发到我的微博
                                </label>
                            </li>
                            <li class='comment_btn fright' wid='<?php echo ($v["id"]); ?>' uid='<?php echo ($v["uid"]); ?>'>评论</li>
                        </ul>
                        <div class="com_box">
                                        
                        </div>
                    </div>
                    <!--回复框结束-->
                </div>
            </div><?php endif; endforeach; endif; ?>

            <div id='page'><?php echo ($page); ?></div>
        </div>
<!--==========右侧==========-->
        <?php
 $user=M('userinfo')->where(array('uid'=>session('user')['id']))->find(); ?>
<div id="right">
    <div class="edit_tpl"><a href="" class='set_model'></a></div> 
<userinfo id='$_SESSION["uid"]'>
    <dl class="user_face">
        <dt>
            <a href="<?php echo U('/' . $uid);?>">
                <img src="<?php if($face): ?>/<?php echo ($face); else: ?>/Public/Images/noface.gif<?php endif; ?>" width='80' height='80' alt="<?php echo ($username); ?>" />
            </a>
        </dt>
        <dd>
            <a href="<?php echo U('/' . $uid);?>"><?php echo session('user')['username'];?></a>
        </dd>
    </dl>
    <ul class='num_list'>
        <?php  ?>
        <li><a href="<?php echo U('follow/' . $uid);?>"><strong><?php echo ($user['follow']); ?></strong><span>关注</span></a></li>
        <li><a href="<?php echo U('fans/' . $uid);?>"><strong><?php echo ($user['fans']); ?></strong><span>粉丝</span></a></li>
        <li class='noborder'>
            <a href="<?php echo U('/' . $uid);?>"><strong><?php echo ($user['weibo']); ?></strong><span>微博</span></a>
        </li>
    </ul>
</userinfo>
    <div class="maybe">
        <?php $follow=M('follow')->where(array('fans'=>session('user')['id']))->field('follow')->select(); $ids=''; foreach($follow as $key=>$value){ $ids.=$value['follow'].','; } echo '-----------.'. substr($ids,0,-1); $f=M('follow')->where(array('fans'=>array('in',$ids) ,'fans'=>array('neq'=>session('user')['id']) ))->limit(4)->select(); ?>
        <fieldset>
            <legend>可能感兴趣的人</legend>
            <ul>
                <?php if(is_array($$f)): foreach($$f as $key=>$me): ?><li>
                        <dl>
                            <dt>
                                <a href="<?php echo U('/' . $uid);?>">
                                    <img src="<?php if($face): ?>/Uploads/Face/<?php echo ($face); else: ?>/Public/Images/noface.gif<?php endif; ?>" width='30' height='30'/>
                                </a>
                            </dt>
                            <dd><a href="<?php echo U('/' . $uid);?>"><?php echo ($username); ?></a></dd>
                            <dd>共<?php echo ($count); ?>个共同好友</dd>
                        </dl>
                        <span class='heed_btn add-fl' uid='<?php echo ($uid); ?>'><strong>+&nbsp;</strong>关注</span>
                    </li><?php endforeach; endif; ?>
            </ul>
        </fieldset>
    </div>
    <div class="post">
        <div class='post_line'>
            <span>公告栏</span>
        </div>
        <ul>
            <li><a href="">话题1</a></li>
            <li><a href="">热点1</a></li>
            <li><a href="">话题2</a></li>
        </ul>
    </div>
</div>
    </div>
<!--==========内容主体结束==========-->

<div id="ajax_send" style="display:none;">
 <div class="weibo">
                <!--头像-->
                <div class="face">
                    <a href="/#uid#">
                        <img src="#myface#" width='50' height='50'/>
                    </a>
                </div>
                <div class="wb_cons">
                    <dl>
                    <!--用户名-->
                        <dt class='author'>
                            <a href="#个人主页#">#用户名#</a>
                        </dt>
                    <!--发布内容-->
                        <dd class='content'>
                            <p>#内容#</p>
                        </dd>
                    <!--微博图片-->
                        <dd>
                            #thumb#
                        </dd>
                   
                    </dl>
                <!--操作-->
                    <div class="wb_tool">
                    <!--发布时间-->
                        <span class="send_time">刚刚发布</span>
                        <ul>
                       <!--自己发布的肯定有权删除-->
                            <li class='del-li hidden'><span class='del-weibo' wid='#wid#'>删除</span></li>
                            <li class='del-li hidden'>|</li>
                        
                            <li><span class='turn' id='#wid#'>转发0</span></li>
                            <li>|</li>
                            <li class='keep-wrap'>
                                <span class='keep' wid='#wid#'>收藏0</span>
                                <div class='keep-up hidden'></div>
                            </li>
                            <li>|</li>
                            <li><span class='comment' wid="#wid#">评论0</span></li>
                        </ul>
                    </div>
                <!--=====回复框=====-->
                    <div class='comment_load hidden'>
                        <img src="/Public/Images/loading.gif">评论加载中，请稍候...
                    </div>
                    <div class='comment_list hidden'>
                        <textarea name="" sign='comment'></textarea>
                        <ul>
                            <li class='phiz fleft' sign='comment'></li>
                            <li class='comment_turn fleft'>
                                <label>
                                    <input type="checkbox" name=''/>同时转发到我的微博
                                </label>
                            </li>
                            <li class='comment_btn fright' wid='#wid#' uid="#uid#">评论</li>
                        </ul>
                    </div>
                <!--=====回复框结束=====-->
                </div>
</div>
</div>
<div id="ajax_send_turn" style="display:none;">
    <div class="weibo">
            <!--头像-->
                <div class="face">
                    <a href="<?php echo U('/' . $v['uid']);?>">
                        <img src="\
                        <?php if($v["face"]): ?>/Uploads/Face/<?php echo ($v["face"]); ?>
                        <?php else: ?>
                            /Public/Images/noface.gif<?php endif; ?>" width='50' height='50'/>
                    </a>
                </div>
                <div class="wb_cons">
                    <dl>
                    <!--用户名-->
                        <dt class='author'>
                            <a href="<?php echo U('/' . $v['uid']);?>"><?php echo ($v["username"]); ?></a>
                        </dt>
                    <!--发布内容-->
                        <dd class='content'>
                            <p><?php echo ($v["content"]); ?><span style="color:#ccc;font-weight:bold;">&nbsp;//&nbsp;</span></p>
                        </dd>
                    <!--转发的微博内容-->
                    <?php if($v["isturn"] == -1): ?><dd class="wb_turn">该微博已被删除</dd>
                    <?php else: ?>
                        <dd>
                            <div class="wb_turn">
                                <dl>
                                <!--原作者-->
                                    <dt class='turn_name'>
                                        <a href="<?php echo U('/' . $v['isturn']['uid']);?>">@<?php echo ($v["isturn"]["username"]); ?></a>
                                    </dt>
                                <!--原微博内容-->
                                    <dd class='turn_cons'>
                                        <p><?php echo ($v["isturn"]["content"]); ?></p>
                                    </dd>
                                <!--原微博图片-->
                                <if condition='$v["isturn"]["max"]'>
                                    <dd>
                                        <div class="turn_img">
                                        <!--小图-->
                                            <img src="/Uploads/Pic/<?php echo ($v["isturn"]["mini"]); ?>" class='turn_mini_img'/>
                                            <div class="turn_img_tool hidden">
                                                <ul>
                                                    <li>
                                                        <i class='icon icon-packup'></i>
                                                        <span class='packup'>&nbsp;收起</span></li>
                                                    <li>|</li>
                                                    <li>
                                                        <i class='icon icon-bigpic'></i>
                                                        <a href="/Uploads/Pic/<?php echo ($v["isturn"]["max"]); ?>" target='_blank'>&nbsp;查看大图</a>
                                                    </li>
                                                </ul>
                                            <!--中图-->
                                                <div class="turn_img_info">
                                                    <img src="/Uploads/Pic/<?php echo ($v["isturn"]["medium"]); ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </dd><?php endif; ?>
                                </dl>
                                <!--转发微博操作-->
                                <div class="turn_tool">
                                    <span class='send_time'>
                                        <?php echo ($v["create_at"]); ?>
                                    </span>
                                    <ul>
                                        <li><a href="">转发<?php if($v["isturn"]["turn"]): ?>(<?php echo ($v["isturn"]["turn"]); ?>)<?php endif; ?></a></li>
                                        <li>|</li>
                                        <li><a href="">评论<?php if($v["isturn"]["comment"]): ?>(<?php echo ($v["isturn"]["comment"]); ?>)<?php endif; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </dd><?php endif; ?>
                    </dl>
                    <!--操作-->
                    <div class="wb_tool">
                        <!--发布时间-->
                        <span class="send_time">
                            <?php echo ($v["create_at"]); ?>
                        </span>
                        <ul>
                        <?php if(isset($_SESSION["uid"]) && $_SESSION["uid"] == $v["uid"]): ?><li class='del-li hidden'><span class='del-weibo' wid='<?php echo ($v["id"]); ?>'>删除</span></li>
                            <li class='del-li hidden'>|</li><?php endif; ?>
                            <li><span class='turn' id='<?php echo ($v["id"]); ?>' tid='<?php echo ($v["isturn"]["id"]); ?>'>转发<?php if($v["turn"]): ?>(<?php echo ($v["turn"]); ?>)<?php endif; ?></span></li>
                            <li>|</li>
                            <li class='keep-wrap'>
                                <span class='keep' wid='<?php echo ($v["id"]); ?>'>收藏<?php if($v["keep"]): ?>(<?php echo ($v["keep"]); ?>)<?php endif; ?></span>
                                <div class='keep-up hidden'></div>
                            </li>
                            <li>|</li>
                            <li><span class='comment' wid='<?php echo ($v["id"]); ?>'>评论<?php if($v["comment"]): ?>(<?php echo ($v["comment"]); ?>)<?php endif; ?></span></li>
                        </ul>
                    </div>
                    <!--回复框-->
                    <div class='comment_load hidden'>
                        <img src="/Public/Images/loading.gif">评论加载中，请稍候...
                    </div>
                    <div class='comment_list hidden'>
                        <textarea name="" sign='comment<?php echo ($key); ?>'></textarea>
                        <ul>
                            <li class='phiz fleft' sign='comment<?php echo ($key); ?>'></li>
                            <li class='comment_turn fleft'>
                                <label>
                                    <input type="checkbox" name=''/>同时转发到我的微博
                                </label>
                            </li>
                            <li class='comment_btn fright' wid='<?php echo ($v["id"]); ?>' uid='<?php echo ($v["uid"]); ?>'>评论</li>
                        </ul>
                    </div>
                    <!--回复框结束-->
                </div>
            </div>

</div>

<!--==========底部==========-->
<!--==========底部==========-->
    <div id="bottom">
       
        <div id="copy">
            <div>
                <p>
                    版权所有：<?php echo (C("COPY")); ?> 站长统计 All rights reserved, houdunwang.com services for Beijing 2008-2012 
                </p>
            </div>
        </div>
    </div>

<!--==========转发输入框==========-->
    <div id='turn' class='hidden'>
        <div class="turn_head">
            <span class='turn_text fleft'>转发微博</span>
            <span class="close fright"></span>
        </div>
        <div class="turn_main">
            <form action='<?php echo U("Index/turn");?>' method='post' name='turn'>
                <p></p>
                <div class='turn_prompt'>
                    你还可以输入<span id='turn_num'>140</span>个字</span>
                </div>
                <textarea name='content' sign='turn'></textarea>
                <ul>
                    <li class='phiz fleft' sign='turn'></li>
                    <li class='turn_comment fleft'>
                        <label>
                            <input type="checkbox" name='becomment'/>同时评论给<span class='turn-cname'></span>
                        </label>
                    </li>
                    <li class='turn_btn fright'>
                        <input type="hidden" name='id' value=''/>
                        <input type="hidden" name='tid' value=''/>
                        <input type="submit" value='转发' class='turn_btn'/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
<!--==========转发输入框==========-->

<!--==========表情选择框==========-->
    <div id="phiz" class='hidden'>
        <div>
            <p>常用表情</p>
            <span class='close fright'></span>
        </div>
        <ul>
            <li><img src="/Public/Images/phiz/hehe.gif" alt="呵呵" title="呵呵" /></li>
            <li><img src="/Public/Images/phiz/xixi.gif" alt="嘻嘻" title="嘻嘻" /></li>
            <li><img src="/Public/Images/phiz/haha.gif" alt="哈哈" title="哈哈" /></li>
            <li><img src="/Public/Images/phiz/keai.gif" alt="可爱" title="可爱" /></li>
            <li><img src="/Public/Images/phiz/kelian.gif" alt="可怜" title="可怜" /></li>
            <li><img src="/Public/Images/phiz/wabisi.gif" alt="挖鼻屎" title="挖鼻屎" /></li>
            <li><img src="/Public/Images/phiz/chijing.gif" alt="吃惊" title="吃惊" /></li>
            <li><img src="/Public/Images/phiz/haixiu.gif" alt="害羞" title="害羞" /></li>
            <li><img src="/Public/Images/phiz/jiyan.gif" alt="挤眼" title="挤眼" /></li>
            <li><img src="/Public/Images/phiz/bizui.gif" alt="闭嘴" title="闭嘴" /></li>
            <li><img src="/Public/Images/phiz/bishi.gif" alt="鄙视" title="鄙视" /></li>
            <li><img src="/Public/Images/phiz/aini.gif" alt="爱你" title="爱你" /></li>
            <li><img src="/Public/Images/phiz/lei.gif" alt="泪" title="泪" /></li>
            <li><img src="/Public/Images/phiz/touxiao.gif" alt="偷笑" title="偷笑" /></li>
            <li><img src="/Public/Images/phiz/qinqin.gif" alt="亲亲" title="亲亲" /></li>
            <li><img src="/Public/Images/phiz/shengbin.gif" alt="生病" title="生病" /></li>
            <li><img src="/Public/Images/phiz/taikaixin.gif" alt="太开心" title="太开心" /></li>
            <li><img src="/Public/Images/phiz/ldln.gif" alt="懒得理你" title="懒得理你" /></li>
            <li><img src="/Public/Images/phiz/youhenhen.gif" alt="右哼哼" title="右哼哼" /></li>
            <li><img src="/Public/Images/phiz/zuohenhen.gif" alt="左哼哼" title="左哼哼" /></li>
            <li><img src="/Public/Images/phiz/xiu.gif" alt="嘘" title="嘘" /></li>
            <li><img src="/Public/Images/phiz/shuai.gif" alt="衰" title="衰" /></li>
            <li><img src="/Public/Images/phiz/weiqu.gif" alt="委屈" title="委屈" /></li>
            <li><img src="/Public/Images/phiz/tu.gif" alt="吐" title="吐" /></li>
            <li><img src="/Public/Images/phiz/dahaqian.gif" alt="打哈欠" title="打哈欠" /></li>
            <li><img src="/Public/Images/phiz/baobao.gif" alt="抱抱" title="抱抱" /></li>
            <li><img src="/Public/Images/phiz/nu.gif" alt="怒" title="怒" /></li>
            <li><img src="/Public/Images/phiz/yiwen.gif" alt="疑问" title="疑问" /></li>
            <li><img src="/Public/Images/phiz/canzui.gif" alt="馋嘴" title="馋嘴" /></li>
            <li><img src="/Public/Images/phiz/baibai.gif" alt="拜拜" title="拜拜" /></li>
            <li><img src="/Public/Images/phiz/sikao.gif" alt="思考" title="思考" /></li>
            <li><img src="/Public/Images/phiz/han.gif" alt="汗" title="汗" /></li>
            <li><img src="/Public/Images/phiz/kun.gif" alt="困" title="困" /></li>
            <li><img src="/Public/Images/phiz/shuijiao.gif" alt="睡觉" title="睡觉" /></li>
            <li><img src="/Public/Images/phiz/qian.gif" alt="钱" title="钱" /></li>
            <li><img src="/Public/Images/phiz/shiwang.gif" alt="失望" title="失望" /></li>
            <li><img src="/Public/Images/phiz/ku.gif" alt="酷" title="酷" /></li>
            <li><img src="/Public/Images/phiz/huaxin.gif" alt="花心" title="花心" /></li>
            <li><img src="/Public/Images/phiz/heng.gif" alt="哼" title="哼" /></li>
            <li><img src="/Public/Images/phiz/guzhang.gif" alt="鼓掌" title="鼓掌" /></li>
            <li><img src="/Public/Images/phiz/yun.gif" alt="晕" title="晕" /></li>
            <li><img src="/Public/Images/phiz/beishuang.gif" alt="悲伤" title="悲伤" /></li>
            <li><img src="/Public/Images/phiz/zuakuang.gif" alt="抓狂" title="抓狂" /></li>
            <li><img src="/Public/Images/phiz/heixian.gif" alt="黑线" title="黑线" /></li>
            <li><img src="/Public/Images/phiz/yinxian.gif" alt="阴险" title="阴险" /></li>
            <li><img src="/Public/Images/phiz/numa.gif" alt="怒骂" title="怒骂" /></li>
            <li><img src="/Public/Images/phiz/xin.gif" alt="心" title="心" /></li>
            <li><img src="/Public/Images/phiz/shuangxin.gif" alt="伤心" title="伤心" /></li>
        </ul>
    </div>
<!--==========表情==========-->

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





<!--



-->