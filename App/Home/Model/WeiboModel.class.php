<?php
namespace Home\Model;
use Think\Model\ViewModel;
class WeiboModel extends ViewModel{

    protected $viewFields = array(
        // 获取微博信息，关联表， 用户名 userinfo表； weibo信息，获取weibo表 图片信息，获取图片表
        // 多张图片对应一篇微博；
        // 一个用户对应一篇微博；
        // 一篇weibo 是唯一性的；
        'weibo'=>array(
            'id','content','isturn','create_at','turn','keep','comment','uid','isfigure',
            '_type'=>'LEFT'
        ),
        'userinfo'=>array(
            'username','face50'=>'face',
            '_on'=>'weibo.uid = userinfo.uid',
            '_type'=>'LEFT',
        ),
        

    );
     
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

        }
        return $list;
    }
    /**
     * 读取微博；  type = all  所有微博；
     *             type =original  原创微博；
     *             type =follor  我关注的微博；
     *             type =  pic  带有图片的微博；
     *             type = gid  我的好友分组里面的微博；
     *             type = me 我自己发的微博；
     *             type = diy 
     * @return 微博信息
     */
    public function getWibo($type='all',$first=0){
       

        $where=array();
        if($type=='all'){
            $where['id']=array('gt',0);
        }else if($type=='original'){
            $where['isturn']=array('eq',0);

        }else if($type=='follow'){
            $ffs=M("follow")->where(array('fans'=>session('user')['id'] ))->field('follow')->select();
            $uids=array(0);
            foreach ($ffs as $key => $value) {
                $uids[]=$value['follow'];
            }
              
                $where['uid']=array('in',$uids);
             
        }else if($type=='pic'){
            $where['isfigure']=array('gt',0);
        }else if(is_array($type)){
            //echo p($type);die;
            $uids=array(0);
            $ffs=M("follow")->where(array('fans'=>session('user')['id'],'group'=>$type['group']))->field('follow')->select();

            foreach ($ffs as $key => $value) {
                $uids[]=$value['follow'];
            }
           $where['uid']=array('in',$uids);
          // p($uids);die;
           
        }else if($type=='me'){
            $where['uid']=session('user')['id'];
        }else if($type=='diy'){
            $where=$this->diy;

        }

        $list=$this->where($where)->order('create_at DESC')->limit($first,50)->select();

        if($list){
            $list=$this->format($list);
        }

       return $list;
    }
    private $diy;
    public function diy($data){
        $this->diy=$data;
        return $this;
    }
    /**
     * 
     * 添加微博；
     */
    public function sendWeibo($images=array() ){
        


    }

    /**
     * 
     * 删除微博
     * @return true or false；
     */
    public function delWeibo(){

    }

    public function  updateWeibo(){


    }
}