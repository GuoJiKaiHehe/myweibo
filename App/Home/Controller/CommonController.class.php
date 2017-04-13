<?php

namespace Home\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
class CommonController extends Controller {
    /**
     * [_initialize description]
     * @return [type] [description]
     */
    public function _initialize(){
        if(cookie('auto') && !session('?user')){
            $value=explode('|',encryption(cookie('auto')));

            
        }
         $value=explode('|',encryption(cookie('auto'),1));
        $ip=get_client_ip(1);
        if($ip==$value[1]){
            //ip相等，在执行自动登陆；
           // $user=D('User')->where(array('account'=>$value[0]))->field
            $account=$value[0];
            $user=D('User')->table('wb_user a,wb_userinfo b')
                ->where("a.account='$account' AND a.id=b.uid")
                ->field('a.id,a.account,b.username,a.lock')
                ->find();
                

                $auth=array(
                'id'=>$user['id'],
                'account'=>$user['account'],
                'username'=>$user['username']
            );
             session('user',$auth);
        }


        if(!session('?user')){
            redirect(U('Login/index'));
        }

    }


    /**
     * [uploadFace description]
     * @return [type] [description]
     */
    public function uploadFace(){

       
            $upload=new \Think\Upload();
            $upload->maxSize=3145728;
             $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
             $upload->rootPath = './Uploads/';
              
             $info=$upload->upload();
             if($info){
               
               /*50min   80mid  150max*/
              
               $savename=$info['Filedata']['savename'];
               $savepath=$info['Filedata']['savepath'];
               $path='./Uploads/'.$savepath.$savename;
                
               $minPic=C('UploadFace').'_50'.session('user')['id'].$savename;
               $midPic=C('UploadFace').'_80'.session('user')['id'].$savename;
               $maxPic=C('UploadFace').'_150'.session('user')['id'].$savename;
                $image=new Image();
              
                $image->open($path);
              $image->thumb(50,50)->save($minPic);
               $image->open($path);
               $image->thumb(80,80)->save($midPic);
               $image->open($path);
               $image->thumb(150,150)->save($maxPic);
              
               $arr=array(

                    'min'=>$minPic,
                    'mid'=>$midPic,
                    'max'=>$maxPic
                );
               echo json_encode($arr);
             }else{
                echo $upload->getError();
             }
      


    }
    /**
     * 上传首页图片
     * @return [type] [description]
     */
    public function uploadPic(){
           $upload=new \Think\Upload();
            $upload->maxSize=3145728;
             $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
             $upload->rootPath = './Uploads/';
              // 80  180  400  source
              // //正在来说，应该还要判断他上传过来的图片大小多大，然后再做相应的缩略图处理；
             $info=$upload->upload();
             if($info){
               $savename=$info['Filedata']['savename'];
               $savepath=$info['Filedata']['savepath'];
               $path='./Uploads/'.$savepath.$savename; //原图
                
               $minPic='./Uploads/'.$savepath.'_80'.session('user')['id'].$savename;
               $midPic='./Uploads/'.$savepath.'_180'.session('user')['id'].$savename;
               $maxPic='./Uploads/'.$savepath.'_400'.session('user')['id'].$savename;
                $image=new Image();
              
                $image->open($path);
               $image->thumb(80,80)->save($minPic);
               $image->open($path);
               $image->thumb(180,180)->save($midPic);
               $image->open($path);
               $image->thumb(400,400)->save($maxPic);
              $imageArr=array(
                'min'=>$minPic,
                'mid'=>$midPic,
                'max'=>$maxPic,
                'source'=>$path,
             );
              echo json_encode($imageArr);
             }else{
                echo $upload->getError();
             }
    }
/*{"min":".\/Uploads\/Face\/2017-04-03\/_80658e2129ccb282.jpg","mid":".\/Uploads\/Face\/2017-04-03\/_180658e2129ccb282.jpg","max":".\/Uploads\/Face\/2017-04-03\/_400658e2129ccb282.jpg","source":".\/Uploads\/2017-04-03\/58e2129ccb282.jpg"}*/
/*
 [savename] => 58e101abc0df4.jpg
 [savepath] => 2017-04-02/

 */
        /**
         * [addGroup description]
         */
        public function addGroup(){
                //创建分组；
                if(IS_AJAX){

                    $data=array(
                        'name'=>I('post.name'),
                        'uid'=>session('user')['id']
                    );
                    if($id=M('group')->add($data)){
                         echo json_encode(array('status'=>$id,'msg'=>'创建好友分组成功'));
                    }else{
                       echo  json_encode(array('status'=>0,'msg'=>'创建分组失败！'));  
                    }
                   
                }else{
                    echo  json_encode(array('status'=>0,'msg'=>'创建分组失败！'));
                }
                
        }
        /**
         * ajax 添加好友分组；
         * @return [type] [description]
         */
        public function getGroup(){
            if(IS_AJAX){
                $groups=M('group')->where(array('uid'=>session('user')['id']))->select();
                echo json_encode($groups);

            }else{
                echo -1;
            }
        }

        /**
         *  添加关注
         */
        public function addFollow(){
            //添加关注；
             // [follow] => 7 关注的是7号；  我是sesison
             if(IS_AJAX){
                 $follow=M('follow');
                 $data=array(
                    'follow'=>I('post.follow'),
                    'fans'=>session('user')['id'],
                    'gid'=>I('post.group')
                );
                 if($id=$follow->add($data)){
                    $userinfo=M('userinfo');
                    
                    //我关注+1
        $userinfo->where(array('uid'=>session('user')['id']))->setInc('follow',1);

                    //他粉丝+1
        $userinfo->where(array('uid'=>I('post.follow')))->setInc('fans',1);
                       echo $id ? $id : -1; 

                       //在查询是否已经互相关注了 以后在做；
                 }else{
                    echo -1;
                 }
                
             }else{
                echo -1;
             }
        }

        //我取消他的关注；我的follow -1 他的fans -1   follow=他  fans=我 delete
        public function delFollow(){
            if(IS_AJAX){
                $follow_id=I('post.uid');
                $follow=M('follow');
                $map=array();
                $map['follow']=$follow_id;
                $map['fans']=session('user')['id'];
                $bool=$follow->where($map)->delete();
                $userinfo=M('userinfo');
                $userinfo->where(array('uid'=>$follow_id ))->setDec('fans');  //他；
                $userinfo->where(array('uid'=>session('user')['id'] ))->setDec('follow');
                echo $bool ? $bool : -1;
            }else{
                echo -1;
            }
        }
}