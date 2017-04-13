<?php
namespace Home\Controller;
use Think\Controller;
class UserSettingController extends CommonController {
    public function index(){
       // echo session('user')['id'];
       
        $data=D('user')->table('wb_userinfo')->where(array('uid'=>session('user')['id']))->find();
        if(empty($data['face180'])){
          $data['face180']='/Public/Images/noface.gif';
        }else{
          $data['face180']=substr( $data['face180'],1);
        }
            

        $this->assign('user',$data);

        return $this->display();

    }


    public function editinfo(){
            if(IS_AJAX){
              $location=I('post.province').' '.I('post.city');
              $data=array(
                  'username'=>I('post.nickname'),
                  'truename'=>I('post.truename'),
                  'sex'=>I('post.sex')==1?'男':'女',
                  'location'=>$location,
                  'constellation'=>I('post.night'),
                  'intro'=>I('post.intro')
              );

              echo D('User')->table('wb_userinfo')->where(array('uid'=>session('user')['id']))->save($data);
            }else{
              echo  -1;
            }
    }
    public function editpass(){
        if(IS_AJAX){
              $user=D('User');
              $data=$user->where(array('id'=>session('user')['id']))->find();
              
              if(I('post.new')!=I('post.newed')){
                echo -1;
                   return;
              }
           
              if($data['password']!=md5(I('post.old'))){
                  echo -1;
                  return ;
              }else{
                $data=array(
                  'password'=>md5(I('post.new')),
                  );
              echo   $user->where(array('id'=>session('user')['id']))->save($data);
              }
            }else{
              echo  -1;
            }
    }


    public function saveFace(){
         if(IS_AJAX){
                $data=array(
                  'face180'=>I('post.face180'),
                  'face80'=>I('post.face80'),
                  'face50'=>I('post.face50')
                );
                echo M('userinfo')->where(array('uid'=>session('user')['id']))->save($data);
            }else{
              echo  -1;
            }
    }

}

