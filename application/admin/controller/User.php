<?php
namespace app\admin\controller;
use app\admin\model\UserModel;
class User extends Base{

	//管理员列表
	public function lists(){
		$list=UserModel::users();

		$this->assign('user',$list);
		return $this->fetch();
	}


	//编辑
	public function edit(){
		if(request()->isPost()){
			$cont=input('post.')['data'];
			if(isset($cont['activ'])){
				if($cont['activ']=='启用'){
						$cont['activ']=1;
				}else{
					$cont['activ']=0;
				}
			}
			dump($cont);die;
			$id=$cont['id'];
			unset($cont['id']);
			$res=UserModel::update_user($id,$cont);
			return $res;

		}


		$id=input('id');
		$info=UserModel::user_info($id);
		if(empty($info)){
			$this->error('该用户不存在');
		}
		$this->assign('id',$id);
		$this->assign('user',$info);
		return $this->fetch();
	}


	//停用会员
	public function stop(){
		$type=input('type')?0:1;
		$uid=input('uid');
		$res=UserModel::update_user($uid,['activ'=>$type]);
		return $res;
	}


	//删除用户
	public function del(){
		$id=input('id');
		$res=UserModel::del($id);
	}

}