<?php
session_start();
if (!$_SESSION['user']) {
  header('location:index.php');
} else {

  include ("config.php");
  $dt = date('Y-m-d H:i:s');
  $errors = '0';

  $recon_chrg = round($_POST['recon_chrg'], 2);
  $discon_chrg = round($_POST['discon_chrg'], 2);
  $sd = round($_POST['sd'], 2);
  $after_duedt_chrg = round($_POST['after_duedt_chrg'], 2);
  $pdt = str_replace('/', '-', $_POST['paiddt']);

  mysqli_autocommit($con, FALSE);

  $nwgqr = mysqli_query($con, "select * from ebillfundrequests where req_no='" . $_POST['reqno'] . "'");
  $nwfrws = mysqli_fetch_array($nwgqr);



  $sitenw = mysqli_query($con, "select bank,projectid,state from " . $nwfrws[12] . "_sites where trackerid='" . $nwfrws[14] . "'");
  $siteron = mysqli_fetch_row($sitenw);


  if ($nwfrws[12] == 'FSS04' || $nwfrws[12] == 'DIE002' || $nwfrws[12] == 'AGS01') {
    $state = 'Maharashtra';
  } else {

    $state = $siteron[2];
  }

  $invd = '';
  $totcnt = '0';
  if ($nwfrws[12] == 'Tata05') {
    $totcnt = '10';
  } elseif ($nwfrws[12] == 'AGS01') {
    $totcnt = '100';
  } elseif ($nwfrws[12] == 'HITACHI07') {
    $totcnt = '15';
  } elseif ($nwfrws[12] == 'DIE002') {
    $totcnt = '200';
  } elseif ($nwfrws[12] == 'FIS03') {
    $totcnt = '100';
  } else {
    $totcnt = '20';
  }

  if (date('m') >= '4') {
    $invd = date('y') . "-" . date('y', strtotime('+1 year'));
  } else {
    $invd = date('y', strtotime('-1 year')) . "-" . date('y');
  }
  $sql5ss = "";
  if ($nwfrws[12] == 'AGS01') {

    if ($siteron[1] == 'PSU') {
      $sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='" . $nwfrws[12] . "' and projectid='" . $siteron[1] . "'  and createdby='" . $_SESSION['user'] . "' and state='" . $state . "'  and open='0'";

    } else {
      $sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='" . $nwfrws[12] . "'  and projectid='" . $siteron[1] . "' and bank='" . $siteron[0] . "' and createdby='" . $_SESSION['user'] . "' and state='" . $state . "'  and open='0'";

    }


  } elseif ($nwfrws[12] == 'FIS03') {
    $sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='" . $nwfrws[12] . "'  and projectid='" . $siteron[1] . "' and createdby='" . $_SESSION['user'] . "' and state='" . $state . "'  and open='0'";
  } elseif ($nwfrws[12] == 'Tata05') {

    if ($siteron[1] == "MOF") {
      $sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='" . $nwfrws[12] . "' and  projectid='" . $siteron[1] . "' and createdby='" . $_SESSION['user'] . "' and state='" . $state . "'  and open='0'";
    } else {
      $sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='" . $nwfrws[12] . "' and bank='" . $siteron[0] . "' and projectid='" . $siteron[1] . "' and createdby='" . $_SESSION['user'] . "' and state='" . $state . "'  and open='0'";

    }

  } else {
    $sql5ss = "select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='" . $nwfrws[12] . "' and bank='" . $siteron[0] . "' and projectid='" . $siteron[1] . "' and createdby='" . $_SESSION['user'] . "' and state='" . $state . "'  and open='0'";
  }

  echo $sql5ss;
}

