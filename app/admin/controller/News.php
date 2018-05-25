<?php
namespace app\admin\controller;
 
  class News  extends Sjtadminsjt{
      
    
      
      public function add(){
          
         return $this->fetch();
          
      }
      
      
      public function addnews(){
          
          $type =input("type");
          
          $title = input("title");
          
          $content = input("content");
          
          $zt = input("zt");
          
          if($zt == "" || $zt == NULL){
              $zt = 0;
          }
          
          $Newlist = db("Newlist");
          
          $data["title"] = $title;
          $data["content"] = $content;
          $data["type"] = $type;
          $data["zt"] = $zt;
          $data["datetime"] = date("Y-m-d H:i:s");
          
          $Newlist->add($data);
          
           $this->assign("msgTitle","");
         
           $this->assign("waitSecond",3);
           $this->assign("jumpUrl","/admin/News/add/type_".$type.".html");
           $this->success(添加成功);          
      }
      
      public function newslist(){
          
          $type = input("type");
          
          $title = input("title");
          
          $zt = input("zt");
          
          $wherestr = "type = ".$type;
          
          if($title != "" && $title != NULL){
              $wherestr = $wherestr." and title like '%".$title."%' ";
          }
          
          if($zt != "" && $zt != NULL){
              $wherestr = $wherestr." and zt = ".$zt;
          }
          
          $Newlist = db("Newlist");
         
          $count = $Newlist->where($wherestr)->count();    //计算总数 
        
          
          $list = $Newlist->where($wherestr)->order('datetime desc')->paginate(10);  
     
          $this->assign("page", $list->render()); 
          $this->assign("list",$list);
         return  $this->fetch();
          
      }
      
      
      public function delnews(){
          
          $idstr = input("idstr");
          
          $Newlist = db("Newlist");
          
          $Newlist->where("id in (".$idstr.")")->delete();
          
          exit("ok");
          
      }
      
      
      public function pingbinews(){
          
          $idstr = input("idstr");
          
          $Newlist = db("Newlist");
          
          $data["zt"] = 1;
          
          $Newlist->where("id in (".$idstr.")")->save($data);
          
          exit("ok");
          
      }
      
      public function huifunews(){
        
         $idstr = input("idstr");
          
          $Newlist = db("Newlist");
          
          $data["zt"] = 0;
          
          $Newlist->where("id in (".$idstr.")")->save($data);
          
          exit("ok");
          
      }
      
      public function editnew(){
          
          $id = input("id");
          
          $type = input("type");
          
          $Newlist = db("Newlist");
          
          $title = $Newlist->where("id=".$id)->value("title");
          
          $content = $Newlist->where("id=".$id)->value("content");
          
          $zt = $Newlist->where("id=".$id)->value("zt");
          
          $this->assign("title",$title);
          $this->assign("content",$content);
          $this->assign("id",$id);
          $this->assign("zt",$zt);
          $this->assign("type",$type);
         return $this->fetch();
          
      }
      
      public function editeditnews(){
          
          $type = input("type");
          
          $id = input("id");
          
          $title = input("title");
          
          $content = input("content");
          
          $zt = input("zt");
          
          if($zt == "" || $zt == NULL){
              $zt = 0;
          }
          
          $Newlist = db("Newlist");
          
          $data["title"] = $title;
          $data["content"] = $content;
          $data["datetime"] = date("Y-m-d H:i:s");
          $data["zt"] = $zt;
          
          $Newlist->where("id=".$id)->save($data);
          
          $this->assign("msgTitle","");
          
           $this->assign("waitSecond",3);
           $this->assign("jumpUrl","/admin/News/newslist/type/".$type.".html");
           $this->success("修改成功");          
          
      }
      
  }
?>
