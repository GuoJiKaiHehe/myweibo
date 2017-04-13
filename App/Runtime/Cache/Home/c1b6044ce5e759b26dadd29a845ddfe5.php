<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title><?php echo (C("WEBNAME")); ?>-注册</title>
    <link rel="stylesheet" href="/Public/Css/regis.css" />
    <script type="text/javascript" src="/Public/Js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery-validate.js"></script>
    <script type="text/javascript" src="/Public/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/layer/dialog.js"></script>
    <script type='text/javascript'>
        var checkAccount = "<?php echo U('checkAccount');?>";
        var checkUname = "<?php echo U('checkUname');?>";
        var checkVerify = "<?php echo U('checkVerify');?>";
        var shouye="<?php echo U('Login/index');?>";
        var addUser="<?php echo U('Login/register');?>";
    </script>
    <script type="text/javascript" src="/Public/Js/register.js"></script>
</head>
<body>
    <div id='logo'></div>
    <div id='reg-wrap'>
        <form  method='post' name='register' id="register">
            <fieldset>
                <legend>用户注册</legend>
                <p>
                    <label for="account">登录账号：</label>
                    <input type="text" name='account' id='account' class='input'/>
                </p>
                <p>
                    <label for="pwd">登录密码：</label>
                    <input type="password" name='pwd' id='pwd' class='input'/>
                </p>
                <p>
                    <label for="pwded">确认密码：</label>
                    <input type="password" name='pwded' class='input'/>
                </p>
                <p>
                    <label for="uname">昵称：</label>
                    <input type="text"  name='uname' id='uname' class='input'/>
                </p>
                <p>
                    <label for="verify">验证码：</label>
                    <input type="text" name='verify' class='input' id='verify'/>
                </p>
               <h3><img src="<?php echo U('verify');?>" width='100' height='35' id='verify-img'/></h3>
                <p class='run'>
                    <input type="submit" value='马上注册' id='regis'/>
                </p>
            </fieldset>
        </form>
    </div>
</body>
</html>