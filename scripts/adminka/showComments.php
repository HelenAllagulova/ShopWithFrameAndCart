<?php

function istrueImage($filename) {
    
    $text = file_get_contents('true_image.txt');
    
    return strstr($text, $filename);
    
}
function ShowPicture($filename) {
    
    $pathPhotos = 'img/'.$_REQUEST['idTovar'];
    
    return $filename && istrueImage("$pathPhotos/$filename") ? "<img src='$pathPhotos/$filename' />" : '';
    
}
    include_once 'const.php';


    If ( !($rows = fileToArray( FILENAME )) )
        exit(-1);

    foreach ( $rows as $row )
    {
        $parts = explode( ';', $row);

        if ($parts[0] != $_GET['idTovar'])
            continue;

        echo $parts[3] . '<br> Пользователь ' . $parts[1] .  ' написал: <br>'  . $parts[2] .
            ( isset($parts[4]) ? ' оценка =' . str_repeat( '*', (int)$parts[4]) : '') . ShowPicture($parts[5]) . '<br>' ;

    }

    $pathPhotos = 'img/'.$_REQUEST['idTovar'];
    
    if ( !( $files = glob( $pathPhotos . '/*.jpg' ) ) )
        exit(0);
        
    foreach($files as $filename)
      echo $filename.'<br>';
