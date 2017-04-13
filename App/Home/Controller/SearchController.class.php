<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends CommonController {
    
        public function searchUser(){
            $result=array();
            if(I('get.keyword')!='搜索微博、找人' && I('get.keyword')!=''){
                    $keyword=I('get.keyword');
                    $resultAll=$this->search($keyword,'user');
                    $result=$resultAll['result'];
                    $total=$resultAll['total'];
                    //检查是否互相关注；.
                   
                    $me=session('user')['id'];
                    $follow=M('follow');
                    foreach($result as $k=>$v){
                        $sql="(SELECT `follow` FROM `wb_follow` WHERE `follow`='{$v['uid']}' AND `fans`='$me') UNION (SELECT `follow` FROM `wb_follow` WHERE `follow`='$me' AND `fans`='{$v['uid']}')";
                         $r=$follow->query($sql);
                         // echo $follow->getLastSql().'<br/>';
                         if(count($r)==2){
                            //互相关注；
                            $result[$k]['mutual']=1;//互相关注；
                            $result[$k]['followed']=1;//他关注了我，我也关注了他；
                         }else{
                            //查询看看是 我有没有关注他；
                            $map=array();
                            $map['fans']=$me;
                            $map['follow']=$v['uid'];//我关注了他；
                       
                           $result[$k]['followed']=$follow->where($map)->count();;///我关注了他；
                         }
                          $result[$k]['username']=str_replace($keyword, '<strong style="color:red">'.$keyword.'</strong>', $result[$k]['username'] );
                         
                    }
                    $page=new \Think\Page($total,2);
                    $show=$page->show();
                    $this->assign('page',$show);
                    $this->assign('keyword',I('get.keyword'));
                    $this->assign('total',$total);
                   
            }

            $this->assign('result',$result);
            $this->display(); 
            
        }

        public function searchWeibo(){

            $this->display();
        }

        public function search($keyword,$type='user'){
            $map=array();
            
            $map['uid']=array('NEQ',session('user')['id']);
            $map['username']=array('LIKE','%'.$keyword.'%');
            $page=1;
            if(empty(I('get.p'))){
                $page=1;
            }else{
                $page=I('get.p');
            }
            $offset=($page-1)*2; 
            $result=M('userinfo')->where($map)->limit($offset,2)->select();
            
            return array(
                    'result'=>$result,
                    'total'=>M('userinfo')->where($map)->count(),
                );

        }


}