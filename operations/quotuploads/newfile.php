<?php
date_default_timezone_set('Asia/Kolkata');

/**
 * ZIP All content of current folder
 * @link https://shellcreeper.com/?p=1249
 */
 
/* ZIP File name and path */
$zip_file = 'files.zip';
 
/* Exclude Files */
$exclude_files = array();
$exclude_files[] = realpath( $zip_file );
$exclude_files[] = realpath( 'zip.php' );
 
/* Path of current folder, need empty or null param for current folder */
$root_path = realpath( 'approve' );

$arr_folder = [];
 
/* Initialize archive object */
$zip = new ZipArchive;
$zip_open = $zip->open( $zip_file, ZipArchive::CREATE );
 
/* Create recursive files list */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator( $root_path ),
    RecursiveIteratorIterator::LEAVES_ONLY
);
 
/* For each files, get each path and add it in zip */
if( !empty( $files ) ){
 
    foreach( $files as $name => $file ) {
 
        /* get path of the file */
        $file_path = $file->getRealPath();
        
        $filename = $file_path;
        if (file_exists($filename)) {
           // echo $file."-".date ("F d Y H:i:s", filemtime($file));die;
           // echo "$filename was last modified: " . date ("Y-m-d", filemtime($filename));
            $file_created =  date ("Y-m-d", filemtime($filename));
            // echo $file_created."<br>";
            if($file_created=='2023-11-30'){
                
                 
                /* only if it's a file and not directory, and not excluded. */
                if( !is_dir( $file_path ) && !in_array( $file_path, $exclude_files ) ){
         
                    /* get relative path */
                    $file_relative_path = str_replace( $root_path, '', $file_path );
         
                    /* Add file to zip archive */
                    $zip_addfile = $zip->addFile( $file_path, $file_relative_path );
                    array_push($arr_folder,$file_path);
                }
            }       
        }
       
    }
}
 
/* Create ZIP after closing the object. */
$zip_close = $zip->close();

if(count($arr_folder)>0){
    for($i=0;$i<count($arr_folder);$i++){
        unlink($arr_folder[$i]);
    }
}


echo 'Done';

?>