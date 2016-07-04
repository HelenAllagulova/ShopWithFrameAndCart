<meta charset="UTF-8">
<?php

include_once 'const.php';

function ReadAntimat( $filename ) {

 If ( !($rows = fileToArray( $filename )) )
     return [];

 return $rows;
}
// счетчик для номера папки
function countOtziv(){
    if(file_exists('../../data/counter.txt')){
        $counter = file_get_contents('../../data/counter.txt');
        $counter++;
        $f = fopen('../../data/counter.txt','w+');
        fwrite($f,$counter);
        fclose($f);
    }
    else{
        $f = fopen('../../data/counter.txt','w+');
        fwrite($f,0);
        fclose($f);
    }
    return $counter;
}

function pathForImage($counter){
    $baza = "../../data/images_for_comments/".$_REQUEST['idTovar']."/";
    if(!file_exists($baza)) mkdir($baza);
    $baza .= $counter."/";
    if(!file_exists($baza)) mkdir($baza);
    return $baza;
}

function images($counter)
{
        $photos = '';
        foreach ($_FILES['filename']['type'] as $i=>$value)
        {
            switch($_FILES['filename']['type'][$i])
            {
                case 'image/jpeg': $ext = 'jpg'; break;
                case 'image/gif':  $ext = 'gif'; break;
                case 'image/png':  $ext = 'png'; break;
                case 'image/tiff': $ext = 'tif'; break;
                default:           $ext = '';    break;
            }
            if ($ext)
            {
                //$put = "../../data/images_for_comments/";
                $put = pathForImage($counter);
                $n = $put."image".$i.".".$ext;
                move_uploaded_file($_FILES['filename']['tmp_name'][$i], $n);
                $photos .= "<img src='{$n}'>";
            }
        }
        return $photos;
}


 $antimat = ReadAntimat(ANTIMAT);
 $replaces= ReadAntimat(FILE_REPLACES);

require_once '../db_config.php';
if (isset($_REQUEST['idTovar']))
{
     $counter = countOtziv();
     $lowerStr = mb_strtolower( $_REQUEST['comment'] );
     if(isset($_FILES['filename']['name'])) {
         $img_paht = htmlspecialchars(images($counter),ENT_QUOTES);
         $query_2 = "INSERT INTO images VALUES ('{$counter}', '{$img_paht}')";
         $result_2 = mysql_query($query_2);
         $error_2 = mysql_error();
         if(!$result_2 )die('Error with record img: '.$error_2 );
     }
     $lowerStr  =  str_replace( $antimat, $replaces, $lowerStr );
     $time = date('H:i:s');
     $query_1 = "INSERT INTO comments VALUES ('{$counter}', '{$_REQUEST['idTovar']}', '{$_REQUEST['nameCustomer']}','{$lowerStr }','{$time}')";
        $result_1 = mysql_query($query_1);
        $error_1 = mysql_error();
        if(!$result_1) die('Error with record comment: '.$error_1);

}

include_once 'showComment.php';

/* Запись комментари в файл
  $antimat = ReadAntimat(ANTIMAT);
$replaces= ReadAntimat(FILE_REPLACES);
$handle = fopen(FILENAME, 'a');

if (isset($_REQUEST['idTovar']))
{
    $counter = countOtziv();
    $lowerStr = mb_strtolower( $_REQUEST['comment'] );
    if(isset($_FILES['filename']['name'])) $n = images($counter);
    $lowerStr  =  str_replace( $antimat, $replaces, $lowerStr );
    $toWrite = '#id='.$counter.';tov'.$_REQUEST['idTovar'] . ';' . $_REQUEST['nameCustomer'] . ';' . $lowerStr . ';' .date('H:i:s').$n.PHP_EOL;
    fwrite($handle, $toWrite);
    fclose($handle);
}

$handle = fopen( FILENAME, 'r');
$text = fread($handle, 1000000 );
echo $text;*/
 //include_once 'showComment.php';

