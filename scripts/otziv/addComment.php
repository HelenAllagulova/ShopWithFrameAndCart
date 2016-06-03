<?php

include_once 'const.php';

function ReadAntimat( $filename ) {

 If ( !($rows = fileToArray( $filename )) )
     return [];

 return $rows;
}

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
        $photos = ';';
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



// echo '<pre>';
//var_dump($_REQUEST);
// var_dump($_FILES);
 //var_dump($_FILES['filename']['name'][5]);
// echo '</pre>';

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
 echo $text;
 //include_once 'showComment.php';
?>