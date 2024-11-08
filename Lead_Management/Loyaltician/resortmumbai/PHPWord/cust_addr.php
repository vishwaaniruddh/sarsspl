<?php
/*require_once 'src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
*/
include_once('../config.php');
$cust_query=mysqli_query($conn,"select * from DoctorMembers");
$i=1;




$message1='';
$name='';
$Primary_BuldNo_addrss='';
$Primary_Area_addrss='';
$Primary_Landmark_addrss='';
$Primary_Pincode='';
$Primary_mob2='';
$files='';
while($cust=mysqli_fetch_array($cust_query))
{


 $message1='';


$name=$cust['Spouse_Title'].". ".$cust['Spouse_FirstName']." ".$cust['Spouse_LastName'];
$Primary_BuldNo_addrss=$cust['Primary_BuldNo_addrss'];
$Primary_Area_addrss=$cust['Primary_Area_addrss'];
$Primary_Landmark_addrss=$cust['Primary_Landmark_addrss'];
$Primary_Pincode=$cust['Primary_Pincode'];
$Primary_mob2=$cust['Primary_mob2'];


         $message1.='</br></br><table border="1">';
        $message1.='<tr>';
        $message1.='<th>Name: </th>';
        $message1.='<td>'.$name.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Buld No</th>';
        $message1.='<td>'.$Primary_BuldNo_addrss.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Are Address</th>';
        $message1.='<td>'.$Primary_Area_addrss.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Landmark</th>';
        $message1.='<td>'.$Primary_Landmark_addrss.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Pincode</th>';
        $message1.='<td>'.$Primary_Pincode.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Mobile</th>';
        $message1.='<td>'.$Primary_mob2.'</td>';
        $message1.='</tr></table>';

$i++;
$files.=$message1;

}

test($files);

function test($message1){
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename="."file".".doc");
header("Pragma: no-cache");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b>Member Details:</b></br></br>";

echo $message1;
echo "</body>";
echo "</html>";

}

/*
$phpWord="";
$phpWord = new \PhpOffice\PhpWord\PhpWord(); 
$section = $phpWord->addSection(); 

$fontStyleName = 'oneUserDefinedStyle';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Tahoma', 'size' => 10, 'bold' => true)
);




//$cellHCentered = array('align' => 'center');
$table = $section->addTable();


$table->addRow();
$table->addCell(2000)->addText(htmlspecialchars(""));
$table->addCell(6000)->addText(htmlspecialchars($cust['Spouse_Title'].". ".$cust['Spouse_FirstName']." ".$cust['Spouse_LastName']),$fontStyleName);

if(trim($cust['Primary_BuldNo_addrss'])!=""){ 
$table->addRow();
$table->addCell(2000)->addText(htmlspecialchars(""));
$table->addCell(6000)->addText(htmlspecialchars($cust['Primary_BuldNo_addrss']),$fontStyleName);
}

if(trim($cust['Primary_Area_addrss'])!=""){ 
$table->addRow();
$table->addCell(2000)->addText(htmlspecialchars(""));
$table->addCell(6000)->addText(htmlspecialchars($cust['Primary_Area_addrss']),$fontStyleName);
}
                				
if(trim($cust['Primary_Landmark_addrss'])!=""){ 
$table->addRow();
$table->addCell(2000)->addText(htmlspecialchars(""));
$table->addCell(6000)->addText(htmlspecialchars($cust['Primary_Landmark_addrss']),$fontStyleName);
}

if(trim($cust['Primary_Pincode'])!=""){ 
$table->addRow();
$table->addCell(2000)->addText(htmlspecialchars(""));
$table->addCell(6000)->addText(htmlspecialchars($cust['Primary_Pincode']),$fontStyleName);
}

if(trim($cust['Primary_mob2'])!=""){ 
$table->addRow();
$table->addCell(2000)->addText(htmlspecialchars(""));
$table->addCell(6000)->addText(htmlspecialchars($cust['Primary_mob2']),$fontStyleName);
}
/*
$mob="";
if(trim($cust['mob1'])!=""){ 
$mob=$cust['mob1'];
}

if(trim($cust['mob2'])!=""){ 
$mob=$mob."/".$cust['mob2'];
}

if($mob!=""){
$table->addRow();
$table->addCell(2000)->addText(htmlspecialchars(""));
$table->addCell(6000)->addText(htmlspecialchars($mob),
$fontStyleName); }  */      


/*
 
$filename=$cust['GenerateMember_Id'].'.docx';

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("wordAdd/".$cust['GenerateMember_Id'].'.docx');



//$objWriter->save($filename);
 header("Content-type: application/Word2007");
 header("Content-Disposition: attachment;Filename=$filename");
 flush();
 unlink($filename);

$i++;
}
*/



?>



