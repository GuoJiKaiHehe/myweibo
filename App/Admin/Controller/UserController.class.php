<?php 
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class  UserController extends CommonController{

    public function index(){
        $model=new Model();
         $sql_count="SELECT count(b.id) as count FROM wb_userinfo a LEFT JOIN wb_user b ON a.uid=b.id ORDER BY b.create_at DESC";
         $count=$model->query($sql_count)[0]['count'];
        $pageo=new \Think\Page($count,5);
        $sql="SELECT b.id,a.username,b.create_at,a.face80,a.follow,a.fans,a.weibo,b.lock FROM wb_userinfo a LEFT JOIN wb_user b ON a.uid=b.id ORDER BY b.create_at DESC LIMIT $pageo->firstRow,5";
       
        $page=$pageo->show();
       
        $users=$model->query($sql);

       
        $this->assign('page',$page);
        $this->assign('users',$users);

        $this->display();
    }

    public function lockUser($id,$lock){

        M('user')->where(array('id'=>$id))->save(array('lock'=>$lock));

    }

    public function admin(){
        $admin=M('admin')->select();
        $this->assign('admin',$admin);
        $this->display();

    }
   
}