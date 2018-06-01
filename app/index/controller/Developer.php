<?php
namespace app\index\controller;
use think\Controller;
class Developer  extends Controller {
	
    function index(){
		var_dump(send_email('ruoshuisixue@sina.com', '小米', '胖胖'));
	}
    
}
