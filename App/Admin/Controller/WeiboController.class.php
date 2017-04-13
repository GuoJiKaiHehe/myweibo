<?php 
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class  WeiboController extends CommonController{

    public function index(){
        $model=new Model();
        $sql="SELECT a.id,
                    a.content,
                    a.keep,
                    a.comment,
                    a.create_at,
                    b.username
                FROM 
                    wb_weibo a
                LEFT JOIN
                    wb_userinfo b
                ON a.uid=b.uid
                ";
        $weibo=$model->query($sql);
       $weibo=$this->format($weibo);
        $this->assign('weibo',$weibo);
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

      public function format($list){
        foreach ($list as $key => $value) {
            if($value['face']==''){
                $list[$key]['face']='/Public/Images/noface.gif';
            }


            if($value['isfigure']){
                //存在配图； //获取一个2维数组；
                $images=M('picture')->where(array('wid'=>$value['id']))->field('mini,medium,max,source')->select();
                foreach($images as $ik=>$iv){
                    
                   

                    $list[$key]['images'][$ik]=$iv;
                    foreach ($list[$key]['images'][$ik] as $k => $v) {
                        $list[$key]['images'][$ik][$k]=substr($v,1);
                    }
                    
                }

            }
            /*表情之类的解析*/
  $list[$key]['content']=preg_replace('/\[\[([\x{4e00}-\x{9fa5}]+)\]\]/iue', 'jiexibiaoqing(${1})', $value['content']);

  $list[$key]['content']=preg_replace('/@(([\S]+)\s|([\S]+)$)/is', '<a href="/u/$1" >@$1</a>', $list[$key]['content']);
        /**
         * 时间处理
         */
            if($value['create_at']){
                $diff=(time()-$value['create_at'])*1000;//秒；
                switch($diff){
                    case $diff < 60:
                        $list[$key]['create_at']='一分钟前发布';
                        break;
                    case  $diff < 60*5:
                        $list[$key]['create_at']='一分钟前发布';
                        break;
                    case  $diff < 60*30:
                        $list[$key]['create_at']='半小时前发布';
                        break;
                    case  $diff < 3600:
                        $list[$key]['create_at']='一小时前前发布';
                        break;
                    case  $diff < 3600*2:
                        $list[$key]['create_at']='两小时前前发布';
                        break;
                    case  $diff < 3600*24:
                        $list[$key]['create_at']='昨天';
                        break;
                    case  $diff < 60*48:
                        $list[$key]['create_at']='两天前前发布';
                        break;
                    default :
                        $list[$key]['create_at']=date('m月d日',$value['create_at']).'发布';//时间不合理；

                }
            }

            //处理转发微博；
            if($value['isturn']>0){
                $list[$key]['isturn']=$this->format($this->where(array('id'=>$value['isturn']))->select())[0];
            }
            
            if(strlen($value['content'])>50){

                $list[$key]['content']=substr($value['content'], 0,50).'...';
            }

        }
        return $list;
    }


     public function getWibo($type='all',$first=0){
       
        $list=$this->where($where)->order('create_at DESC')->limit($first,50)->select();

        if($list){
            $list=$this->format($list);
        }

       return $list;
    }
   
}