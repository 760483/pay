<?php
namespace app\admin\controller;
use think\Controller;
  class Sjtadminsjt  extends Controller{
      
        public function login(){
        header("Content-Type:text/html; charset=utf-8");
        $UserName = input("UserName");
        $PassWord =  input("PassWord");
	 
        
        if($UserName == NULL || $UserName == "" || $PassWord == NULL || $PassWord == "" ){
            exit("no");
        }else{
            $Sjtadminsjt = db("Sjtadminsjt");
            $list = $Sjtadminsjt->where("SjtUserName = '".$UserName."' and SjtPassWord = '".md5($PassWord)."'")->select();
            $SjtUserType = $Sjtadminsjt->where("SjtUserName = '".$UserName."' and SjtPassWord = '".md5($PassWord)."'")->value("SjtUserType");
            if($list){
                session("SjtUserName",$UserName);
                
                session("SjtUserType",$SjtUserType);
                 
                echo 1;
				exit;
            }else{
                exit("no");
            }
        }
    }
    
    
    public function logout(){        
        session("SjtUserName",null);
        session("SjtUserType",null);
        $this->display("Index:login");
    }
    
  }
?>
