<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\SystemModel;
class Base extends Controller{

	/*
	
	后台初始化
	 */
	public function _initialize(){

		if(!session('admin.user')){
			$this->error('您还没有登录',url('login/login'));
		}

		$config=SystemModel::configs('system');
		
		$this->assign('config',$config);

	}

}