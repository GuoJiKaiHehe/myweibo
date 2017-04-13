<?php 
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{

    public function _initialize(){
        if(session('admin')['username']){
            $this->redirect('/admin ');
        }
    }
    public function index(){
        
        $this->display();
    }


    public function getVerify(){
        $verify=new \Think\Verify();
        $verify->useCurve=false;
        $verify->length=4;
        $verify->entry(1);
    }

    public function check(){
        if(IS_POST){
            //echo I('post.verify');die;

            if(!checkVerify(I('post.verify'))){
                $this->error('验证码错误！');
            }
            $manager=M('admin')->where(array('username'=>I('post.uname'),'password'=>I('pwd')))->find();
           if($manager){
                session('admin',$manager);
                $this->redirect('/admin');
           }else{
                $this->error('cuowu ');
           }
        }
    }
}