<?php
session_start();
if(!$_SESSION['user'])
{
header('location:index.php');
}
else
{

include("config.php");
$dt=date('Y-m-d H:i:s');
$errors='0';

$recon_chrg=round($_POST['recon_chrg'],2);
$discon_chrg=round($_POST['discon_chrg'],2);
$sd=round($_POST['sd'],2);
$after_duedt_chrg=round($_POST['after_duedt_chrg'],2);
$pdt=str_replace('/','-',$_POST['paiddt']);

mysqli_query($con,"BEGIN");
$str="INSERT INTO `ebillfundreqhistory` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `cust_id`, `reqby`, `trackerid`, `reqstatus`, `approvedamt`, `chqno`, `entrydate`, `memo`, `print`, `pstat`, `extrachrg`, `priority`, `updatetime`,`arrearstatus`,`bill_from`,`type`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) select `req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `cust_id`, '".$_SESSION['user']."', `trackerid`, `reqstatus`, `approvedamt`, `chqno`, '".$dt."', `memo`, `print`, `pstat`, `extrachrg`, `priority`, `updatetime`,`arrearstatus`,`billfrom`,`type`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg` from ebillfundrequests where req_no='".$_POST['reqno']."'";
$qry1=mysqli_query($con,$str);
if(!$qry1)
{
$errors++;
echo $str;
echo mysqli_error();
}
$str2="UPDATE `ebillfundrequests` SET `bill_date`=STR_TO_DATE('".$_POST['billdt']."','%d/%m/%Y'),`billfrom`=STR_TO_DATE('".$_POST['billfrmdt']."','%d/%m/%Y'),`unit`='".$_POST['unit']."',`start_date`=STR_TO_DATE('".$_POST['stdt']."','%d/%m/%Y'),`end_date`=STR_TO_DATE('".$_POST['enddt']."','%d/%m/%Y'),`due_date`=STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'),`opening_reading`='".$_POST['openread']."',`closing_reading`='".$_POST['closeread']."',`pstat`='1',`extrachrg`='".$_POST['xtrachrg']."',`recon_chrg`='".$recon_chrg."',`discon_chrg`='".$discon_chrg."',`sd`='".$sd."',`after_duedt_chrg`='".$after_duedt_chrg."',bill_amt='".$_POST['bamt']."',afdt_amt='".$_POST['adtamt']."',trans_id='".$_POST['trsid']."',print='y'";
if(isset($_REQUEST['extrachrg_stat']))
$str2.=",extrachrg_stat=1";
else
$str2.=",extrachrg_stat=0";
if(isset($_REQUEST['recon_chrg_stat']))
$str2.=",recon_chrg_stat=1";
else
$str2.=",recon_chrg_stat=0";
if(isset($_REQUEST['discon_chrg_stat']))
$str2.=",discon_chrg_stat=1";
else
$str2.=",discon_chrg_stat=0";
if(isset($_REQUEST['sd_stat']))
$str2.=",sd_stat=1";
else
$str2.=",sd_stat=0";
if(isset($_REQUEST['after_duedt_chrg_stat']))
$str2.=",after_duedt_chrg_stat=1";
else
$str2.=",after_duedt_chrg_stat=0";
$str2.=" WHERE req_no='".$_POST['reqno']."'";
//echo $str2;
$qry=mysqli_query($con,$str2);
if(!$qry)
{
$errors++;
echo $str2;
echo mysqli_error();
}


$nwgqr=mysqli_query($con,"select * from ebillfundrequests where req_no='".$_POST['reqno']."'");
$nwfrws=mysqli_fetch_array($nwgqr);



$sitenw=mysqli_query($con,"select bank,projectid from ".$nwfrws[12]."_sites where trackerid='".$nwfrws[14]."'");
$siteron=mysqli_fetch_row($sitenw);

$invd='';
$totcnt='0';
if($nwfrws[12]=='Tata05')
{
$totcnt='10';
}
elseif($nwfrws[12]=='AGS01')
{
$totcnt='100';
}
elseif($nwfrws[12]=='HITACHI07')
{
$totcnt='15';
}
elseif($nwfrws[12]=='DIE002')
{
$totcnt='200';
}
elseif($nwfrws[12]=='FIS03')
{
$totcnt='100';
}
else
{
$totcnt='20';
}

if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }
$sql5ss="";
if($nwfrws[12]=='AGS01')
{

if($siteron[1]=='PSU')
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$nwfrws[12]."' and projectid='".$siteron[1]."'  and createdby='".$_SESSION['user']."' and open='0'";

}
else
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$nwfrws[12]."'  and projectid='".$siteron[1]."' and bank='".$siteron[0]."' and createdby='".$_SESSION['user']."' and open='0'";

}


}
elseif($nwfrws[12]=='FIS03')
{
$sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$nwfrws[12]."'  and projectid='".$siteron[1]."' and createdby='".$_SESSION['user']."' and open='0'";
}
else
{
$sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$nwfrws[12]."' and bank='".$siteron[0]."' and projectid='".$siteron[1]."' and createdby='".$_SESSION['user']."' and open='0'";
}
//echo $sql5ss;
$res5s = mysqli_query($con,$sql5ss);
$row5 = mysqli_fetch_row($res5s);

$totinvcnt="";
$sndid="";
$invsno="";
//echo "sid=".$row5[0]."<br>";
if($row5[0]!=NULL)
{
//echo "select send_id,invoice_no from send_bill where inv_no='".$row5[0]."' and fiscalyr like '$invd'";
$getsndid=mysqli_query($con,"select send_id,invoice_no from send_bill where inv_no='".$row5[0]."' and fiscalyr like '$invd'");
$sdnidrow=mysqli_fetch_array($getsndid);

$invsno=$sdnidrow[1];
$sndid=$sdnidrow[0];
//echo $sndid."<br>";
$getcnt=mysqli_query($con,"select detail_id from send_bill_detail where send_id='".$sdnidrow[0]."'");


$totinvcnt=mysqli_num_rows($getcnt);
}


$s2new="select * from ebillcharges where Cid='".$nwfrws[12]."'";

if($nwfrws[12]!='AGS01')
{
  if(($nwfrws[12]!='EUR08' && $nwfrws[12]!='EPS' && $nwfrws[12]!='Tata05') && ($siteron[1]=='MOF' || $siteron[1]=='Mphasis')){
$s2new.=" and type='".$siteron[1]."'";


}
elseif($nwfrws[12]=='EUR08')
$s2new.=" and type='".$_POST['paid']."'";
elseif($nwfrws[12]=='Tata05')
{
if($siteron[1]!='MOF')
$s2new.=" and tp='".$_POST['tata']."'";
else
$s2new.=" and type='".$siteron[1]."'";

}
else
$s2new.=" and type=''";
}
//echo $s2;

$slnew=mysqli_query($con,$s2new);

$rsnew=mysqli_fetch_row($slnew);



$seramt=$rsnew[2];    

$to=$rsnew[2];
$svt=$to*0.14;
$svt1=$to*0.005;
$svt2=$to*0.005;
$gtotal=$svt+$svt1+$svt2+$to;

$totamtsnd=$nwfrws[4];
$currentdate=date('Y-m-d');
$month=date('F',strtotime($nwfrws[7]));

if($row5[0]==NULL || $totinvcnt>=$totcnt)
{

$genmaxinv = "select max(inv_no) from send_bill";
//echo genmaxinv."<br>";
$geninv= mysqli_query($con,$genmaxinv);
$prginv= mysqli_fetch_row($geninv);

$newinvoice_no=$prginv[0]+1;

$invd="";

$cm="";
$new = $newinvoice_no;
		//echo $new;
		if($newinvoice_no<=9)
		$newinvoice_no ="000".$newinvoice_no ;
		if($new>9 && $new <=99)
		$newinvoice_no = "00".$newinvoice_no ;
		if($new>99 && $new <=999)
		$newinvoice_no = "0".$newinvoice_no ;
		/*if($new>999 && $new <=9999)
		$newinvoice_no = "0".$newinvoice_no ;
		if($new>9999 && $new <=99999)
		$newinvoice_no="0".$newinvoice_no ;*/
		//echo $newinvoice_no;

$invtype='A';
	$finalinvoice='';
	$final='';
	$invdate='';

if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); }
if($nwfrws[12]=='Tata05')
		{
		if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); }
		
 
		$final.=$cm="CSSEB";
	
    $final.= $newinvoice_no;
    $finalinvoice=$final."/A".$invdate;
     }
    else
    {
    if(date('m')>='4'){ $invdate=date('Y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('Y',strtotime('-1 year'))."-".date('y'); }
		
     
		$final.=$cm="CSS/EB/";
	
    $final.= $newinvoice_no;
    $finalinvoice=$final."/A/".$invdate;
    
    }

$finalinvoice2= $finalinvoice;


if($nwfrws[12]=='Tata05')
		{
   
    $finalinvoice=$final."B".$invdate;
    }
    else
    {
     
    $finalinvoice=$final."/B/".$invdate;
     
    }
$finalinvoice3= $finalinvoice;
if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); 
//echo $invd; 
}else
{ $invd=date('y',strtotime('-1 year'))."-".date('y');//echo $invd; 
 } 

$res4=mysqli_query($con,"insert into send_bill(customer_name,bank,date,invoice_no,comp,projectid,createdby,entrydt,fiscalyr,amount,inv_no,servchrg,invoice2) values('".$nwfrws[12]."','".$siteron[0]."','".$currentdate."','".$finalinvoice2."','1','".$siteron[1]."','".$_SESSION['user']."','".date('Y-m-d H:i:s')."','".$invd."','".$_POST['paidamt']."','".$newinvoice_no."','".$gtotal."','".$finalinvoice3."')");


if(!$res4)
{
$errors++;
echo "insert into send_bill(customer_name,bank,date,invoice_no,comp,projectid,createdby,entrydt,fiscalyr,amount,inv_no,servchrg,invoice2) values('".$nwfrws[12]."','".$siteron[0]."','".$currentdate."','".$finalinvoice2."','1','".$siteron[1]."','".$_SESSION['user']."','".date('Y-m-d H:i:s')."','".$invd."','".$_POST['paidamt']."','".$newinvoice_no."','".$gtotal."','".$finalinvoice3."')";
echo mysqli_error();
}
$sql5new = "select max(send_id) from send_bill";
$res5qr = mysqli_query($con,$sql5new );
$sdiddet= mysqli_fetch_row($res5qr );
$sndid=$sdiddet[0];
$invsno=$finalinvoice;

$nsqlnew = "select * from ".$nwfrws[12]."_ebill where atmtrackid='".$nwfrws[14]."'";// echo $nsql;
				
                $resultnw = mysqli_query($con,$nsqlnew);
             
		$rownws = mysqli_fetch_row($resultnw);

 $resnw=mysqli_query($con,"select atmsite_address,site_id,bank,projectid from ".$nwfrws[12]."_sites where trackerid='".$nwfrws[14]."'");
                $rowsatmadd=mysqli_fetch_row($resnw); 
                $location=mysqli_real_escape_string($rowsatmadd[0]);


$sndbdetins2=mysqli_query($con,"insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid,fiscalyr, `extrachrg`, `recon_chrg`, `discon_chrg`, `sd`, `after_duedt_chrg`,srvchrg,updtby) values
('".$sndid."','".$nwfrws[14]."','".$rownws[2]."','".$location."','".$rownws[1]."','".$nwfrws[2]."','".$nwfrws[9]."','".$nwfrws[3]."','".$nwfrws[6]."', '".$nwfrws[7]."','".$month."','".$_POST['paidamt']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$nwfrws[0]."','".$invd."','".$nwfrws[22]."','".$nwfrws[29]."','".$nwfrws[30]."','".$nwfrws[31]."','".$nwfrws[32]."','".$seramt."','".$_SESSION['user']."')");

if(!$sndbdetins2)
{
$errors++;

echo "insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid,fiscalyr, `extrachrg`, `recon_chrg`, `discon_chrg`, `sd`, `after_duedt_chrg`,srvchrg,updtby) values
('".$sndid."','".$nwfrws[12]."','".$rownws[2]."','".$location."','".$rownws[1]."','".$nwfrws[2]."','".$nwfrws[9]."','".$nwfrws[3]."','".$nwfrws[6]."', '".$nwfrws[7]."','".$month."','".$_POST['paidamt']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$nwfrws[0]."','".$invd."','".$nwfrws[22]."','".$nwfrws[29]."','".$nwfrws[30]."','".$nwfrws[31]."','".$nwfrws[32]."','".$seramt."','".$_SESSION['user']."')";

echo mysqli_error();
}
}
else
{

$nsqlnew = "select * from ".$nwfrws[12]."_ebill where atmtrackid='".$nwfrws[14]."'";// echo $nsql;
				
                $resultnw = mysqli_query($con,$nsqlnew);
             
		$rownws = mysqli_fetch_row($resultnw);

 $resnw=mysqli_query($con,"select atmsite_address,site_id,bank,projectid from ".$nwfrws[12]."_sites where trackerid='".$nwfrws[14]."'");
                $rowsatmadd=mysqli_fetch_row($resnw); 
                $location=mysqli_real_escape_string($rowsatmadd[0]);

$gupdet=mysqli_query($con,"select amount,servchrg from send_bill where send_id='".$sndid."'");
$gupdetrws=mysqli_fetch_array($gupdet);

$prevamt=$gupdetrws[0];
$prevserv=$gupdetrws[1];


$nwamt=$prevamt+$_POST['paidamt'];

$nwseramt=$prevserv+$gtotal;

$updqry20=mysqli_query($con,"update send_bill set amount='".$nwamt."',servchrg='".$nwseramt."' where send_id='".$sndid."' ");
if(!$updqry20)
{
$errors++;
echo "update send_bill set amount='".$nwamt."',servchrg='".$nwseramt."' where send_id='".$sndid."' ";
echo mysqli_error();
}

$sndbdetins=mysqli_query($con,"insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid,fiscalyr, `extrachrg`, `recon_chrg`, `discon_chrg`, `sd`, `after_duedt_chrg`,srvchrg,updtby) values
('".$sndid."','".$nwfrws[14]."','".$rownws[2]."','".$location."','".$rownws[1]."','".$nwfrws[2]."','".$nwfrws[9]."','".$nwfrws[3]."','".$nwfrws[6]."', '".$nwfrws[7]."','".$month."','".$_POST['paidamt']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$nwfrws[0]."','".$invd."','".$nwfrws[22]."','".$nwfrws[29]."','".$nwfrws[30]."','".$nwfrws[31]."','".$nwfrws[32]."','".$seramt."','".$_SESSION['user']."')");

if(!$sndbdetins)
{
$errors++;
echo "insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid,fiscalyr, `extrachrg`, `recon_chrg`, `discon_chrg`, `sd`, `after_duedt_chrg`,srvchrg,updtby) values
('".$sndid."','".$nwfrws[12]."','".$rownws[2]."','".$location."','".$rownws[1]."','".$nwfrws[2]."','".$nwfrws[9]."','".$nwfrws[3]."','".$nwfrws[6]."', '".$nwfrws[7]."','".$month."','".$nwfrws[4]."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$nwfrws[0]."','".$invd."','".$nwfrws[22]."','".$nwfrws[29]."','".$nwfrws[30]."','".$nwfrws[31]."','".$nwfrws[32]."','".$seramt."','".$_SESSION['user']."')";
echo mysqli_error();
}
$chktotb=mysqli_query($con,"select detail_id from send_bill_detail where send_id='".$sndid."'");
$fchkb=mysqli_num_rows($chktotb);


if($fchkb==$totcnt)
{
$fclqry=mysqli_query($con,"update send_bill set open='1',date='".date('Y-m-d')."',entrydt='".date('Y-m-d H:i:s')."' where send_id='".$sndid."'");
if(!$fclqry)
{
$errors++;

echo "update send_bill set open='1' where send_id='".$sndid."'";
echo mysqli_error();
}
}
}

if($qry)
{
if(isset($_POST['fundid']))
{
for($i=0;$i<count($_POST['fundid']);$i++)
{
$ins="INSERT INTO `ebillfundcancinv` (`id`, `reqid`, `entrydt`, `updtby`, `status`) VALUES (NULL, '".$_POST['fundid'][$i]."', '".$dt."', '".$_SESSION['user']."', '0')";
$insqry=mysqli_query($con,$ins);
if(!$insqry)
{
$errors++;
echo $ins;
echo mysqli_error();
}
}
}

$memo=str_replace("'","\'",$_POST['memo']);

$pdt2=date('Y-m-d',strtotime($pdt));
$dt=date('Y-m-d H:i:s');
$se=mysqli_query($con,"select * from ebpayment where Bill_No='".$_POST['reqno']."'");
if(mysqli_num_rows($se)>0)
{
$row=mysqli_fetch_array($se);
$qry=mysqli_query($con,"INSERT INTO `ebpayment_history` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`, `incintax`,`entrydate`) VALUES ('".$row['Bill_No']."', '".$row['Paid_Amount']."', '".$row['Paid_Date']."', '".$row['memo']."', '".$row['entrydt']."', '".$row['upby']."', '".$row['status']."', '".$row['extrachrg']."', '".$row['incintax']."','$dt')");
if(!$qry)
{
$errors++;
echo "INSERT INTO `ebpayment_history` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`, `incintax`,`entrydate`) VALUES ('".$row['Bill_No']."', '".$row['Paid_Amount']."', '".$row['Paid_Date']."'', '".$row['memo']."', '".$row['entrydt']."', '".$row['upby']."', '".$row['status']."', '".$row['extrachrg']."', '".$row['incintax']."','$dt')";
echo mysqli_error();
}

$up=mysqli_query($con,"Update ebpayment set Paid_Amount='".$_POST['paidamt']."',Paid_Date='".$pdt2."',memo='".$memo."',`upby`='".$_SESSION['user']."',extrachrg='".$_POST['xtrachrg']."',status='".$_POST['paid']."',entrydt='".$dt."' where Bill_No='".$_POST['reqno']."'");

if(!$up)
{
$errors++;
echo "Update ebpayment set Paid_Amount='".$_POST['paidamt']."',Paid_Date='".$pdt2."',memo='".$memo."',`upby`='".$_SESSION['user']."',extrachrg='".$_POST['xtrachrg']."',status='".$_POST['paid']."',entrydt='".$dt."' where Bill_No='".$_POST['reqno']."'";
echo "7".mysqli_error();
}
}
else
{

$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`,`upby`,`status`,`extrachrg`) VALUES ('".$_POST['reqno']."', '".$_POST['paidamt']."','".$pdt2."', '".$memo."','".$dt."','".$_SESSION['user']."','".$_POST['paid']."','".$_POST['xtrachrg']."')");
if(!$qr)
{
$errors++;
echo "INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`,`upby`,`status`,`extrachrg`) VALUES ('".$_POST['reqno']."', '".$_POST['paidamt']."','".$pdt2."', '".$memo."','".$dt."','".$_SESSION['user']."','".$_POST['paid']."','".$_POST['xtrachrg']."')";
echo mysqli_error();
}

}
}
}
if($errors=='0')
{
mysqli_query($con,"COMMIT");
?>
<script>alert('Invoice No is-<?php echo $invsno;?>');</script>
<script>window.close();</script>
<?php }
else
{
?>
<script>alert('Error');</script>
<script>window.close();</script>
<?php



} ?>

