<?php session_start();
ini_set('memory_limit', '-1');
include ('config.php');

$graph = $_POST['graph'];
$FromDat = $_POST['FromDt'];
$Todat = $_POST['Todt'];
$FromDt = date('Y-m-d', strtotime($FromDat));
$Todt = date('Y-m-d', strtotime($Todat));
$FromDt1 = date('d-m-Y', strtotime($FromDat));
$Todt1 = date('d-m-Y', strtotime($Todat));

$data = array();


if ($graph == 'graph1') {

  $q1 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q2 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q3 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q4 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '00:00:00' and '06:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");

  $f1 = mysqli_fetch_array($q1);
  $f2 = mysqli_fetch_array($q2);
  $f3 = mysqli_fetch_array($q3);
  $f4 = mysqli_fetch_array($q4);

  $data[] = ['breakfast' => $f1['No_of_paxClose'], 'LUNCH' => $f2['No_of_paxClose'], 'DINNER' => $f3['No_of_paxClose'], 'MISC' => $f4['No_of_paxClose']];
} else if ($graph == 'graph2') {

  //====================For Monday===========================
  $monarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 1) //Monday == 1
      //echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $monarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $monarray1 = substr($monarray, 0, -1);


  $q1 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where  BillDate IN(" . $monarray1 . ") ");
  $f1 = mysqli_fetch_array($q1);
  //==========================================================      

  //====================For Tuesday===========================     
  $Tuearray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 2) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Tuearray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Tuearray1 = substr($Tuearray, 0, -1);


  $q2 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where  BillDate IN(" . $Tuearray1 . ") ");
  $f2 = mysqli_fetch_array($q2);


  //==========================================================      

  //====================For Wednesday===========================     
  $Wedarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 3) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Wedarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Wedarray1 = substr($Wedarray, 0, -1);


  $q3 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where  BillDate IN(" . $Wedarray1 . ") ");
  $f3 = mysqli_fetch_array($q3);

  //==========================================================      

  //====================For Thursday===========================     
  $Thursarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 4) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Thurarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Thurarray1 = substr($Thurarray, 0, -1);


  $q4 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where  BillDate IN(" . $Thurarray1 . ") ");
  $f4 = mysqli_fetch_array($q4);

  //==========================================================      

  //====================For Fridday===========================     
  $Friarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 5) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Friarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Friarray1 = substr($Friarray, 0, -1);


  $q5 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where  BillDate IN(" . $Friarray1 . ") ");
  $f5 = mysqli_fetch_array($q5);


  //==========================================================      

  //====================For Saturday===========================     
  $satarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 6) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $satarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $satarray1 = substr($satarray, 0, -1);


  $q6 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where  BillDate IN(" . $satarray1 . ") ");
  $f6 = mysqli_fetch_array($q6);


  //==========================================================      

  //====================For Sunday===========================     
  $sunarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 7) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $sunarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $sunarray1 = substr($sunarray, 0, -1);


  $q7 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where  BillDate IN(" . $sunarray1 . ") ");
  $f7 = mysqli_fetch_array($q7);


  //==========================================================     




  $data[] = ['Monday' => $f1['No_of_paxClose'], 'Tuesday' => $f2['No_of_paxClose'], 'Wednesday' => $f3['No_of_paxClose'], 'Thursday' => $f4['No_of_paxClose'], 'Friday' => $f5['No_of_paxClose'], 'Saturday' => $f6['No_of_paxClose'], 'Sunday' => $f7['No_of_paxClose']];




} else if ($graph == 'graph3') {

  $q1 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q2 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q3 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q4 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where Time BETWEEN '00:00:00' and '06:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");

  $f1 = mysqli_fetch_array($q1);
  $f2 = mysqli_fetch_array($q2);
  $f3 = mysqli_fetch_array($q3);
  $f4 = mysqli_fetch_array($q4);

  $data[] = ['breakfast' => $f1['No_of_Sales'], 'LUNCH' => $f2['No_of_Sales'], 'DINNER' => $f3['No_of_Sales'], 'MISC' => $f4['No_of_Sales']];
} else if ($graph == 'graph4') {


  //====================For Monday===========================
  $monarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 1) //Monday == 1
      //echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $monarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $monarray1 = substr($monarray, 0, -1);


  $q1 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where  BillDate IN(" . $monarray1 . ") ");
  $f1 = mysqli_fetch_array($q1);
  //==========================================================      

  //====================For Tuesday===========================     
  $Tuearray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 2) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Tuearray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Tuearray1 = substr($Tuearray, 0, -1);


  $q2 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where  BillDate IN(" . $Tuearray1 . ") ");
  $f2 = mysqli_fetch_array($q2);


  //==========================================================      

  //====================For Wednesday===========================     
  $Wedarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 3) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Wedarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Wedarray1 = substr($Wedarray, 0, -1);


  $q3 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where  BillDate IN(" . $Wedarray1 . ") ");
  $f3 = mysqli_fetch_array($q3);

  //==========================================================      

  //====================For Thursday===========================     
  $Thursarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 4) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Thurarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Thurarray1 = substr($Thurarray, 0, -1);


  $q4 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where  BillDate IN(" . $Thurarray1 . ") ");
  $f4 = mysqli_fetch_array($q4);

  //==========================================================      

  //====================For Fridday===========================     
  $Friarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 5) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Friarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Friarray1 = substr($Friarray, 0, -1);


  $q5 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where  BillDate IN(" . $Friarray1 . ") ");
  $f5 = mysqli_fetch_array($q5);


  //==========================================================      

  //====================For Saturday===========================     
  $satarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 6) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $satarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $satarray1 = substr($satarray, 0, -1);


  $q6 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales FROM `POS_table` where  BillDate IN(" . $satarray1 . ") ");
  $f6 = mysqli_fetch_array($q6);


  //==========================================================      

  //====================For Sunday===========================     
  $sunarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 7) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $sunarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $sunarray1 = substr($sunarray, 0, -1);


  $q7 = mysqli_query($conn, "SELECT count(No_of_Pax) as No_of_Sales  FROM `POS_table` where  BillDate IN(" . $sunarray1 . ") ");
  $f7 = mysqli_fetch_array($q7);


  //==========================================================     




  $data[] = ['Monday' => $f1['No_of_Sales'], 'Tuesday' => $f2['No_of_Sales'], 'Wednesday' => $f3['No_of_Sales'], 'Thursday' => $f4['No_of_Sales'], 'Friday' => $f5['No_of_Sales'], 'Saturday' => $f6['No_of_Sales'], 'Sunday' => $f7['No_of_Sales']];





  /*
     if(date('D')!='Mon') { 
        //take the last monday
          $staticstart = date('Y-m-d',strtotime('last Monday'));    
     }
    for($i=0;$i<7;$i++){
      $d=  date('Y-m-d', strtotime("+$i day", strtotime($staticstart)));
      $day=date('l', strtotime("+$i day", strtotime($staticstart)));
      
   
   
     $q1=mysqli_query($conn,"SELECT count(No_of_Pax) as No_of_Sales FROM `POS_table` where  BillDate = '".$d."' ");
      $f1=mysqli_fetch_array($q1);
   
   $data[]= [$day=>$f1['No_of_Sales']];
   
    }*/

} else if ($graph == 'graph5') {


  $q1 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q2 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q3 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");
  $q4 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '00:00:00' and '06:59:59' and BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "'");

  $f1 = mysqli_fetch_array($q1);
  $f2 = mysqli_fetch_array($q2);
  $f3 = mysqli_fetch_array($q3);
  $f4 = mysqli_fetch_array($q4);


  $revenu1 = $f1['FoodAmt'] + $f1['SoftBevAmt'] + $f1['IndianLiqAmt'] + $f1['ImpLiqAmt'] + $f1['No_of_MiscAmt'];
  $revenu2 = $f2['FoodAmt'] + $f2['SoftBevAmt'] + $f2['IndianLiqAmt'] + $f2['ImpLiqAmt'] + $f2['No_of_MiscAmt'];
  $revenu3 = $f3['FoodAmt'] + $f3['SoftBevAmt'] + $f3['IndianLiqAmt'] + $f3['ImpLiqAmt'] + $f3['No_of_MiscAmt'];
  $revenu4 = $f4['FoodAmt'] + $f4['SoftBevAmt'] + $f4['IndianLiqAmt'] + $f4['ImpLiqAmt'] + $f4['No_of_MiscAmt'];

  $discount1 = $f1['FoodDiscAmt'] + $f1['SoftBevDiscAmt'] + $f1['IndianLiqDiscAmt'] + $f1['ImpLiqDiscAmt'] + $f1['MiscDiscAmt'];
  $discount2 = $f2['FoodDiscAmt'] + $f2['SoftBevDiscAmt'] + $f2['IndianLiqDiscAmt'] + $f2['ImpLiqDiscAmt'] + $f2['MiscDiscAmt'];
  $discount3 = $f3['FoodDiscAmt'] + $f3['SoftBevDiscAmt'] + $f3['IndianLiqDiscAmt'] + $f3['ImpLiqDiscAmt'] + $f3['MiscDiscAmt'];
  $discount4 = $f4['FoodDiscAmt'] + $f4['SoftBevDiscAmt'] + $f4['IndianLiqDiscAmt'] + $f4['ImpLiqDiscAmt'] + $f4['MiscDiscAmt'];

  $netRevenue1 = $revenu1 - $discount1;
  $netRevenue2 = $revenu2 - $discount2;
  $netRevenue3 = $revenu3 - $discount3;
  $netRevenue4 = $revenu4 - $discount4;

  $data[] = ['breakfast' => $netRevenue1, 'LUNCH' => $netRevenue2, 'DINNER' => $netRevenue3, 'MISC' => $netRevenue4];

} else if ($graph == 'graph6') {



  //====================For Monday===========================
  $monarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 1) //Monday == 1
      //echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $monarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $monarray1 = substr($monarray, 0, -1);


  $q1 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(" . $monarray1 . ") ");
  $f1 = mysqli_fetch_array($q1);
  $revenu1 = $f1['FoodAmt'] + $f1['SoftBevAmt'] + $f1['IndianLiqAmt'] + $f1['ImpLiqAmt'] + $f1['No_of_MiscAmt'];
  $discount1 = $f1['FoodDiscAmt'] + $f1['SoftBevDiscAmt'] + $f1['IndianLiqDiscAmt'] + $f1['ImpLiqDiscAmt'] + $f1['MiscDiscAmt'];
  $netRevenue1 = $revenu1 - $discount1;
  //==========================================================      

  //====================For Tuesday===========================     
  $Tuearray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 2) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Tuearray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Tuearray1 = substr($Tuearray, 0, -1);


  $q2 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(" . $Tuearray1 . ") ");
  $f2 = mysqli_fetch_array($q2);
  $revenu2 = $f2['FoodAmt'] + $f2['SoftBevAmt'] + $f2['IndianLiqAmt'] + $f2['ImpLiqAmt'] + $f2['No_of_MiscAmt'];
  $discount2 = $f2['FoodDiscAmt'] + $f2['SoftBevDiscAmt'] + $f2['IndianLiqDiscAmt'] + $f2['ImpLiqDiscAmt'] + $f2['MiscDiscAmt'];
  $netRevenue2 = $revenu2 - $discount2;


  //==========================================================      

  //====================For Wednesday===========================     
  $Wedarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 3) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Wedarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Wedarray1 = substr($Wedarray, 0, -1);


  $q3 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(" . $Wedarray1 . ") ");
  $f3 = mysqli_fetch_array($q3);
  $revenu3 = $f3['FoodAmt'] + $f3['SoftBevAmt'] + $f3['IndianLiqAmt'] + $f3['ImpLiqAmt'] + $f3['No_of_MiscAmt'];
  $discount3 = $f3['FoodDiscAmt'] + $f3['SoftBevDiscAmt'] + $f3['IndianLiqDiscAmt'] + $f3['ImpLiqDiscAmt'] + $f3['MiscDiscAmt'];
  $netRevenue3 = $revenu3 - $discount3;

  //==========================================================      

  //====================For Thursday===========================     
  $Thursarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 4) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Thurarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Thurarray1 = substr($Thurarray, 0, -1);


  $q4 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where  BillDate IN(" . $Thurarray1 . ") ");
  $f4 = mysqli_fetch_array($q4);
  $revenu4 = $f4['FoodAmt'] + $f4['SoftBevAmt'] + $f4['IndianLiqAmt'] + $f4['ImpLiqAmt'] + $f4['No_of_MiscAmt'];
  $discount4 = $f4['FoodDiscAmt'] + $f4['SoftBevDiscAmt'] + $f4['IndianLiqDiscAmt'] + $f4['ImpLiqDiscAmt'] + $f4['MiscDiscAmt'];
  $netRevenue4 = $revenu4 - $discount4;

  //==========================================================      

  //====================For Fridday===========================     
  $Friarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 5) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $Friarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $Friarray1 = substr($Friarray, 0, -1);


  $q5 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where  BillDate IN(" . $Friarray1 . ") ");
  $f5 = mysqli_fetch_array($q5);
  $revenu5 = $f5['FoodAmt'] + $f5['SoftBevAmt'] + $f5['IndianLiqAmt'] + $f5['ImpLiqAmt'] + $f5['No_of_MiscAmt'];
  $discount5 = $f5['FoodDiscAmt'] + $f5['SoftBevDiscAmt'] + $f5['IndianLiqDiscAmt'] + $f5['ImpLiqDiscAmt'] + $f5['MiscDiscAmt'];
  $netRevenue5 = $revenu5 - $discount5;


  //==========================================================      

  //====================For Saturday===========================     
  $satarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 6) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $satarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $satarray1 = substr($satarray, 0, -1);


  $q6 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where  BillDate IN(" . $satarray1 . ") ");
  $f6 = mysqli_fetch_array($q6);
  $revenu6 = $f6['FoodAmt'] + $f6['SoftBevAmt'] + $f6['IndianLiqAmt'] + $f6['ImpLiqAmt'] + $f6['No_of_MiscAmt'];
  $discount6 = $f6['FoodDiscAmt'] + $f6['SoftBevDiscAmt'] + $f6['IndianLiqDiscAmt'] + $f6['ImpLiqDiscAmt'] + $f6['MiscDiscAmt'];
  $netRevenue6 = $revenu6 - $discount6;


  //==========================================================      

  //====================For Sunday===========================     
  $sunarray = "";

  for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    if (date('N', $i) == 7) //Monday == 1
      //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday

      $sunarray .= "'" . date('Y-m-d', $i) . "'" . ",";

  }
  $sunarray1 = substr($sunarray, 0, -1);


  $q7 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(" . $sunarray1 . ") ");
  $f7 = mysqli_fetch_array($q7);
  $revenu7 = $f7['FoodAmt'] + $f7['SoftBevAmt'] + $f7['IndianLiqAmt'] + $f7['ImpLiqAmt'] + $f7['No_of_MiscAmt'];
  $discount7 = $f7['FoodDiscAmt'] + $f7['SoftBevDiscAmt'] + $f7['IndianLiqDiscAmt'] + $f7['ImpLiqDiscAmt'] + $f7['MiscDiscAmt'];
  $netRevenue7 = $revenu7 - $discount7;

  //==========================================================     




  $data[] = ['Monday' => $netRevenue1, 'Tuesday' => $netRevenue2, 'Wednesday' => $netRevenue3, 'Thursday' => $netRevenue4, 'Friday' => $netRevenue5, 'Saturday' => $netRevenue6, 'Sunday' => $netRevenue7];





  /*
      
         if(date('D')!='Mon') { 
            //take the last monday
              $staticstart = date('Y-m-d',strtotime('last Monday'));    
         }
        for($i=0;$i<7;$i++){
          $d=  date('Y-m-d', strtotime("+$i day", strtotime($staticstart)));
          $day=date('l', strtotime("+$i day", strtotime($staticstart)));
          
         
       
         $q1=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate = '".$d."' ");
          $f1=mysqli_fetch_array($q1);
          
          $revenu1=$f1['FoodAmt']+$f1['SoftBevAmt']+$f1['IndianLiqAmt']+$f1['ImpLiqAmt']+$f1['No_of_MiscAmt'];
          $discount1=$f1['FoodDiscAmt']+$f1['SoftBevDiscAmt']+$f1['IndianLiqDiscAmt']+$f1['ImpLiqDiscAmt']+$f1['MiscDiscAmt'];
          $netRevenue1 = $revenu1-$discount1;
          
       $data[]= [$day=>$netRevenue1];
       
        }*/

}





echo json_encode($data);

?>