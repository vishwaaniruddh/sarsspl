<?
include "qrlib.php";

//QRcode::png('PHP QR Code :)', 'myqr.png', $errorCorrectionLevel, $matrixPointSize, 2);

$tempDir = 'barcode_image/';

$codeContents = 'hii anand';

$fileName = 'anand1.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
echo $pngAbsoluteFilePath;
//$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;

QRcode::png($codeContents, $pngAbsoluteFilePath); 


//QRcode::png('PHP QR Code :)');?>