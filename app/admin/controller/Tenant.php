<?php
namespace app\admin\controller;
 

  class Tenant  extends Sjtadminsjt{
      
   
      
      
      public function listuser(){
   
        $wherestr = "";
        if(input("SearchContent")){
            $wherestr = $wherestr." (Shh like '%".(intval(input("SearchContent"))-10000)."%' or UserName like '%".input("SearchContent")."%' or qq like '%".input("SearchContent")."%' or dbobilePhone like '%".input("SearchContent")."%' or Compellation like '".input("SearchContent")."')";
        }else{
            $wherestr = $wherestr."1=1";
        }
        
        if(input("UserType") != "" && input("UserType") != Null){
            $Sjapi = db("Sjapi");
            $PayBank = $Sjapi->where("apiname='".input("UserType")."'")->value("id");
            $System = db("System");
            $DefaultBank = $System->where("UserID=0")->value("DefaultBank");
            if($PayBank == $DefaultBank){
               $wherestr = $wherestr." and (PayBank = ".$PayBank." or PayBank = 0)";
            }else{
                $wherestr = $wherestr." and PayBank = ".$PayBank;
            }
            
            //exit($wherestr);
         
        }else{
            $wherestr = $wherestr." and 1=1";
              //exit($wherestr);
        }
        
        if(input("Zt") != NULL){
            $wherestr = $wherestr." and Zt = ".input("Zt");
        }else{
            $wherestr = $wherestr." and 1=1";
        }
        
        if(input("status") != NULL){
            $wherestr = $wherestr." and status = ".input("status");
        }else{
            $wherestr = $wherestr." and 1=1";
        }
        
        if(input("Userlx") != NULL){
            if(input("Userlx") == 5){
               $wherestr = $wherestr." and UserType = 5";
            }else{
                $wherestr = $wherestr." and UserType <> 5";
            }
           
        }else{
            $wherestr = $wherestr." and 1=1";
        }
        
          
        $Listuser = db('Listuser');  
        
        $list = $Listuser->where($wherestr)-> order('Zt desc,Shh desc')->paginate(10);  
		 $Sjapi = db("Sjapi");
		 $listtongdao = $Sjapi->select(); 
		 
		 $this->assign('page', $list->render());
        $this->assign("listtongdao",$listtongdao);
        $this->assign("list", $list); //数据循环变量 
		 
       return $this->fetch();

      }
      
      
      public function ShowShenhe(){
          
          $UserID = input("UserID");
          
          $Userapiinformation = db("Userapiinformation");
          
          $list = $Userapiinformation->where("UserID = ".$UserID)->select();
          
          $this->assign("list",$list);
          $this->assign("UserID",$UserID);
          return $this->fetch();;

      }
      
      
      public function Dongjie(){
          $status = input("status");
          $UserIDList = $this->_post("UserIDList");
          if($status == Null){
              exit("s");
          }else{
              
              $User = db("User");
              
              $data["status"] = $status;
              
              if($User->where("id in (".$UserIDList.")")->save($data)){
                  exit("ok");
              }
          
          }
      }
      
      public function Deletesh(){
          $UserIDList = $this->_post("UserIDList");
          
          $User = db("User");
          
          if($User->where("id in (".$UserIDList.")")->delete()){
              
              $Userapiinformation = db("Userapiinformation");
              
              if($Userapiinformation->where("UserID in (".$UserIDList.")")->delete()){
                  
                  $Userbasicinformation = db("Userbasicinformation");
                  
                  if($Userbasicinformation->where("UserID in (".$UserIDList.")")->delete()){
                   
                        $Usersafetyinformation = db("Usersafetyinformation"); 
                        
                   if($Usersafetyinformation->where("UserID in (".$UserIDList.")")->delete()){
                      // exit("ok");
                   }else{
                      // exit("no");
                   }
                      
                  }else{
                      //exit("no");
                  }
                  
              }else{
                  //exit("no");
                  
              }
          }else{
              //exit("no");
          }
          
          exit("ok");
      }
      
      
      public function DengluEmail(){
          $Email = new EmailAction();
          
          $UserID = $this->_post("UserID");
          
          $User = db("User");
       //   $rand = rand(100000,999999);
       $rand  = "123456";
          $data["LoginPassWord"] = md5($rand);
          $User->where("id = ".$UserID)->save($data);
              
          /*
          $Emailname = $User->where("id = ".$UserID)->value("UserName");
          $a = $a."------".$Emailname;
          $EmailHTdbL = "您".C("WEB_NAdbE")."新的登录密码是：<b>".$rand."</b>";
          $ReturnEamil = $Email->SendEmail($Emailname,"您".C("WEB_NAdbE")."新的登录密码",$EmailHTdbL);
          */
          //if($ReturnEamil == "1"){
            exit("ok");
          //}else{
            //exit($Emailname);
         // }
        
          
      }
      
      
      public function PayEmail(){
          
          $Email = new EmailAction();
          
          $UserID = $this->_post("UserID");
          
          $Usersafetyinformation = db("Usersafetyinformation");
        // $rand = rand(100000,999999);
        $rand = "123456";
          $data["PayPassWord"] = md5($rand);
          $Usersafetyinformation->where("UserID = ".$UserID)->save($data);

          /*
          $User = db("User");    
          $Emailname = $User->where("id = ".$UserID)->value("UserName");
          $a = $a."------".$Emailname;
          $EmailHTdbL = "您".C("WEB_NAdbE")."新的支付密码是：<b>".$rand."</b>";
          $ReturnEamil = $Email->SendEmail($Emailname,"您".C("WEB_NAdbE")."新的支付密码",$EmailHTdbL);
          */
      //    if($ReturnEamil == "1"){
            exit("ok");
        //  }else{
           // exit($Emailname);
       //   }  
      }
      
      
      public function KaiTongT0(){
          $UserIDList = $this->_post("UserIDList");
          
          $Usersafetyinformation = db("Usersafetyinformation");
              
          $data["t0"] = 1;
              
          $Usersafetyinformation->where("UserID in (".$UserIDList.")")->save($data);
            exit("ok");
          
      }
      
      public function KaiTongT1(){
          $UserIDList = $this->_post("UserIDList");
          
          $Usersafetyinformation = db("Usersafetyinformation");
              
          $data["t0"] = 0;
              
          $Usersafetyinformation->where("UserID in (".$UserIDList.")")->save($data);
            exit("ok");
          
      }
      
      
     public function PayBank(){
         
         $UserIDList = input("UserIDList");
         
         $Listuser  = db("Listuser");
         
         $list = $Listuser->where("Shh in (".$UserIDList.")")->select();
         
         $Sjapi = db("Sjapi");
         
         $banklist = $Sjapi->select();
         
         $this->assign("banklist",$banklist);
         $this->assign("list",$list);
         $this->assign("UserIDList",$UserIDList);
         
         return $this->fetch();;
     }
     
     public function Fstz(){
         $UserIDList = input("UserIDList");
         
         $Listuser  = db("Listuser");
         
         $list = $Listuser->where("Shh in (".$UserIDList.")")->select();
         
         //$Sjapi = db("Sjapi");
         
         //$banklist = $Sjapi->select();
         
        // $this->assign("banklist",$banklist);
         $this->assign("list",$list);
         $this->assign("UserIDList",$UserIDList);
         
         return $this->fetch();;
     }
     
     public function Sjapi(){
         
         $id = $this->_post("id");
         
         if($id == NULL){
             exit("NULL");
         }else{
             $Sjapi = db("Sjapi");
             $myname = $Sjapi->where("id = ".$id)->value("myname");
             exit($myname);
         }
     }
     
     public function Plbank(){
         $UserIDList = $this->_post("UserIDList");
         $PayBank = $this->_post("PayBank");
         
         $Usersafetyinformation = db("Usersafetyinformation");
         
         $data["PayBank"] = $PayBank;
         
         $Usersafetyinformation->where("UserID in (".$UserIDList.")")->save($data);
         
         exit("ok");
        
       // exit("UserID in ("+$UserIDList+")");

     }
     
     public function Pltongzhi(){
          $UserIDList = $this->_post("UserIDList");
          $Title = $this->_post("Title");
          $Content = $this->_post("TzContent");
          $Content = str_replace("\r\n","<br>",$Content);
          $list = split(",",$UserIDList);
          $Tongzhi = db("Tongzhi");
          foreach($list as $key=>$value){
              $data["Title"] = $Title;
              $data["Content"] = $Content;
              $data["datetime"] = date("Y-m-d H:i:s");
              $data["UserID"] = $value;
              $Tongzhi->add($data);
          }
          
           exit("ok");
     }
     
     
     public function ShowEdit(){
         
         $UserID = input("UserID");
         
         $Userbasicinformation = db("Userbasicinformation");
         
         $basiclist = $Userbasicinformation->where("UserID=".$UserID)->select();
         
         $Userapiinformation = db("Userapiinformation");
         
         $apilist = $Userapiinformation->where("UserID=".$UserID)->select();
         
         $User = db("User");
         
         $UserType = $User->where("id=".$UserID)->value("UserType");
         
         $SjUserID = $User->where("id=".$UserID)->value("SjUserID");
         
         $sjusername = $User->where("id=".$SjUserID)->value("UserName");
         
         $sjname = $Userbasicinformation->where("UserID=".$SjUserID)->value("Compellation");
         
         if($UserType == 5){
             $Userlx = 5;
         }else{
             $Userlx = 1;
         }
         
         $this->assign("Userlx",$Userlx);
         $this->assign("sjusername",$sjusername);
         $this->assign("sjname",$sjname);
         $this->assign("basiclist",$basiclist);
         $this->assign("apilist",$apilist);
         
         return $this->fetch();;
           
     }
     
     public function EditSjdl(){
         $sjusername = $this->_post("sjusername");
         $UserID = $this->_post("UserID");
         $User = db("User");
         if(trim($sjusername) == ""){
             $sjUserID = 0;
             $data["SjUserID"] = $sjUserID;
             $User->where("id=".$UserID)->save($data);
             exit("ok");
         }else{
             
             $sjUserID = $User->where("UserName='".$sjusername."'")->value("id"); 
             if(!$sjUserID || $sjUserID == $UserID){
                 eixt("no");
             }else{
                 $data["SjUserID"] = $sjUserID;
                 $User->where("id=".$UserID)->save($data);
                  exit("ok"); 
             }
         }
        
         
         
     }
     
     public function Userlx(){
         $User = db("User");
         $UserID  = $this->_post("UserID");
         $Userlx = $this->_post("Userlx");
         
         $data["UserType"] = $Userlx;
         
         $User->where("id=".$UserID)->save($data);
         
         exit("ok");
     }
     
     
     public function Userbasicinformationedit(){
         
         $Userbasicinformation = db("Userbasicinformation");
         
         $data["Compellation"] = $this->_post("Compellation");
         $data["dbobilePhone"] = $this->_post("dbobilePhone");
         $data["Tel"] = $this->_post("Tel");
         $data["IdentificationCard"] = $this->_post("IdentificationCard");
         $data["Address"] = $this->_post("Address");
         $data["Province"] = $this->_post("province");
         $data["City"] = $this->_post("city");
         $data["qq"] = $this->_post("qq");
         
         $Userbasicinformation->where("UserID=".$this->_post("UserID"))->save($data);
         
         exit("ok");
         
     }
     
     
     public function Userapiinformationedit(){
         
         $Userapiinformation = db("Userapiinformation");
         
         $data["CompanyName"] = $this->_post("CompanyName");
         $data["WebsiteName"] = $this->_post("WebsiteName");
         $data["WebsiteUrl"] = $this->_post("WebsiteUrl");
        
         $Userapiinformation->where("UserID=".$this->_post("UserID"))->save($data);
         
         exit("ok");
         
     }
     
     //////////////////////////////////////////////////////////////////////////////////
     public function listuserwjh(){
         
         $wherestr = "status=0";
         $User = db('User');  
         $count = $User->where($wherestr)->count();    //计算总数 
      
         
         $list = $User->where($wherestr) ->order('RegDate desc')->paginate(10); 
      
        
        $this->assign("page",  $list->render()); 
        $this->assign("list", $list); //数据循环变量 
        return $this->fetch(); 
     }
     
     
     
     public function JiHuoEmail(){
         
          $Email = new EmailAction();
          
          $UserID = $this->_post("UserID");
          
          $User = db("User");    
          $Emailname = $User->where("id = ".$UserID)->value("UserName");
          $activate = $User->where("id = ".$UserID)->value("activate");

           $EmailHTdbL = "亲爱的会员：".$Emailname."您好！ <br>感谢您注册".C("WEB_NAdbE")."账户！<br>您现在可以激活您的".C("WEB_NAdbE")."账户，激活成功后，您可以使用".C("WEB_NAdbE")."提供的各种支付服务。 <br><a href='http://". C("WEB_URL") ."/Index_Activate_id_".$UserID."_activate_".$activate.".html'>点此激活".C("WEB_NAdbE")."账户 </a><br>如果上述文字点击无效，请把下面网页地址复制到浏览器地址栏中打开：<br>http://". C("WEB_URL") ."/Index_Activate_id_".$id."_activate_".$key.".html<br>此为系统邮件，请勿回复<br>请保管好您的邮箱，避免".C("WEB_NAdbE")."账户被他人盗用<br>如有任何疑问，可查看 ".C("WEB_NAdbE")."相关规则，".C("WEB_NAdbE")."网站访问 http://". C("WEB_URL")."/<br>Copyright ".C("WEB_NAdbE")." 2013 All Right Reserved";
           $ReturnEamil = $Email->SendEmail($Emailname,C("WEB_NAdbE")."账户激活邮件！",$EmailHTdbL); 
          
          if($ReturnEamil == "1"){
            exit("ok");
          }else{
            exit($Emailname);
          }  
         
     }
     
     public function Sxf(){   //单独设置手续费
         
         $UserID = input("UserID");
         
         $User = db("User");
         
         $UserName = $User->where("id=".$UserID)->value("UserName");
         
         $Paycost = db("Paycost");
         
         $listpaycost = $Paycost->where("UserID=".$UserID)->select();
         
         if(!$listpaycost){
             
             $data["UserID"] = $UserID;
             
             $Paycost->add($data);
             
             $listpaycost = $Paycost->where("UserID=".$UserID)->select();
         }
         
         $this->assign("UserName",$UserName);
         $this->assign("listpaycost",$listpaycost);
         return $this->fetch();;
     }
     
     public function Sxfs(){   //单独设置手续费
         
         $UserID = input("UserID");
         
         $User = db("User");
         
         $UserName = $User->where("id=".$UserID)->value("UserName");
         $tongdao = $User->where("id=".$UserID)->value("tongdao");
         $sjapi = db("Sjapi");
         
         $listpaycost = $sjapi->where("xz=1")->select();

         $this->assign("UserName",$UserName);
         $this->assign("UserID",$UserID);
         $this->assign("tongdao",$tongdao);
         $this->assign("listpaycost",$listpaycost);
         return $this->fetch();;
     }
      public function czfledits(){   //修改冲值费率
            $Paycost = db("User");
			if(is_array($_POST['tongdao'])){
			foreach ($_POST['tongdao'] as $k=>$v){
			$td.=$v."|";
			}}
            $data["tongdao"] = $td;
            $Paycost->where("id=".$this->_post("UserID"))->save($data);
            
          $this->assign("msgTitle","");
          $this->assign("message","修改成功！");
          $this->assign("waitSecond",3);
          $this->assign("jumpUrl","/SjtAdminSjt_ShangHu_Sxfs_UserID_".$this->_post("UserID").".html");
             return $this->fetch("success");
        }
      public function czfledit(){   //修改冲值费率
            
            $Paycost = db("Paycost");
            
            $data["thykt"] = $this->_post("thykt");
            $data["wy"] = $this->_post("wy");
            $data["wmykt"] = $this->_post("wmykt");
            $data["wyykt"] = $this->_post("wyykt");
            $data["ltczk"] = $this->_post("ltczk");
            $data["jyykt"] = $this->_post("jyykt");
            $data["qqczk"] = $this->_post("qqczk");
            $data["shykt"] = $this->_post("shykt");
            $data["ztyxk"] = $this->_post("ztyxk");
            $data["jwykt"] = $this->_post("jwykt");
            $data["sdykt"] = $this->_post("sdykt");
            $data["qgszx"] = $this->_post("qgszx");
            $data["txykt"] = $this->_post("txykt");
            $data["dxczk"] = $this->_post("dxczk");
            $data["gyykt"] = $this->_post("gyykt");
            $data["zyykt"] = $this->_post("zyykt");
            $data["yddx"] = $this->_post("yddx");
            $data["ltdx"] = $this->_post("ltdx");
            $data["dxdx"] = $this->_post("dxdx");
            $data["nbzz"] = $this->_post("nbzz");
            
            $Paycost->where("id=".$this->_post("id"))->save($data);
            
          $this->assign("msgTitle","");
          $this->assign("message","修改成功！");
          $this->assign("waitSecond",3);
          $this->assign("jumpUrl","/SjtAdminSjt_ShangHu_Sxf_UserID_".$this->_post("UserID").".html");
             return $this->fetch("success");
        }
        
        
        public function xgje(){
              
         $UserID = input("UserID");
         
         $User = db("User");
         
         $UserName = $User->where("id=".$UserID)->value("UserName");
         
         $dboney = db("dboney");
         
         $Userdboney = $dboney->where("UserID=".$UserID)->value("money");
         
         $Paycost = db("Paycost");
         
         $listpaycost = $Paycost->where("UserID=".$UserID)->select();
         
         if(!$listpaycost){
             
             $data["UserID"] = $UserID;
             
             $Paycost->add($data);
             
             $listpaycost = $Paycost->where("UserID=".$UserID)->select();
         }
         
         $this->assign("UserName",$UserName);
         $this->assign("listpaycost",$listpaycost);
         $this->assign("dboney",$Userdboney);
         return $this->fetch();;
        }
        
        
        public function xgjejj(){
            
            $jj = $this->_post("jj");
            
            $moneymoney = $this->_post("money");
            
            $content = $this->_post("content");
            
            $lr = $this->_post("lr");
            
            $dboney = db("dboney");
            
            $Adminmoney = db("Adminmoney");
            
            $data["UserID"] = $this->_post("UserID");
            $data["jj"] = $jj;
            $data["money"] = $moneymoney;
            $data["content"] = $content;
            $data["datetime"] = date("Y-m-d");
            $data["lr"] = $lr;
            
            $Adminmoney_id = $Adminmoney->add($data);
            
            if(!$Adminmoney_id){
                
               $this->assign("msgTitle","");
               $this->assign("message","修改失败，请稍后重试！");
               $this->assign("waitSecond",3);
               $this->assign("jumpUrl","/SjtAdminSjt_ShangHu_xgje_UserID_".$this->_post("UserID").".html");
                  return $this->fetch("success");
            }else{
                
               $ymoney = $dboney->where("UserID=".$this->_post("UserID"))->value("money");
               
               //$data["money"] = floatval($ymoney) +　floatval($moneymoney) * intval($jj); 
               
               $data["dboney"] = $moneymoney * $jj + $ymoney;
               
               if($dboney->where("UserID=".$this->_post("UserID"))->save($data)){
                   
                   $data["zt"] = 1;
                   
                   //$Adminmoney->where("UserID = ".$this->_post("UserID"))->save($data);
                    $Adminmoney->where("id = ".$Adminmoney_id)->save($data);
                    
                   ///////////////////////////////////////////////////////////
                   $dboneydb = db("dboneybd");
                   $data["UserID"] = $this->_post("UserID");
                   $data["money"] = $moneymoney * $jj;  //变动金额
                   $data["ymoney"] = $ymoney;    //原金额
                   $data["gmoney"] = $moneymoney * $jj + $ymoney;    //变动后金额
                   $data["datetime"] = date("Y-m-d H:i:s");
                   if($jj > 0){
                      $data["lx"] = 6; 
                   }else{
                      $data["lx"] = 5;  
                   }
                   $dboneydb->add($data);
                   //////////////////////////////////////////////////////////
                   
                   $this->assign("msgTitle","");
                   $this->assign("message","商户金额修改成功！");
                   $this->assign("waitSecond",3);
                   $this->assign("jumpUrl","/SjtAdminSjt_ShangHu_xgje_UserID_".$this->_post("UserID").".html");
                      return $this->fetch("success");
               }else{
                   $this->assign("msgTitle","");
               $this->assign("message","修改失败，请稍后重试!！");
               $this->assign("waitSecond",3);
               $this->assign("jumpUrl","/SjtAdminSjt_ShangHu_xgje_UserID_".$this->_post("UserID").".html");
                  return $this->fetch("success");
               }
                
            }
            
            
        }
        
        
        public function tkyh(){
            
            $UserID = input("UserID");
            
            $User = db("User");
         
            $UserName = $User->where("id=".$UserID)->value("UserName");
            
            $Bank = db("Bank");
            
            $list = $Bank->where("UserID=".$UserID)->select();
            
            $this->assign("list",$list);
            $this->assign("UserName",$UserName);
            
            return $this->fetch();;
        }
        
        
        public function tkyhedit(){
            
            $id = input("id");
            
            $UserID = input("UserID");
            
            $User = db("User");
         
            $UserName = $User->where("id=".$UserID)->value("UserName");
            
            $Bank = db("Bank");
            
            $list = $Bank->where("id=".$id)->select();
            
            $this->assign("list",$list);
            
            $this->assign("UserName",$UserName);
            
            return $this->fetch();;
            
        }
        
        public function tkyheditedit(){
            
             $Bank = db("Bank");
             
             $Bank->create();
             
             $Bank->save();
             
              $this->assign("msgTitle","");
              $this->assign("message","提款银行修改成功！");
              $this->assign("waitSecond",3);
              $this->assign("jumpUrl","/SjtAdminSjt_ShangHu_tkyh_UserID_".input("UserID").".html");
                 return $this->fetch("success");
             
            
        }
        
        public function Diaodan(){
            
            $UserID = input("UserID");
            
            $System = db("System");
            
            $list = $System->where("UserID=".$UserID)->select();
            
            if(!$list){
                
                $data["UserID"] = $UserID;
                
                if($System->add($data)){
                    $list = $System->where("UserID=".$UserID)->select();
                }
                
            }
            
            $this->assign("list",$list);
            
            return $this->fetch();;
            
        }
        
        public function Diaodanedit(){
            
            $UserID = $this->_post("UserID");
            
            $id = $this->_post("id");
            
            $System = db("System");
            
            $data["Diaodan_OnOff"] = $this->_post("Diaodan_OnOff");
            
            $data["Diaodan_Kdate"] = $this->_post("Diaodan_Kdate");
            
            $data["Diaodan_Sdate"] = $this->_post("Diaodan_Sdate");
            
            $data["Diaodan_Kmoney"] = $this->_post("Diaodan_Kmoney");
            
            $data["Diaodan_Smoney"] = $this->_post("Diaodan_Smoney");
            
            $data["Diaodan_Pinlv"] = $this->_post("Diaodan_Pinlv");
            
            $data["Diaodan_Type"] = $this->_post("Diaodan_Type");
            
            $data["Diaodan_huifu"] = $this->_post("Diaodan_huifu");
            
            $data["Diaodan_User_OnOff"] = $this->_post("Diaodan_User_OnOff");
            
            $System->where("id=".$id)->save($data);
            
            
            $this->assign("msgTitle","");
            $this->assign("message","修改成功！");
            $this->assign("waitSecond",3);
            $this->assign("jumpUrl","/SjtAdminSjt_ShangHu_Diaodan_UserID_".$UserID.".html");
               return $this->fetch("success");
        }
        
        
         public function shjkshtg(){  //审核通过
           $Userapiinformation = D("Userapiinformation");
           $WebsiteUrl = $Userapiinformation->where("UserID=".$this->_post("UserID"))->value("WebsiteUrl");
           $User = db("User");
           $UserName = $User->where("id = ".$this->_post("UserID"))->value("UserName");
           $data["Zt"] = 2;
           $data["Key"] = md5($UserName.$WebsiteUrl);
           $list = $Userapiinformation->where("UserID=".$this->_post("UserID"))->save($data);
        if($list){
          
            echo "ok";
        }else{
          
           echo "no";
        }
    }
    
    public function dhsh(){  //打回审核
           $Userapiinformation = D("Userapiinformation");
           $WebsiteUrl = $Userapiinformation->where("UserID=".$this->_post("UserID"))->value("WebsiteUrl");
           $User = db("User");
           $UserName = $User->where("id = ".$this->_post("UserID"))->value("UserName");
           $data["Zt"] = 0;
           //$data["Key"] = md5($UserName.$WebsiteUrl);
           $list = $Userapiinformation->where("UserID=".$this->_post("UserID"))->save($data);
        if($list){
          
            echo "ok";
        }else{
          
           echo "no";
        }
    }
    
    public function jiechumbk(){
        
        $UserIDList = $this->_post("UserIDList");
        
        $User = db("User");
        
        $data["mbk"] = 0;
        
        $User->where("id in (".$UserIDList.")")->save($data);
        
        echo "ok";
    }
    
    
    public function zjbdjl(){   //资金变动记录
    
          $Moneybd = db("Moneybd");
          
          $wherestr = "1=1";
          
        $sq_date = input("sq_date");
        $sq_date_js = input("sq_date_js");
        $shbh = input("shbh");
        $lx = input("lx");
        $pagepage = input("pagepage");
        
        if($pagepage == "" || $pagepage == NULL){
            $pagepage = 10;
        }
        
         if($sq_date != "" && $sq_date != NULL){
            $wherestr = $wherestr." and DATEDIFF('".$sq_date."',datetime) <= 0";
        }
        
        if($sq_date_js != "" && $sq_date_js != NULL){
            $wherestr = $wherestr." and DATEDIFF('".$sq_date_js."',datetime) >= 0"; 
        }
        
        
        if($shbh != "" && $shbh != NULL){
            $wherestr = $wherestr." and UserID = '".($shbh-10000)."'";
        }
        
        if($lx != "" && $lx != NULL){
            
            $wherestr = $wherestr." and lx = ".$lx;
              
        }
          
           
          $count = $Moneybd->where($wherestr)->count();    //计算总数 
        
          // $list = $Listuser->where($wherestr)-> order('Zt desc,Shh desc')->paginate(10);  
	 
		
          $list = $Moneybd->where($wherestr) ->order('datetime desc')->paginate($pagepage); 
        
      
          
          $hjje = $Moneybd->where($wherestr)->sum("money");   
          
          $this->assign("page",$list->render());
          $this->assign("list",$list);
          $this->assign("shbh",$shbh);
          $this->assign("hjje",$hjje);
          
          return $this->fetch();;
    }
    
    public function tksz(){  //个人提款设置
        
        $UserID = input("UserID");
        
        $Tkconfig = db("Tkconfig");
          
          $list = $Tkconfig->where("UserID=".$UserID)->select();
          
          if($list == null){
              $data["UserID"] = $UserID;
              $Tkconfig->add($data);
              $list = $Tkconfig->where("UserID=".$UserID)->limit(1)->select(); 
          }
              
          $this->assign("list",$list);
          $this->assign("UserID",$UserID);
          return $this->fetch();;
    }
    
    public function tkszedit(){   //修改个人提款设置
           $Tkconfig = db("Tkconfig");
           $data["minmoney"] = $this->_post("minmoney");
           $data["maxmoney"] = $this->_post("maxmoney");
           $data["mtsxmoney"] = $this->_post("mtsxmoney");
           $data["mttkcs"] = $this->_post("mttkcs");
           $data["wtyh"] = $this->_post("wtyh");
           $data["sz"] = $this->_post("sz");
           $data["tksz"] = $this->_post("tksz");
           $data["wttksz"] = $this->_post("wttksz");
           $UserID = $this->_post("UserID");
           
           $Tkconfig->where("UserID = ".$UserID)->save($data);
           
           echo "ok";
           
    }
    
    public function dluser(){
    	$userid = input("userid");
    	$User = db("User");
    	$UserName = $User->where("id=".$userid)->value("UserName");
    	$UserType = $User->where("id=".$userid)->value("UserType");
    	session("UserName",$UserName);
    	session("UserType",$UserType);
    	session("UserID",$userid);
    	header("Location: ".U("/User"));
    	exit;
    }
                         
  }
?>
