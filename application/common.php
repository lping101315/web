<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/*

上传文件
 */
use app\admin\controller\Upload;

function get_up_asse(){
	Upload::up();
}


/*
 * 获取日期时间
 * */
function get_date(){

    return date("Y-m-d H:i:s",time());
}


/*
获取文件路径
 */
function get_file_path($file){

	$src=db('attachment')->where('id',$file)->value('path');
	return $src;

}