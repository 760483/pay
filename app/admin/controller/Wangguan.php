<?php
namespace app\admin\controller; 
  
  class Wangguan  extends Sjtadminsjt{ 
      
      public function wgbank(){
          
          $Sjapi = db("Sjapi");
          
          $listbank = $Sjapi->select();
          
          $System = db("System");
          
          $DefaultBank = $System->where("UserID=0")->value("DefaultBank");
          
          $id = $System->value("id");
          
          $this->assign("listbank",$listbank);
          $this->assign("DefaultBank",$DefaultBank);
          $this->assign("id",$id);
          
          return $this->fetch();
      }
      
      public function wggame(){
          
          $Gamepay = db("Gamepay");
          
          $list = $Gamepay->select();
          
          $this->assign("list",$list);
          
         return $this->fetch();
      }
  
     public function wggamexg(){
         $id = $this->_post("id");
         $defaultname = $this->_post("defaultname");
         
         $Gamepay = db("Gamepay");
         $data["default"] = $defaultname;
         $Gamepay->where("id = ".$id)->save($data);
         echo "ok";
     }
  
     public function wgbankedit(){
         
         $id = $this->_post("id");
         
         $DefaultBank = $this->_post("DefaultBank");
         
         $System = db("System");
         
         $data["DefaultBank"] = $DefaultBank;
         
         $System->where("id=".$id)->save($data);
         
         $Sjapi = db("Sjapi");
         $fl = $Sjapi->where("id=".$DefaultBank)->value("fl");
         
         $Paycost = db("Paycost");
         $data["wy"] = 1 - $fl;
         $Paycost->where("UserID=0")->save($data);
         
         $this->assign("msgTitle","");
 
         $this->assign("waitSecond",3);
         $this->assign("jumpUrl","/admin/admin/Wangguan/wgbank/UserID.html");
         $this->success("统一网银通道设置成功！");
     }    
      
  }
?>
