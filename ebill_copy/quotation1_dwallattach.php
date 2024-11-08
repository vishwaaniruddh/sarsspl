<?php

$lnks=$_POST['dnref1'];
$dwlnm=$_POST['dwlnm'];

//print_r($dwlnm);
//echo $lnks;

$arrf=explode(',',$lnks);


$cnt=count($arrf);


//$arrfnm=explode(',',$dwlnm);
//print_r($arrfnm);
/*
$str="";
for($i=0;$i<$cnt;$i++)
{
if($i==(count($arrf)-1))
{
$str.="'".$arrf[$i]."'";
}
else
{
$str.="'".$arrf[$i]."',";
}
}
*/
//echo $str;

    $files = array();


for($i=0;$i<$cnt;$i++)
{
$files[]=$arrf[$i];

}
//echo "hh".count($files);
//print_r( $files);

    # create new zip opbject
    $zip = new ZipArchive();

    # create a temp file & open it
    $tmp_file = tempnam('.','');
    $zip->open($tmp_file, ZipArchive::CREATE);

    # loop through each file
$in=0; 
   foreach($files as $file){
 
$download_file ="";
        # download file
/*
if (file_exists($file)) 
{
   $download_file = file_get_contents($file);
} 
else
{
     
$explr=explode('/',$file);
$pthnn="http://192.254.233.144/~kevalj/xxxcncindia.in/operations/quotuploads/approve/".$explr[3];

$download_file = file_get_contents($pthnn);
  // echo "ok";
}
*/
$download_file = file_get_contents($file);
        #add it to the zip
        $zip->addFromString(basename($file),$download_file);
$zip->renameName(basename($file), $dwlnm[$in]);
$in++;
    }

    # close zip
    $zip->close();

    # send the file to the browser as a download
    header('Content-disposition: attachment; filename=attachment.zip');
    header('Content-type: application/zip');
    readfile($tmp_file);
    
    
 ?>