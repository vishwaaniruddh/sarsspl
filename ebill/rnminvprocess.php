<?php
session_start();
if($_SESSION['user']!="")
{
include("config.php");
$org_state=$_POST["state"];
$state=$_POST["state"];
$amtot=$_POST["fnamt"];
$qidsall=$_POST["qrrarry"];

$cid=$_POST["cid"];

$status=0;

$errors=0;

mysqli_query($con,"BEGIN");




$qids=explode(",",$qidsall);



//print_r($qids);
if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); 
//echo $invd; 
}else
{ $invd=date('y',strtotime('-1 year'))."-".date('y');//echo $invd; 
 } 
 
 
 $gstqry=mysqli_query($con,"select gst from gst_no_os where gst!='na' and state='".$state."'");

if(mysqli_num_rows($gstqry)>0)
{
    
 
    $cgst=$amtot*0.09;
    $sgst=$amtot*0.09;
    $igst=0;
   // echo "in1";
}
else
{
    
  // $state="Maharashtra";
    $cgst=0;
    $sgst=0;
    $igst=$amtot*0.18;
//    echo "in2";
}


//---------------------for state code-------------------------------------------------//
//-------------------if state doesnt exist in any table default maharshtra-------------//
  $tabname="";
           if($cid=="EUR08")
           {
               $tabname="euronet";
               
           }
           if($cid=="DIE002")
           {
               $tabname="diebold";
               
           }
           if($cid=="FIS03")
           {
               $tabname="fis";
               
           }
           if($cid=="FSS04")
           {
               $tabname="fss";
               
           }
           if($cid=="HITACHI07")
           {
               $tabname="hitachi";
               
           }
           if($cid=="AGS01")
           {
               $tabname="ags";
               
           }
           
            if($cid=="Tata05")
           {
               $tabname="tata";
               
           }
           
            if($cid=="EPS")
           {
               $tabname="eps";
               
           }
           
    $statecode="";
 /*  $gtstqr=mysqli_query($con,"select state_code from gst_no_os where gst!='na' and state='".$state."'");
    $gstrrws=mysqli_num_rows($gtstqr);
    
    if($gstrrws>0)
    {
        $frstcd=mysqli_fetch_array($gtstqr);
        $statecode=$frstcd[0];
        
    }else
    {*/
        $sttcode=mysqli_query($con,"select * from ".$tabname."_gst where State ='".$state."'");
 // echo "select * from ".$tabname."_gst where State ='".$state."'";       
$sttcodef=mysqli_fetch_array($sttcode);  
$ggs="";
if($tabname=="fss")
{
    
 $ggs=$sttcodef[3]; 
}
elseif($tabname=="eps")
{
    
 $ggs=$sttcodef[5]; 
}
elseif($tabname=="fis" || $tabname=="hitachi")
{
    
 $ggs=$sttcodef[2]; 
}
else
{
  $ggs=$sttcodef[3];
    
}
//echo $ggs;
if($ggs=="" or $ggs=="na")
{
    
$state="Maharashtra";
$sttcodemh=mysqli_query($con,"select * from ".$tabname."_gst where State= 'Maharashtra'");
$sttcodefmh=mysqli_fetch_array($sttcodemh);


if($tabname=="fss")
{
    
       $statecode=$sttcodef[2];
    
}
else
{
 
   if($tabname=="fis")
{
    $statecode=$sttcodef[4];

}else

{
$statecode=$sttcodefmh['state_Code'];
}
 
}

}else
{
    if($tabname=="fis")
{
    $statecode=$sttcodef[4];

}else

{
    
$statecode=$sttcodef['state_Code'];
    
}
}
        
        
        
  // }

    
//---------------------for state code end-------------------------------------------------//
 $finalamtwgst=$amtot+$cgst+$sgst+$igst;
 
 //echo "select max(inv_no) from rnm_invoice where fiscalyr like '$invd' and state='".$state."' and customer='".$_POST["cid"]."'";
 $gtinvno=mysqli_query($con,"select max(inv_no) from rnm_invoice where fiscalyr like '$invd' and state='".$org_state."' and customer='".$_POST["cid"]."'");
 
// echo "select max(inv_no) from rnm_invoice where fiscalyr like '$invd' and state='".$state."' and customer='".$_POST["cid"]."'";
 //echo mysqli_error();
 $gtinvnorw=mysqli_fetch_array($gtinvno);
 
 
 $invno="1";
 
 if($gtinvnorw[0]!=NULL)
 {
     $invno=$gtinvnorw[0]+1;
     
 }

$inv=$statecode."/R/".$invno."/".$invd;
//echo $invno;
 
 $insqr=mysqli_query($con,"INSERT INTO `rnm_invoice`(`customer`, `bank`, `project_id`, `date`, `amount`, `cgst`, `sgt`, `igst`, `total_amt`, `state`, `createdby`, `fiscalyr`, `inv_no`, `enttrydt`,invoice,org_state) values ('".$cid."','".$_POST["bank"]."','','".date("Y-m-d")."','".$amtot."','".$cgst."','".$sgst."','".$igst."','".$finalamtwgst."','".$state."','".$_SESSION['userid']."','".$invd."','".$invno."','".date("Y-m-d h:i:s")."','".$inv."','".$org_state."')");
 
 if(!$insqr)
 {
     echo mysqli_error();
   $errors++;  
 }
 
 
$sndid=mysqli_insert_id();
for($i=0;$i<count($qids);$i++)
{
    
   // echo "Select * from quotation1 where id='".$qids[$i]."'";
   $qdts= mysqli_query($con,"Select * from quotation1 where id='".$qids[$i]."'");
   $gdtsrwss= mysqli_fetch_array($qdts);
    
    
    
    $gapdet=mysqli_query($con,"Select * from quotation_approve_details where qid='".$gdtsrwss[0]."'");
$nurws=mysqli_num_rows($gapdet);

if($nurws>0)
{
$approw=mysqli_fetch_array($gapdet);


}
    
    
    
    
    if($gdtsrwss[2]=='ICICI' || $gdtsrwss[2]=='RATNAKAR' || $gdtsrwss[2]=='ICICI_Direct' || $gdtsrwss[2]=='Knight_Frank' || $gdtsrwss[2]=='BajajFinance' || $gdtsrwss[2]=='kotak')
{

$qdetici=mysqli_query($con,"select * from icici_quot_details where qid='".$gdtsrwss[0]."'");
 while($gdetca2=mysqli_fetch_array($qdetici))
 {
   
mysqli_query($con,"INSERT INTO `Rnm_icici_quot_details`( `qid`, `material_group`, `service_no`,material_text,gprice,qnty,unit,amt,remark) VALUES ('".$gdetca2[1]."','".$gdetca2[2]."','".$gdetca2[3]."','".$gdetca2[4]."','".$gdetca2[5]."','".$gdetca2[6]."','".$gdetca2[7]."','".$gdetca2[8]."','".$gdetca2[9]."')");

}

 } 
 else
{

  $gpart=mysqli_query($con,"select * from quotation_details where particular='".$gdetca[0]."' and qid='".$gdtsrwss[0]."'");
while($gparta=mysqli_fetch_array($gpart))
 {

mysqli_query($con,"INSERT INTO `Rnm_quotation_details`( `qid`, `particular`, `description`,quantity,rate,Total,tcode,uom,ServiceTax) VALUES ('".$gparta[1]."','".$gparta[2]."','".$gparta[3]."','".$gparta[4]."','".$gparta[5]."','".$gparta[6]."','".$gparta[7]."','".$gparta[8]."','".$gparta[9]."')");



  
$str++;
 }

  

}
    
    
    
 
    
    
    
    
    
$getdet=mysqli_query($con,"INSERT INTO `rnm_invoice_details`( `send_id`, `qid`, `entrydt`,quot_id,cust,atm,bank,project_id,location,city,state,reqby,entrydate,status,category,month,year,qno,call_status,supervisor,p_stat,local_status,billing_status,rnm_invoice_status,Archived_date,Appr_month,ApprovalDate,ApprovalAmount,ApprovedBy) VALUES ('".$sndid."','".$qids[$i]."','".date("Y-m-d")."','".$gdtsrwss[1]."','".$gdtsrwss[2]."','".$gdtsrwss[3]."','".$gdtsrwss[4]."','".$gdtsrwss[5]."','".$gdtsrwss[6]."','".$gdtsrwss[7]."','".$gdtsrwss[8]."','".$gdtsrwss[9]."','".$gdtsrwss[10]."','".$gdtsrwss[11]."','".$gdtsrwss[12]."','".$gdtsrwss[13]."','".$gdtsrwss[14]."','".$gdtsrwss[15]."','".$gdtsrwss[16]."','".$gdtsrwss[17]."','".$gdtsrwss[18]."','".$gdtsrwss[19]."','".$gdtsrwss[20]."','".$gdtsrwss[21]."','".$gdtsrwss[22]."','".date("M-Y",strtotime($approw["approved_date"]))."','".$approw["approved_date"]."','".$approw["app_amt"]."','".$approw["app_by"]."')");
    
    if(!$getdet)
    {
       $errors++;  
        
    }
    
    
}


$updtr=mysqli_query($con,"update quotation1 set rnm_invoice_status=1 where id in($qidsall)");
if(!$updtr)
{
echo mysqli_error();    
   $errors++;   
}


if($errors==0)
{
    
    mysqli_query($con,"COMMIT");
    
   // echo 1;
           echo $sndid;

}else
{
    
        mysqli_query($con,"ROLLBACK");
       echo 0;
}



}else
{
    
    
    echo "20";
}
