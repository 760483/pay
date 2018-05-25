<?php
namespace app\admin\controller; 
  
  class Tikuan extends Sjtadminsjt{
      
        
      
      public function tksz(){
          
          $Tkconfig = db("Tkconfig");
          
          $list = $Tkconfig->where("UserID=0")->select();
          
          $this->assign("list",$list);
          return $this->fetch();
          
      }
      
      public function tkszedit(){
          
          $Tkconfig = db("Tkconfig");
          
          $Tkconfig->create();
          
          $Tkconfig->where("UserID=0")->save();
          
          $this->assign("msgTitle","");
       
          $this->assign("waitSecond",3);
          $this->assign("jumpUrl","/admin/Tikuan/tksz.html");
          $this->success("提款设置修改成功！");
          
      }
      
      public function tkjl(){
          
          $T = input("T");
          
          $sq_date = input("sq_date");
          
          $sq_date_js = input("sq_date_js");
          
          $zt = input("zt");
          
          $pagepage = input("pagepage");
          
          if($pagepage == "" || $pagepage == NULL){
              $pagepage = 10;
          }
                                  
          $wherestr = "T=".$T." and wt = 0";   
          
          if($sq_date != "" && $sq_date != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date."',sq_date) <= 0";
          }
          
           if($sq_date_js != "" && $sq_date_js != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date_js."',sq_date) >= 0";
          }
          
          if($zt != "" && $zt != NULL){
              $wherestr = $wherestr." and ZT = ".$zt;
          }                 
                                  
          $Tklist = db("Tklist");
          
          $count = $Tklist->where($wherestr)->count();    //计算总数 
       
          
          $list = $Tklist->where($wherestr)-> order('sq_date desc')->paginate(10); 
        
          
          $this->assign("page", $list->render()); 
          $this->assign("list",$list);
          return $this->fetch();
      }
      
      public function wttkjl(){
          
          $T = input("T");
          
          $sq_date = input("sq_date");
          
           $sq_date_js = input("sq_date_js");
          
          $zt = input("zt");
          
          $pagepage = input("pagepage");
          
          if($pagepage == "" || $pagepage == NULL){
              $pagepage = 10;
          }
                                  
          $wherestr = "T=".$T;   
          
           if($sq_date != "" && $sq_date != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date."',sq_date) <= 0";
          }
          
           if($sq_date_js != "" && $sq_date_js != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date_js."',sq_date) >= 0";
          }
          
          if($zt != "" && $zt != NULL){
              $wherestr = $wherestr." and ZT = ".$zt;
          }                 
                                  
          $Wttklist  = db("Wttklist");
          
          $count = $Wttklist->where($wherestr)->count();    //计算总数 
         
          $list = $Wttklist->where($wherestr) ->order('sq_date desc')->paginate(10); 
        
         
          $this->assign("page", $list->render()); 
          $this->assign("list",$list);
          return $this->fetch();
          
      }
      
      public function ExportExcel_bak(){   //备用
          vendor('PHPExcel175.PHPExcel');
          $objPHPExcel = new PHPExcel();
           $objPHPExcel->getProperties()->setCreator("Da")
                                        ->setLastModifiedBy("Da")
                                       ->setTitle("Office 2007 XLSX Test Document")
                                       ->setSubject("Office 2007 XLSX Test Document")
->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
      ->setKeywords("office 2007 openxml php")
      ->setCategory("Test result file");
      $objPHPExcel->setActiveSheetIndex(0);                                                         
      $titlename = date('Ymd',time());
      $objPHPExcel->getActiveSheet(0)->setTitle($titlename.'提款账单(T+'.input("T").')');
      
       //设置宽度  默认大小  字体
  
  $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
  $objPHPExcel->getActiveSheet()->getRowDimension()->setRowHeight(20);
  $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
  $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(15);
 // $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setBold(true);
  $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
  $objPHPExcel->getActiveSheet()->getStyle("B1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("C1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("D1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("F1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
                  
  $objPHPExcel->getActiveSheet(0)->setCellValue('A1','银行名称');
  $objPHPExcel->getActiveSheet(0)->setCellValue('B1','分行名称');
  $objPHPExcel->getActiveSheet(0)->setCellValue('C1','银行卡号');
  $objPHPExcel->getActiveSheet(0)->setCellValue('D1','开户姓名');
  $objPHPExcel->getActiveSheet(0)->setCellValue('E1','金额');
  $objPHPExcel->getActiveSheet(0)->setCellValue('F1','付款时间');
                 
  spl_autoload_register(array('Think','autoload'));
  //////////////////////////////////////////////////////////////////////
  $T = input("T");
          
          $sq_date = input("sq_date");
          
          $sq_date_js = input("sq_date_js");
          
          $zt = input("zt");
          
          $pagepage = input("pagepage");
          
          if($pagepage == "" || $pagepage == NULL){
              $pagepage = 10;
          }
                                  
          $wherestr = "T=".$T;   
          
          if($sq_date != "" && $sq_date != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date."',sq_date) <= 0";
          }
          
           if($sq_date_js != "" && $sq_date_js != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date_js."',sq_date) >= 0";
          }
          
          if($zt != "" && $zt != NULL){
              $wherestr = $wherestr." and ZT = ".$zt;
          }                 
           
           if(input("wt") == 0){
               $Tklist = db("Tklist");
           }else{
               if(input("wt") == 1){
                   $Tklist = db("Wttklist");
               }
               
           }                      
           
           $listcheckbox = input("listcheckbox");
           
           if($listcheckbox != NULL && $listcheckbox != ""){
               $wherestr = "id in (0".$listcheckbox.")";
           }
           
           $list = $Tklist->where($wherestr)->order('sq_date desc')->select();
           $i = 2; 
           foreach($list as $key=>$value){
               
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A'.$i,$value["bankname"]); 
          
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B'.$i,$value["fen_bankname"]); 
           
          
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C'.$i,$value["bank_number"],PHPExcel_Cell_DataType::TYPE_STRING);  
           
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D'.$i,$value["myname"]); 
          
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E'.$i,$value["money"]);
          
           $fk_date = date("Y-m-d H:i:s");        
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F'.$i,$fk_date);
           
            //////////////////////////////////////////////////////
           $data["qr_date"] = $fk_date;
           $data["ZT"] = 2;
           $Tklist->where("id = ".$value["id"])->save($data);
           //////////////////////////////////////////////////////
           
           $i++;
           }
           
           
  /////////////////////////////////////////////////////////////////////
  
      $filename = date('YmdHis',time());
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename='.$filename."(T+".$T.").xls");
      header('Cache-Control: max-age=0');
                
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
      }

      ///////////////////////////////////////////////////////////////////////
       public function ExportExcel(){

          vendor('PHPExcel175.PHPExcel');
          $objPHPExcel = new PHPExcel();
           $objPHPExcel->getProperties()->setCreator("Da")
                                        ->setLastModifiedBy("Da")
                                       ->setTitle("Office 2007 XLSX Test Document")
                                       ->setSubject("Office 2007 XLSX Test Document")
->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
      ->setKeywords("office 2007 openxml php")
      ->setCategory("Test result file");
      $objPHPExcel->setActiveSheetIndex(0);                                                         
      $titlename = date('Ymd',time());
      $objPHPExcel->getActiveSheet(0)->setTitle($titlename.'提款账单(T+'.input("T").')');
      
       //设置宽度  默认大小  字体
  
  $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
  $objPHPExcel->getActiveSheet()->getRowDimension()->setRowHeight(20);
  $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('宋体');
  $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(11);

  
  /* $objPHPExcel->getActiveSheet(0)->setCellValue('A1','收款人姓名');
  $objPHPExcel->getActiveSheet(0)->setCellValue('B1','收款人银行账号');
  $objPHPExcel->getActiveSheet(0)->setCellValue('C1','开户行');
  $objPHPExcel->getActiveSheet(0)->setCellValue('D1','金额'); */
  
   $objPHPExcel->getActiveSheet(0)->setCellValue('A1','收款人姓名');
   $objPHPExcel->getActiveSheet(0)->setCellValue('B1','开户银行');
   $objPHPExcel->getActiveSheet(0)->setCellValue('C1','开户分行');
   $objPHPExcel->getActiveSheet(0)->setCellValue('D1','开户支行');
   $objPHPExcel->getActiveSheet(0)->setCellValue('E1','收款人银行账号');
   $objPHPExcel->getActiveSheet(0)->setCellValue('F1','金额');
   $objPHPExcel->getActiveSheet(0)->setCellValue('G1','申请提款时间');
   $objPHPExcel->getActiveSheet(0)->setCellValue('H1','商户ID');
                 
  spl_autoload_register(array('Think','autoload'));
  //////////////////////////////////////////////////////////////////////
  $T = input("T");
          
          $sq_date = input("sq_date");
          
          $sq_date_js = input("sq_date_js");
          
          $zt = input("zt");
          
          $pagepage = input("pagepage");
          
          if($pagepage == "" || $pagepage == NULL){
              $pagepage = 10;
          }
                                  
          $wherestr = "T=".$T;   
          
          if($sq_date != "" && $sq_date != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date."',sq_date) <= 0";
          }
          
           if($sq_date_js != "" && $sq_date_js != NULL){
              $wherestr = $wherestr." and DATEDIFF('".$sq_date_js."',sq_date) >= 0";
          }
          
          if($zt != "" && $zt != NULL){
              $wherestr = $wherestr." and ZT = ".$zt;
          }                 
           
           if(input("wt") == 0){
               $Tklist = db("Tklist");
           }else{
               if(input("wt") == 1){
                   $Tklist = db("Wttklist");
               }
               
           }                      
           
           $listcheckbox = input("listcheckbox");
           
           if($listcheckbox != NULL && $listcheckbox != ""){
               $wherestr = "id in (0".$listcheckbox.")";
           }
           
           $list = $Tklist->where($wherestr)->order('sq_date desc')->select();
           $i = 2; 
           foreach($list as $key=>$value){
           
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A'.$i,$value["myname"]);
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B'.$i,$value["bankname"],PHPExcel_Cell_DataType::TYPE_STRING);
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C'.$i,$value["fen_bankname"],PHPExcel_Cell_DataType::TYPE_STRING);
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D'.$i,$value["zhi_bankname"],PHPExcel_Cell_DataType::TYPE_STRING);
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E'.$i,$value["bank_number"],PHPExcel_Cell_DataType::TYPE_STRING);
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F'.$i,$value["money"],PHPExcel_Cell_DataType::TYPE_NUMERIC);
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G'.$i,$value["sq_date"],PHPExcel_Cell_DataType::TYPE_STRING);
           $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('H'.$i,($value["UserID"]+10000),PHPExcel_Cell_DataType::TYPE_STRING);
            //////////////////////////////////////////////////////
           $data["qr_date"] = date("Y-m-d H:i:s");
           $data["ZT"] = 2;
           $Tklist->where("id = ".$value["id"])->save($data);
           //////////////////////////////////////////////////////date
           
           $i++;
           }
           
           
  /////////////////////////////////////////////////////////////////////
  
      $filename = date('YmdHis',time());
      //header('Content-Type: application/vnd.ms-excel');
      //header('Content-Disposition: attachment;filename='.$filename."(T+".$T.").xls");
      //header('Cache-Control: max-age=0');          
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");
      header("Content-Disposition: attachment; filename=".$filename."(T+".$T.").xls");
      header("Content-Transfer-Encoding: binary");
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Pragma: no-cache");
      $objWriter->save('php://output');
      exit;
      }
      //////////////////////////////////////////////////////////////////////
  }
?>
