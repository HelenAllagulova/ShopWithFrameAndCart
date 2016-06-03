<?php
const FILENAME = '../../data/db.txt';
const ANTIMAT  = '../../data/antimat.txt';
const FILE_REPLACES  = '../../data/replace.txt';

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

