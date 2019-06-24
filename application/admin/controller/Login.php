<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use think\Session;
use app\admin\model\UserModel;
class Login extends Controller {

		//登录页面
		public function login(){
			if(request()->isPost()){
				$cont=input('post.');
				//校验验证码
	            $captcha=Session::get("captcha");
	            if($captcha!=$cont['captchat']){
	                $this->error('验证码错误');
	            }
	            $res=UserModel::check_admin($cont['username'],$cont['password']);

	            if($res['code']!=1){
	            	$this->error($res['msg']);
	            }else{
	            	$this->redirect(url('index/index'));
	            }
			}
			return $this->fetch();
		}

	/*
     * 验证码
     * */
        public function captchat(){
        import('captcha.captcha',EXTEND_PATH);
        $captcha = new \Captcha();
        $captcha->doimg();
        Session::set("captcha",$captcha->getCode());
        exit;
    }
}