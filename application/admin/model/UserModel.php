<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class UserModel extends Model{


	/*
	验证管理员
	 */
	public static function check_admin($username,$pwd){
		$res=Db::name('admin')->where('username',$username)->field('username,password,activ')->find();
		if(empty($res)){
			return ['code'=>-1,'msg'=>'该用户不存在'];
		}elseif(md5($pwd)!=$res['password']){
			return ['code'=>-2,'msg'=>'密码错误'];
		}elseif(!$res['activ']){
			return ['code'=>-3,'msg'=>'该用户被冻结'];
		}else{
			session('admin.user',$res);
			return ['code'=>1,'msg'=>'ok'];
		}
	}


	//管理员列表
	public static function users(){
		$list=Db::name('admin')->field('id,username,password,sex,activ,create_time')->select();
		return $list;
	}


	//会员信息
	public static function user_info($id){

		$info=Db::name('admin')->field('id,username,password,sex,activ,create_time')->find();
		return $info;
	}

	//更新会员信息
	public static function update_user($id,$data){

		$res=Db::name('admin')->where('id',$id)->update($data);

		return ['code'=>1,'msg'=>'修改成功'];
	}


	//删除会员
	public static function del($id){
		
		$res=Db::name('admin')->where('id',$id)->delete();
		return ['code'=>1,'msg'=>'修改成功'];
	}

}