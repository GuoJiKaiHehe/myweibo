<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        
        $this->display();
    }


    public function copy(){
        $obj=M('weibo');
        $turn=$obj->where(array('isturn'=>0))->count();
        $weibo=$obj->where(array('isturn'=>array('GT',0)))->count();
        $comment=M('comment')->count();
        $user=M('user')->count();
        $lock=M('user')->where(array('lock'=>1))->count();
        $this->assign(array(
            'turn'=>$turn,
            'weibo'=>$weibo,
            'comment'=>$comment,
            'user'=>$user,
            'lock'=>$lock,
        ));

        $this->display();
    }

    public function logout(){
        session('admin',null);
        $this->redirect('/admin/login');
    }
}