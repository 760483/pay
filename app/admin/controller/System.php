<?php
namespace app\admin\controller;
   
    class System  extends Sjtadminsjt{
        
        private $PayCost  = array(
        
            "wy" => "网银",
            "thykt" => "天宏一卡通",
            "wmykt" => "完美一卡通",
            "wyykt" => "网易一卡通",
            "ltczk" => "联通充值卡",
            "jyykt" => "久游一卡通",
            "qqczk" => "QQ币充值卡",
            "shykt" => "搜狐一卡通",
            "ztyxk" => "征途游戏卡",
            "jwykt" => "骏网一卡通",
            "sdykt" => "盛大一卡通",
            "qgszx" => "全国神州行",
            "txykt" => "天下一卡通",
            "dxczk" => "电信充值卡",
            "gyykt" => "光宇一卡通",
            "zyykt" => "纵游一卡通",
            "yddx" => "移动短信",
            "ltdx" => "联通短信",
            "dxdx" => "电信短信"
            
        );
        
       
        
        public function czfl(){   //显示冲值费率
        
           $Paycost = db("Paycost");
           
           $list = db('channel')->where("UserID=0")->select();
           
           $this->assign("list",$list);
           $this->assign("PayCost",$this->PayCost);
           
           return $this->fetch();
            
        }
        
        public function czfledit(){   //修改冲值费率
            
            $Paycost = db("Paycost");
            
            $data["thykt"] = input("thykt");
            $data["wy"] = input("wy");
            $data["wmykt"] = input("wmykt");
            $data["wyykt"] = input("wyykt");
            $data["ltczk"] = input("ltczk");
            $data["jyykt"] = input("jyykt");
            $data["qqczk"] = input("qqczk");
            $data["shykt"] = input("shykt");
            $data["ztyxk"] = input("ztyxk");
            $data["jwykt"] = input("jwykt");
            $data["sdykt"] = input("sdykt");
            $data["qgszx"] = input("qgszx");
            $data["txykt"] = input("txykt");
            $data["dxczk"] = input("dxczk");
            $data["gyykt"] = input("gyykt");
            $data["zyykt"] = input("zyykt");
            $data["yddx"] = input("yddx");
            $data["ltdx"] = input("ltdx");
            $data["dxdx"] = input("dxdx");
            $data["nbzz"] = input("nbzz");
            
            $Paycost->where("id=".input("id"))->save($data);
            
            $this->assign("msgTitle","");
         
            $this->assign("waitSecond",3);
            $this->assign("jumpUrl","/admin/System/czfl.html");
            $this->success("修改成功！");
        }
        
        public function Diaodan(){
            
            $System = db("System");
            
            $list = $System->where("UserID=0")->select();
            
            $this->assign("list",$list);
            
            return $this->fetch();
        } 
        
        public function Diaodanedit(){
            
            $System = db("System");
            
            $data["Diaodan_OnOff"] = input("Diaodan_OnOff");
            
            $data["Diaodan_Kdate"] = input("Diaodan_Kdate");
            
            $data["Diaodan_Sdate"] = input("Diaodan_Sdate");
            
            $data["Diaodan_Kmoney"] = input("Diaodan_Kmoney");
            
            $data["Diaodan_Smoney"] = input("Diaodan_Smoney");
            
            $data["Diaodan_Pinlv"] = input("Diaodan_Pinlv");
            
            $data["Diaodan_Type"] = input("Diaodan_Type");
            
            $data["Diaodan_huifu"] = input("Diaodan_huifu");
            
            $System->where("UserID=0")->save($data);
            
            
            $this->assign("msgTitle","");
            $this->assign("message","修改成功！");
            $this->assign("waitSecond",3);
            $this->assign("jumpUrl","/admin/System/Diaodan.html");
            $this->success("修改成功！");
            
        } 
        
        public function txfl(){
            
            $Tkfl = db("Tkfl");
            
            $t = input("t");
            
            $list = $Tkfl->where("t=".$t)->order("k_money asc")->paginate(10);
			
             $this->assign("page",$list->render());
            $this->assign("list",$list);
            
            return $this->fetch();
            
        }
        
        public function txfladd(){
            $Tkfl = db("Tkfl");
            
            $Tkfl->create();
            
            $Tkfl->add();
            
            $this->assign("msgTitle","");
      
            $this->assign("waitSecond",3);
            $this->assign("jumpUrl","/admin/System/txfl/t/".input("T").".html");
            $this->success("添加成功！");
        }
        
        public function txfldel(){
            
            $id = input("id");
            
            $Tkfl = db("Tkfl");
            
            $Tkfl->where("id=".$id)->delete();
            
            $this->assign("msgTitle","");
         
            $this->assign("waitSecond",3);
            $this->assign("jumpUrl","/admin/System/txfl/t/".input("t").".html");
            $this->success("删除成功！");
        }
        
        public function txflbj(){
            
            $id = input("id");
            
            $Tkfl = db("Tkfl");
            
            $list = $Tkfl->where("id=".$id)->select();
            
            $this->assign("list",$list);
            
            return $this->fetch();
        }
        
        public function txflbjedit(){
            
            $Tkfl = db("Tkfl");
            
            //$Tkfl->create();
            $data["k_money"] = input("k_money");
            $data["s_money"] = input("s_money");
            $data["fl_money"] = input("fl_money");
            
            $Tkfl->where("id=".input("id"))->save($data);
            
            $this->assign("msgTitle","");
         
            $this->assign("waitSecond",3);
            $this->assign("jumpUrl","/admin/System/txflbj/id/".input("id").".html");
            $this->success("修改成功！");
            
        }
        
       
       public function xgmm(){
           
           return $this->fetch();
           
       }
       
       public function xgmmedit(){
           header("Content-Type:text/html; charset=utf-8");
           $YPassWord = input("YPassWord");
           $XPassWord = input("XPassWord");
           $PassWord = input("PassWord");
           
           if($YPassWord == NULL || $YPassWord == ""){
               exit("<script type='text/javascript'>alert('原密码不能为空！'); history.go(-1);</script>");
           }
           
           if($XPassWord == NULL || $XPassWord == ""){
               exit("<script type='text/javascript'>alert('新密码不能为空！'); history.go(-1);</script>");
           }
           
           if($XPassWord != $PassWord){
               exit("<script type='text/javascript'>alert('两次新密码输入不一致！'); history.go(-1);</script>");
           }
           
           $Sjtadminsjt = db("Sjtadminsjt");
           
           $listnum = $Sjtadminsjt->where("SjtUserName = '".session("SjtUserName")."' and SjtPassWord = '".md5($YPassWord)."'")->count();
           if($listnum > 0){
               $data["SjtPassWord"] = md5($PassWord);
               $xgmm = $Sjtadminsjt->where("SjtUserName = '".session("SjtUserName")."' and SjtPassWord = '".md5($YPassWord)."'")->save($data);
               
               if($xgmm){
                   exit("<script type='text/javascript'>alert('密码修改成功！'); location.href='/SjtAdminSjt_System_xgmm.html'</script>");
               }else{
                   exit("<script type='text/javascript'>alert('修改失败！'); history.go(-1);</script>");
               }
           }else{
               exit("<script type='text/javascript'>alert('原密码错误！'); history.go(-1);</script>");
           }
           
       }
    }
?>
