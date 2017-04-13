<?php
namespace Home\Controller;

class UserController extends CommonController {

    public function space(){
        $a=$_GET['id'];
        $userinfo=M('userinfo');
        if(is_numeric($a)){
            $user=$userinfo->where(array('uid'=>$a))->find();
           
        }else{
            $user=$userinfo->where(array('username'=>$a))->find();
        }
        if(!$user){
            $this->redirect('Index/index');
        }
        if(!$user['face180']){
    $user['face180']='__PUBLIC__/Images/noface.gif';
        }else{
$user['face180']=substr($user['face180'], 1);
        }
        $data=D('Weibo')->diy(array('uid'=>$user['uid']))->getWibo('diy');

        if(S('follow'.$user['uid'])){
            $follow=S('follow'.$user['uid']);
            
        }else{
            $follow=M('follow')->limit(8)->where(array('fans'=> $user['uid']))->field('follow')->select();
            $fid='';
            foreach ($follow as $k => $v) {
                $fid.=$v['follow'].',';
            }
            $fid=substr($fid,0,-1);
            $follow=$userinfo->where(array('uid'=>array('in',$fid)))->select();
            foreach($follow as $fk=>$fv){
                if(!$fv['face50']){
            $follow[$fk]['face50']='/Public/Images/noface.gif';
                }else{
            $follow[$fk]['face50']=substr($fv['face50'], 1);
                }
            }
            S('follow'.$user['uid'],$follow,3600);
        }
       

        
        if(S('fans'.$user['uid'])){
            $fans=S('fans'.$user['uid']);
        }else{
            $fans=M('follow')->limit(8)->where(array('follow'=> $user['uid']))->field('follow')->select();
            $fansid='';
            foreach ($follow as $k => $v) {
                $fansid.=$v['follow'].',';
            }
            $fansid=substr($fansid,0,-1);
            $fans=$userinfo->where(array('uid'=>array('in',$fansid)))->select();

            foreach($fans as $fk=>$fv){
                if(!$fv['face50']){
            $fans[$fk]['face50']='/Public/Images/noface.gif';
                }else{
            $fans[$fk]['face50']=substr($fv['face50'], 1);
                }
            }
            if($fans){
                S('fans'.$user['uid'],$fans,3600);
            }
        }
        
        
        
        $this->assign('userinfo',$user);
        $this->assign('weibo',$data);
        $this->assign('follow',$follow);
        $this->assign('fans',$fans);
        $this->display('index');
    }

    public function _empty($name){
        echo 'kongcaozuo'.$name;
    }
}