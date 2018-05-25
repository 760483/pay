<?php
namespace app\common\controller;
use think\Controller;
  class Common  extends Controller {
	 
	 public function ret($code=0,$data='',$msg=''){
		  $retData['code']=$code;
		 $retData['data']=$data;
		  $retData['msg']=$msg;
		 return json($retData);
	 }
    
}
