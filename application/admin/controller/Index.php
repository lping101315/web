<?php
namespace app\admin\controller;
class Index extends Base{

	public function index(){

		return $this->fetch();
	}

	public function welcome(){
		$user=session('admin.user');

		$this->assign('user',$user);
		return $this->fetch();
	}

}