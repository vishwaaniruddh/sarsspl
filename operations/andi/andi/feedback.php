<?php
include("../config.php");
$alert=$_GET['alertid'];
$feed=$_GET['feed'];
$eng_id=$_GET['engid'];
$st=str_replace("'","\'",$feed);

$stand=$_GET['standby'];

$str='';
$srno=$_GET['srno'];

if($st=='' || $srno=='')
{
$str="-1";
}
else
{
$qry=mysql_query("select * from alert where alert_id='".$alert."'");
$qryro=mysql_fetch_row($qry);
if($qryro[17]=='service')
{
//echo "update amcassets set serialno='".$_POST['serial']."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''";
$qry2=mysql_query("update amcassets set serialno='".$srno."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''");
}
elseif($qryro[17]=='new')
{
//echo $qryro[2];
$at=(explode("_",$qryro[2]));
//echo "<br>".$at[0]."<br>";
if($at[0]!='temp')
{
$qry3=mysql_query("select * from atm where atm_id='".$qryro[2]."'");
$row3=mysql_fetch_row($qry3);

$qry1=mysql_query("update site_assets set serialno='".$srno."' where siteid='".$row3[0]."' and assets_name='UPS' and serialno=''");
//echo "update site_assets set serialno='".$_POST['serial']."' where siteid='".$row3[0]."' and assets_name='UPS' and serialno=''";
}
else
{
//$qry3=mysql_query("select * from tempsites where atmid='".$qryro[2]."'");
//$row3=mysql_fetch_row($qry3);
$qry1=mysql_query("update tempsites set serialno='".$srno."' where atmid='".$qryro[2]."' and serialno=''");
}
}
//echo "Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`standby`) Values('".$eng_id."','".$alert."','".$feed."','".$stand."')";
$sql=mysql_query("Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`standby`) Values('".$eng_id."','".$alert."','".$st."','".$stand."')");
//include_once('class_files/update.php');
//$up=new update();
//$tab1=$up->update_table('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert',array("status","standby"),array("Done",$stand),"alert_id",$alert);
//echo "update alert set status='Done', standby='".$stand."' where alert_id='".$alert."'";
//echo "update alert set status='Done', standby='".$stand."' where alert_id='".$alert."'";
$tab1=mysql_query("update alert set status='Done', standby='".$stand."' where alert_id='".$alert."'");
if($sql && $tab1)
$str='1';
else
$str='0';
}
echo json_encode($str);
?>