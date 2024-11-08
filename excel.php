<?php
/**
 * CSV Export functionality using PHP.
 *
 * @author Mehul Gohil
 */

// Start the output buffer.
ob_start();

// Set PHP headers for CSV output.
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=csv_export.csv');

// Create the headers.
$header_args = array( 'ID', 'Name', 'Email' );

// Prepare the content to write it to CSV file.
$data = array(
    array('1', 'Test 1', 'test1@test.com'),
    array('2', 'Test 2', 'test2@test.com'),
    array('3', 'Test 3', 'test3@test.com'),
);

// Clean up output buffer before writing anything to CSV file.
ob_end_clean();

// Create a file pointer with PHP.
$output = fopen( 'php://output', 'w' );

// Write headers to CSV file.
fputcsv( $output, $header_args );

// Loop through the prepared data to output it to CSV file.
foreach( $data as $data_item ){
    fputcsv( $output, $data_item );
}

// Close the file pointer with PHP with the updated output.
fclose( $output );
exit;