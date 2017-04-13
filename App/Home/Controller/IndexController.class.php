<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    /**
     * 收藏微博；
     * @return [type] [description]
     */
    public function keep(){
        $keep=M('keep');

        $data=array(
            'wid'=>I('wid'),
            'uid'=>session('user')['id'],
            'create_at'=>time(),
        );
        if($keep->where(array('wid'=>I('wid'),'uid'=>session('user')['id'] ))->field('id')->find()){
            echo -1;
            return;
        }
        $kid=$keep->add($data);
        if($kid){
            M('weibo')->where(array('id'=>I('post.wid')))->setInc('keep');

            echo 1;
            return;
        }else{
            echo 0;
            return;
        }
    }
    public function me(){
        //个人主页；
    }
    public  function _empty($name){
        echo $name;
    }

    public function index($type='all',$gid=0){
       if($gid) $type=array('group'=>$gid);
        $weibo=D('Weibo');
        $data=$weibo->getWibo($type); //所有微博
        $this->assign('weibo',$data);
       //p($data);die;
       // echo $weibo->getLastSql();
        $content="[抱抱]啊手动@hee 阀[害羞] 呵呵";
     // echo preg_replace('/\[([\x{4e00}-\x{9fa5}]+)\]/iu', '<img src="./Public/Images/phiz/$1.gif" title="$1" />', $content); die;
        $face=M('userinfo')->where(array('uid'=>session('user')['id']))->field('face50')->find();
        $this->assign('face',$face['face50']);

       
        return $this->display();
    }

    public function sendWeibo(){
        
       
      

        $weibo= M('Weibo');
        $isturn=I('post.id') ? I('post.id') : 0;
       $data=array(
            'content'=>I('post.content'),
            'create_at'=>time(),
            'uid'=>session('user')['id'],
            'isturn'=>$isturn
        );
        $wid=$weibo->data($data)->add();
        $this->_atme($wid);
        /**
         * 判断是否转发的；
         */
        if($isturn>0){
            $weibo->where(array('id'=>$isturn))->setInc("turn");

        }
        if(I('post.mul')>0 ){
             $weibo->where(array('id'=>I('post.mul')))->setInc("turn");
        }
        /**
         * 判断是否有图片
         */
        if(I('post.becomment')>0){
            $com_data=array(
                'content'=>I('post.content'),
                'uid'=>session('user')['id'],
                'wid'=>I('post.becomment'),
                'create_at'=>time()
            );
             M('comment')->add($com_data);
              $weibo->where(array('id'=>I('post.becomment')))->setInc("comment");
        }

        M('userinfo')->where(array('uid'=>session('user')['id']))->setInc('weibo');
        /**
         * 判断是否有图片
         */
         if(  !empty(I('post.images')) && I('post.images')){
            $weibo->where(array('id'=>$wid))->save(array('isfigure'=>1));
            $img=M('picture');
            $images=I('post.images');
            foreach ($images as $key => $value) {
                    $datap=array();
                    foreach ($value as $k => $v) {
                        $datap[$k]=$v;
                        
                    }
                    $datap['wid']=$wid;
                    $img->add($datap);
            }
            
        }

        if($wid){
            echo json_encode(array('wid'=>$wid,'error'=>0,'msg'=>'新增成功！'));
        }else{
            echo json_encode(array('wid'=>$wid,'error'=>1,'msg'=>'新增失败'));
        }

       
    }
    public function _atme($wid){
         $preg='/@(\S+?)(\s+|$)|/i';
        preg_match_all($preg, I('post.content'), $matches);
       
        if(!empty($matches[1])){
            $userinfo=M('userinfo');
            foreach ($matches[1] as $key => $v) {
                if($user=$userinfo->where(array('username'=>$v))->field('uid')->find()){
                    
                    $data_atme=array(
                        'wid'=>$wid,
                        'uid'=>$user['uid'],
                        'create_at'=>time()
                    );
                  
                    M('atme')->add($data_atme);
                }
            }
        }

    }


    /**
     * 发表评论
     * @return [type] [description]
     */
    public function sendComment(){

      /*  p(I('post.'));
        die;*/
        $data=array();
        $data['uid']=I('post.uid');
        $data['wid']=I('post.wid');
        $data['content']=I('post.content');
        $data['create_at']=time();

        $cid=M('comment')->add($data);
        if($cid){
            M('weibo')->where(array('id'=>$data['wid']))->setInc('comment');
        }
        //$cid?$cid:0;
        $user=M('userinfo')->where(array('uid'=>$data['uid']))->find();

        $str='<dl class="comment_content" style="border-bottom:1px solid #ccc;">
             <dt style="width:50px;"><a href="##">
                 <img src="'.substr($user['face50'],1).'" alt="">
             </a></dt>
             <dd style="width:85%;">
                 <a href="" class="comment_name">'.$user['username'].'</a>
                    <p>'.preg_replace('/\[\[([\x{4e00}-\x{9fa5}]+)\]\]/iue', 'jiexibiaoqing(${1})', $data['content']).'</p>
                     <div class="reply" style="position:relative; right:40px;">
                         <a href="">回复</a>
                     </div>
             </dd>
         </dl>';
         echo $str;

    }
    /**
     * 获取评论内容；
     * @return [type] [description]
     */
    public function getComment(){
        $pagesize=3;
        $page=I('post.page')?I('post.page'):1;
        
        $offset=($page-1)*3;
        $wid=I('post.wid');
        $comments=M('comment')->where(array('wid'=>$wid))->order('create_at desc')->limit($offset,10)->select();
       
        $count=M('comment')->where(array('wid'=>$wid))->count();
        $total_page=ceil(($count/2));
        // $page=new \Think\Page($count,3);
        foreach($comments as $key=>$value){
            $user=M('userinfo')->where(array('uid'=>$value['uid']))->find();
            $str.='<dl class="comment_content" style="border-bottom:1px solid #ccc;">
             <dt style="width:50px;"><a href="/u/'.$user['uid'].'">
                 <img src="'.substr($user['face50'],1).'" alt="">
             </a></dt>
             <dd style="width:85%;">
                 <a href="" class="comment_name">'.$user['username'].'</a>
                    <p style="margin-top:10px;">'.preg_replace('/\[\[([\x{4e00}-\x{9fa5}]+)\]\]/iue', 'jiexibiaoqing(${1})', $value['content']).'</p>
                     <div class="reply" style="position:relative; right:40px;">
                         <span style="text-align:left;">'.date('Y-m-d H:i:s',$value['create_at']).'</span><a href="">回复</a>
                     </div>
             </dd>
         </dl>';
        }
        $str.'<div>';
        for($i=1;$i<=$total_page;$i++){

            $str.='<span page="'.$i.'">'.$i.'</span>';
        }
        $str.='</div>';
        echo $str;
    }


    public function logout(){
        session('user',null);
        if(cookie('auto')){
            cookie('auto',null);
        }
       return  redirect('Login/index');
    }




}