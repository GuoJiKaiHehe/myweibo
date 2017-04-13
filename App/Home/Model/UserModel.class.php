<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{

    protected $_validate=array(
             array('account','/^[a-zA-Z][\w]{4,16}$/','账号格式不正确！',0,'regex'), //默认情况下用正则进行验证
            array('account','','帐号名称已经存在！',0,'unique',1), 
             array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
            /* array('name','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
             array('value',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
             
             array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式*/
        );
    protected $_link=array(
            'userinfo'=>array(
                'mapping_type'=>self::HAS_ONE,
                'foreign_key'=>'uid',
            )
    );


    public function register(){
           $data=array(
                'account'=>I('post.account'),
                'password'=>I('post.pwd'),
                'repassword'=>I('post.pwded'),
                'userinfo'=>array(
                    'username'=>I('post.uname')
                    )
                ,'create_at'=>time(),
            );
           if($this->create($data)){
              
               unset($data['repassword']);
               $data['password']=md5($data['password']);
               if($uid=$this->relation(true)->add($data)){
                 
                return json_encode(array('error'=>0,'msg'=> '注册成功！'));

               }else{
                    return json_encode(array('error'=>1,'msg'=> '注册失败！'));
               }
                
           }else{

                return json_encode(array('error'=>1,'msg'=>$this->getError()));
           }

    }
    public function login(){
         $data=array(
                'account'=>I('post.account'),
                'password'=>I('post.pwd'),
            );
         // /^[a-zA-Z][\w]{4,16}$/';
         //$map=array();
         $map=array(
            'a.account'=>I('post.account'), 
            'a.id'=>'b.uid',
        );
         $account=I('post.account');
        $user=$this->table('wb_user a,wb_userinfo b')
                ->where("a.account='$account' AND a.id=b.uid")
                ->field('a.id,a.account,b.username,a.lock,a.password')
                ->find();
         

        if($user){
           // print_r($user);
            if($user['password']!=md5(I('post.pwd'))){
                return json_encode(array('error'=>1,'msg'=>'账号或者密码错误'));
            }
           
            $user=array(
                'id'=>$user['id'],
                'account'=>$user['account'],
                'username'=>$user['username']
            );
             session('user',$user);

             if(I('post.auto')=='on'){
                $value=$user['account'].'|'.get_client_ip(1);
                $value=encryption($value);
                cookie('auto',$value,time()+3600*24*7,'/');
             }
            return json_encode(array('error'=>0,'msg'=>'登陆成功！'));
        }else{
            return json_encode(array('error'=>1,'msg'=>'账号或者密码错误'));
        }
          
    }

    public function checkField($key,$value){

        if($this->where(array($key=>$value))->field('id')->find()){
            return 'false';
        }else{
            return 'true';
        }

    }

    public function checkUsername($username){
        if($this->table('wb_userinfo')->where(array('username'=>$username))->field('id')->find()){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function getUser(){

    }


}