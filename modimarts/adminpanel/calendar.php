<?php
include 'config.php';
//error_reporting(0);
/**
*@author  Xu Ding
*@email   thedilab@gmail.com
*@website http://www.StarTutorial.com
**/
$rowid=$_POST["rowid"];
$dur=$_POST["dur"];
$tymst=$_POST["tymst"];   

class Calendar {  
/**
 * Constructor
 */
public $dtarr=array();
public $auditonarr=array();
public function __construct(){     
$this->naviHref = htmlentities($_SERVER['PHP_SELF']);
//print_r($auditonarr);
}
     
    /********************* PROPERTY ********************/  
    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
     
    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate=null;
     
    private $daysInMonth=0;
     
    private $naviHref= null;
     
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
    public function show() {
        
    global $con3;

if($_REQUEST['year']!="")
{

$yr=$_REQUEST['year'];
}
else
{
$yr=date("Y");

}

if($_REQUEST['month']!="")
{

$mnth=$_REQUEST['month'];
}
else
{

$mnth=date("m");
}
$this->currentYear=$yr;
         
        $this->currentMonth=$mnth;
         
        $this->daysInMonth=$this->_daysInMonth($mnth,$yr);  
         
        $content='<div id="calendar">'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="dates">'.$this->_createLabels().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay($i*7+$j);
                                    }
                                }
                                $content.='</ul>';
                                $content.='<div class="clear"></div>';  
             
                        $content.='</div>';
                 
        $content.='</div>';
        return $content;  
        ?>
        
    
    <?php
    }
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber){

global $rowid;
global $con3;
global $adstotaltym;
global $dur;
global $tymst;
global $dur;

        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                 
                $this->currentDay=1;
                 
            }
        }
   
  
  
$selid=0;
 
        $str="";
        $strr="";
   
         $dtt="";
          $availsecs=0;
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
             
            $cellContent = $this->currentDay;
             
               $dtt= $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
           
             //echo $dtt;
            
             $str="red";        
             
             
     $toshwfromdt=date("Y-m-d",strtotime(' +1 day'));
     $toshwtodt=date("Y-m-d",strtotime(' +30 day'));
     $curdt=date("Y-m-d",strtotime($dtt));
     // echo "anand"."select sum(duration) from ads_sec_booked where stats=0 and date='".$dtt."'";

     if(strtotime($curdt)>strtotime($toshwfromdt) && strtotime($curdt)<=strtotime($toshwtodt))
     {
        $strr= "select * from slot_details_ofdt where date='".$dtt."'";
        echo $strr;
        $gtdts=mysqli_query($con3,"select * from slot_details_ofdt where date='".$dtt."'");
        $nre=mysqli_num_rows($gtdts);
        //echo $nre;
if($nre>0)
{
    $frt=mysqli_fetch_array($gtdts);
    $gts=mysqli_query($con3,"select  `total_duration`, `stats` from Date_duration where Date='".$dtt."'");
    $gtsrws=mysqli_num_rows($gts);
    if($gtsrws>0)
    {
      $gettotdrws=mysqli_fetch_array($gts);
      
      if($gettotdrws["stats"]=="0")
      {
       $availsecstmp=0;
       $getfrtemp=mysql_query("select sum(duration) from ads_sec_booked where stats=0 and date='".$dtt."'");
       
       $frttemprs=mysql_fetch_array($getfrtemp);
       
       if($frttemprs[0]!=null)
       {
           
       $availsecstmp=$frttemprs[0];
           
       }
      
       $totbkd=$gettotdrws[0]+$availsecstmp;
       
        $availsecspen=$adstotaltym-$totbkd;
      
       if($availsecspen<=$dur)
       {
           $availsecs=0;
       }else
       {
           $availsecs=$availsecspen;
       }
      }else
      {
          $availsecs=0;
      }
}else
{
    $getfrtemp=mysql_query("select sum(duration) from ads_sec_booked where stats=0 and date='".$dtt."'");
    $frttemprs=mysql_fetch_array($getfrtemp);
   
   if($frttemprs[0]==null)
   {
        $availsecs=$adstotaltym;
    }else
    {
        $availsecs=$adstotaltym-$frttemprs[0];
        //  echo "ll".$availsecs;   
    }
}
//echo $availsecs."---".$dur."\n";
if($availsecs>=$dur)
{
    $str="green"; 
}else
{
    $str="red";  
}
}else
{
    $str="red";
}
}
    $this->currentDay++;  
    //-------------------to hihlight selected dates----//
    $getfrtempselct=mysql_query("select id from ads_sec_booked where stats=0 and date='".$dtt."' and randomtymstmp='".$tymst."' and rowid='".$rowid."'  and user_id='".$_SESSION["id"]."'");
    if($nr=mysql_num_rows($getfrtempselct)>0)
    {
       $getselws=mysql_fetch_array($getfrtempselct);
       $selid=$getselws[0];
       $str="yellow";
    }  else
    {
        $selid=0;
    }
            //-------------------to hihlight selected dates end----//
    }else{
        $this->currentDate =null;
        $cellContent=null;
        $str="";  
    }
    //$favailsecs=$adstotaltym-
    //echo $adstotaltym;
    if($availsecs>0)
    {
        $availsecs=$cellContent."\n"."<font size='2'>".$availsecs.""." </font>";
    }
    if($str=="green"){
        $tr="";
        $tr.='<li style="background-color:green;cursor:pointer" id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
        ($cellContent==null?'mask':'').'" onclick="booksecondsondt('.$rowid.','.$cellContent.','.$dur.','.$this->currentMonth.','.$this->currentYear.',this.id,'.$selid.');">'.$availsecs.PHP_EOL.'</li>';
        // $tr.=PHP_EOL;
        // $tr.="<font size='1' > 1800 secs</font></li>";
        return $tr;
    }
    if($str=="yellow"){
        $tr="";
        $tr.='<li style="background-color:yellow;cursor:pointer" id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
        ($cellContent==null?'mask':'').'" onclick="booksecondsondt('.$rowid.','.$cellContent.','.$dur.','.$this->currentMonth.','.$this->currentYear.',this.id,'.$selid.');">'.$availsecs.PHP_EOL.'</li>';
        // $tr.=PHP_EOL;
        // $tr.="<font size='1' > 1800 secs</font></li>";
                
        return $tr;
    } else {
        return '<li style="background-color:'.$str.'" id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
        ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }
}
    /**
    * create navigation
    */
    private function _createNavi(){
        global $rowid;
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
         
        $rte="";
       
        $rte.='<div class="header">';
        if($this->currentMonth!=date("m"))
        {
            //   '.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'
            $rte.='<a class="prev" id="nextc" href="javascript:void(0);" onclick="selctdtfunc('.$rowid.','.sprintf('%02d',$preMonth).','.$nextYear.');">Prev</a>'; 
                 
        } else {
        }
        $rte.= '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>';
            
        if($this->currentMonth==date("m"))
        { 
            $rte.='<a class="next" id="nextc" href="javascript:void(0);" onclick="selctdtfunc('.$rowid.','.$nextMonth.','.$nextYear.');">Next</a>'; 
    ?>
            
    <?php }
            $rte.='</div>';
            return  $rte;
    }
    /**
    * create calendar week labels
    */
    private function _createLabels(){  
        $content='';
        foreach($this->dayLabels as $index=>$label){
            $content.='<li class="start mask" >'.$label.'</li>';
        }
        return $content;
    }
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
        if(null==($month)) {
            $month = date("m",time());
        }
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
         
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
         
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
            $numOfweeks++;
        }
        return $numOfweeks;
    }
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
}