<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class LoginController extends Controller {

    /*public function _initialize(){
        if(session('?user')){
           redirect('Index/index');
        }
    }*/
    public function index(){
       
        session('user',null);
        return $this->display();
    }

    public function register(){
        if(IS_AJAX){
             $user=D('User');
           echo   $user->register();
       }else{
           return $this->display();
       }
    }

    public function login(){
        //登陆检查；
     
       if(IS_AJAX){
              $user=D('User');
         echo   $user->login();
       }else{
           return $this->display();
       }
      
    }

    public function verify(){
            $verify=new Verify();
            $verify->useCurve=false;
            $verify->length=4;
            $verify->fontSize=35;
            $verify->entry(1);
    }


    public function checkAccount(){
       if(IS_AJAX){
             $user=D('User');
            echo $user->checkField('account',I('post.account'));
       }else{
            $this->error('非法进去');
       }
    }

    public function checkUname(){
        if(IS_AJAX){
             $user=D('User');
          echo  $user->checkUsername(I('post.uname'));
       }else{
            $this->error('非法进去');
       }
    }

    public function checkVerify(){
        if(IS_AJAX){

            if(checkVerify(I('post.verify'),1)){
                echo  'true';
            }else{
                echo  'false';
            }
       }else{
            $this->error('非法进去');
       }
    }

    
}
// htmlspecialchars();