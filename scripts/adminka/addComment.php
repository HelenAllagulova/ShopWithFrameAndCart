<?php
/**
 * Created by PhpStorm.
 * User: rus
 * Date: 27.05.16
 * Time: 19:25
 */
function GetFilename() {
    
 if ( !file_exists('img') )
   mkdir('img');

 $pathPhotos = 'img/'.$_REQUEST['idTovar'];
 if ( !file_exists($pathPhotos) )
   mkdir($pathPhotos);


 print_r($_FILES['photo']);
 if ( count($_FILES['photo']) )
 {
//    foreach ($_FILES['photo']['name'] as $key => $value)
   $value = $_FILES['photo']['name'];
   {
     if ( !$value || !$_FILES['photo']['size'] || $_FILES['photo']['type']  != 'image/png' /* [$key] */ )
       return false;

     move_uploaded_file( $_FILES['photo']['tmp_name'], $pathPhotos.'/'.$value );

   }

   return $value;
 }
}
error_reporting(0);

include_once 'const.php';
function ReadAntimat( $filename ) {

 If ( !($rows = fileToArray( $filename )) )
     return [];

 return $rows;
}


 $antimat = ReadAntimat(ANTIMAT);
 $replaces= ReadAntimat(FILE_REPLACES);

 $handle = fopen( FILENAME, 'a');

 $lowerStr = mb_strtolower( $_REQUEST['comment'] );

 $lowerStr  =  str_replace( $antimat, $replaces, $lowerStr );
 fwrite($handle, $_REQUEST['idTovar'] . ';' . $_REQUEST['nameCustomer'] . ';' . $lowerStr . ';' .date('d:m:Y') . ';' . $_REQUEST['reting'] . ';' . GetFilename() . PHP_EOL );

 fclose($handle);

 $handle = fopen( FILENAME, 'r');

//$text = fread($handle, 1000000 );
//
// echo $text;