<meta charset="UTF-8">
<?php


include_once 'const.php';
function ReadAntimat( $filename ) {

 If ( !($rows = fileToArray( $filename )) )
     return [];

 return $rows;
}

 $antimat = ReadAntimat(ANTIMAT);
 $replaces= ReadAntimat(FILE_REPLACES);

 $handle = fopen(FILENAME, 'a');

 $lowerStr = mb_strtolower( $_REQUEST['comment'] );
 if ($_FILES)  {    $name = $_FILES['filename']['name'];
     switch($_FILES['filename']['type'])
     {
      case 'image/jpeg': $ext = 'jpg'; break;
      case 'image/gif':  $ext = 'gif'; break;
      case 'image/png':  $ext = 'png'; break;
      case 'image/tiff': $ext = 'tif'; break;
      default:           $ext = '';    break;
     }
     if ($ext)
     {
      $n = "../images/image.$ext";
      move_uploaded_file($_FILES['filename']['tmp_name'], $n);
      //echo "Загружено изображение '$name' под именем '$n':<br>";
      //echo "<img src='$n'>";
     }
     //else echo "'$name' — неприемлемый файл изображения";
 }
 //else echo "Загрузки изображения не произошло";




 $lowerStr  =  str_replace( $antimat, $replaces, $lowerStr );
 fwrite($handle, $_REQUEST['idTovar'] . ';' . $_REQUEST['nameCustomer'] . ';' . $lowerStr . ';' .date('d:m:Y').' '."<img src='{$n}'>". PHP_EOL );

 fclose($handle);

// $handle = fopen( FILENAME, 'r');
//$text = fread($handle, 1000000 );
//
// echo $text;
 include_once 'showComment.php';
?>