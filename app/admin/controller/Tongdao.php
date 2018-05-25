<?php
namespace app\admin\controller; 
  
  class Tongdao extends Sjtadminsjt{

      private $BankArray = array(
              "zsyh" => "",
              "gsyh" => "",
              "jsyh" => "",
              "shpdfzyh" => "",
              "nyyh" => "",
              "msyh" => "",
              "szfzyh" => "",
              "xyyh" => "",
              "jtyh" => "",
              "gdyh" => "",
              "zgyh" => "",
              "payh" => "",
              "gfyh" => "",
              "zxyh" => "",
              "nbyh" => "",
              "fdyh" => "",
              "zgyzcxyh" => ""
              );
      
      private $GameArray = array(
             "1" => "",
             "2" => "",
             "3" => "",
             "4" => "",
             "5" => "",
             "6" => "",
             "7" => "",
             "8" => "",
             "9" => "",
             "10" => "",
             "11" => "",
             "12" => "",
             "13" => "",
             "14" => "",
             "15" => "",
             "16" => "",
             "17" => "",
             "18" => ""
      );
      
     
      
      public function Index(){
          $apiname = input("apiname");
          $Sjapi = db("Sjapi");
          $list = $Sjapi->where("apiname='".$apiname."'")->select();
          $this->assign("list",$list);
          $this->assign("datetime",strval(date("Y-m-d")));
         return $this->fetch();
      }
      
      public function EditTongdao( $apiname){
           
          $shid = input("shid");
          $key = input("key");
          $zhanghu = input("zhanghu");
          $datetime = input("datetime");
          $xz = input("xz");
          $fl = input("fl"); 
          $Sjapi = db("Sjapi");		  
          $data["shid"] = $shid;
          $data["key"] = $key;
          $data["zhanghu"] = $zhanghu;
          $data["edit_date"] = $datetime;
          $data["xz"] = $xz;
          $data["fl"] = $fl;
         $Sjapi-> where("apiname" ,$apiname)->update($data);
           
        $this->assign("msgTitle","");
        $this->assign("message","修改成功！");
        $this->assign("waitSecond",1);
        $this->assign("jumpUrl","/admin/Tongdao/Index/apiname/".$apiname.".html");
       $this->success("修改成功！");
      }
      
      
      public function bankpay(){
          $apiname = input("apiname");
          
          $Bankpay = db("Bankpay");
          
          foreach($this->BankArray as $key => $val){
             $this->BankArray[$key] = $Bankpay->where("Sjt='".$key."'")->value($apiname);
          }
          
          $this->assign("apiname",$apiname);
          $this->assign("BankArray",$this->BankArray);
          
         return $this->fetch();
           
      }
      
       public function gamepay(){
          $apiname = input("apiname");

          $Gamepay = db("Gamepay");
          
          foreach($this->GameArray as $key => $val){
             $this->GameArray[$key] = $Gamepay->where("Sjt='".$key."'")->value($apiname);
          }
          
          $this->assign("apiname",$apiname);
          $this->assign("GameArray",$this->GameArray);
          
         return $this->fetch();
           
      }
      
      public function EditBankpay(){
        
          $apiname = input("apiname");
          
          $Bankpay = db("Bankpay");
          
          foreach($this->BankArray as $key => $val){
              $data[$apiname] = input($key);
              $Bankpay->where("Sjt = '".$key."'")->save($data);
          }
          

          $this->assign("msgTitle",""); 
          $this->assign("waitSecond",2);
          $this->assign("jumpUrl","/admin/Tongdao/bankpay/apiname/".$apiname.".html");
          return $this->success("修改成功！");
          
      }
      
      
       public function EditGamepay(){
        
          $apiname = input("apiname");
          
          $Gamepay = db("Gamepay");
          
          foreach($this->GameArray as $key => $val){
              $data[$apiname] = input($key);
              $Gamepay->where("Sjt = '".$key."'")->save($data);
          }
          

          $this->assign("msgTitle","");
         
          $this->assign("waitSecond",3);
          $this->assign("jumpUrl","/admin/Tongdao/gamepay/apiname/".$apiname.".html");
            $this->success("修改成功！");
          
      }
      
      public function sjfl(){
          $apiname = $this->_request("apiname");
          
          $Sjfl = db("Sjfl");
          
          $list = $Sjfl->where("jkname='".$apiname."'")->select();
          
          $this->assign("list",$list);
         return $this->fetch();
      }
      
      public function sjfledit(){
           $Sjfl = db("Sjfl");
            
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
            
            $Sjfl->where("id=".input("id"))->save($data);
            
            $this->assign("msgTitle","");
            $this->assign("message","修改成功！");
            $this->assign("waitSecond",3);
            $this->assign("jumpUrl","/admin/Tongdao/sjfl/apiname_".input("apiname").".html");
            $this->success("修改成功！");
      }
  }
?>
