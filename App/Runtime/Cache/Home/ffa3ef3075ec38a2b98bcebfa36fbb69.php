<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title><?php echo (C("WEBNAME")); ?>-登录</title>
    <link rel="stylesheet" href="/Public/Css/login.css" />
    <script type="text/javascript" src="/Public/Js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery-validate.js"></script>
     <script type="text/javascript" src="/Public/layer/layer.js"></script>
      <script type="text/javascript" src="/Public/layer/dialog.js"></script>
    <script type="text/javascript" src="/Public/Js/login.js"></script>

    <script>
    var userLogin="<?php echo U('login');?>";
    var shouye="<?php echo U('Index/index');?>";
    </script>
    <style>
        html,body{
            height:100%;
            width:100%;
        }
    </style>
</head>
<body  style="background-image:url(https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1492091357318&di=5a6aceb5a62f24cd3cb27c5a89c85201&imgtype=0&src=http%3A%2F%2Fp2.cri.cn%2FM00%2FB7%2FC3%2FCqgNOli_x7KACbJKAAAAAAAAAAA784.900x600.jpg);background-size:100% 100%;background-repeat:no-repeat;">
  
    <div id='login-form' style="background-image:none">
        <div id='login-wrap'>
            <p>还没有微博帐号？<a href='<?php echo U("register");?>'>立即注册</a></p>
            <form  method='post' name='login' id="login">
                <fieldset>
                    <legend>用户登录</legend>
                    <p>
                        <label for="account">登录账号：</label>
                        <input type="text" name='account' class='input'/>
                    </p>
                    <p>
                        <label for="pwd">密码：</label>
                        <input type="password" name='pwd' class='input'/>
                    </p>
                    <p>
                        <input type="checkbox" name='auto' checked='1' class='auto' id='auto'/>
                        <label for="auto">下次自动登录</label>
                    </p>
                    <p>
                        <input type="submit" value='马上登录' id='login'/>
                    </p>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>