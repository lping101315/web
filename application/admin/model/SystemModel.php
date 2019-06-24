<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class SystemModel extends Model{


	/*
	获取config
	 */
	public static function config($value){

		$v=Db::name('config')->where('name',$value)->field('value,type')->find();
		if($v['type']=='json'){
			return json_decode($v['value'],true);
		}
		return $v['value'];
	}

	/*
	
	获取某个类型
	 */
	public static function configs($class){
		$vs=Db::name('config')->where('class',$class)->field('value,type,name')->select();
		$v=[];
		if(!empty($vs)){
			foreach ($vs as $key => $value) {
					if($value['type']=='json'){
						$v[$value['name']]=json_decode($value['value'],true);
					}else{
						$v[$value['name']]=$value['value'];
					}
			}
		}
		return $v;
	}




}