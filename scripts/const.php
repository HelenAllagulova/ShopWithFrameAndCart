<?php
const FILENAME = 'db.txt';
const ANTIMAT  = 'antimat.txt';
const FILE_REPLACES  = 'replace.txt';

function fileToArray( $filename ) {
    if ( !($handle = fopen( $filename, 'r')) )
       return false;
    $text = '';
    do {
        $row = fread($handle, 100 );
        $text .= $row;
    }
    while ($row);
    fclose($handle);
    $rows = explode( PHP_EOL, $text );
    return $rows;
}
?>

