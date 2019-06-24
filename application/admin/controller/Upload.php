<?php
namespace app\admin\controller;
use think\Db;
class Upload extends Base{
	
	public function upload(){
	      $file=request()->file('file');
	      if(empty($file)){
	          $this->respon([],'没有上传文件', 202);
	      }
	      $info = $file->move(ROOT_PATH . 'public/uploads/files');

	      $res='';
	      $msg='失败';
	      $code=400;
	      if($info){
	          $file_src='/public/uploads/'. $info->getSaveName();
	          //插入数据库
	          $data=[
	      			'size'		=>$info->checkSize(),
	      			'path'		=>$file_src,
	      			'ext'		=>'',
	      			'name'		=>$info->getInfo()['name'],
	      			'create_time'	=>get_date()
	      		];
	          $file_id=db('attachment')->insertGetId($data);
	          $res=$file_id;
	          $msg='上传成功';
	          $code=200;
	      }
	      return ['res'=>$res,'msg'=>$msg,'code'=>$code];
	}


	public static function up(){

		echo '<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  				<legend>拖拽上传</legend>
			</fieldset> 
 
			<div class="layui-upload-drag" id="test10">
			  <i class="layui-icon"></i>
			  <p>点击上传，或将文件拖拽到此处</p>
			</div>
				<script type="text/javascript" src="/static/Admin/js/layui.js"></script>
				<script type="text/javascript">
				  layui.use("upload", function () {
				        var $ = layui.jquery
				            , upload = layui.upload;
				        //执行实例
				        var uploadInst = upload.render({
				            elem: "#test10"
				            , url: "'.url("admin/upload/upload").'"       
				            , done: function (res) {
				                //如果上传失败
				                if (res.code > 0) {
				                    return layer.msg("图片选择失败");
				                }
				                //上传成功
				                else {
				                	layer.msg("上传成功")
				                }
				            }
				        });

				  
				    });
				</script>';
	}
}