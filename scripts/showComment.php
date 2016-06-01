<?php

    include_once 'const.php';


    If ( !($rows = fileToArray( FILENAME )) )
        exit(-1);
    $count = count($rows);
    $i = 0;
    foreach ( $rows as $row )
    {
        $i++;
        $parts = explode( ';', $row);// explode — Разбивает строку $row с помощью разделителя ;
        //print_r($parts);
        if ( $i != $count)
        {
            if (isset($_GET['idTovar'])){
                if ($parts[0] != $_GET['idTovar']) {continue;}
                echo $parts[3].'<br> Пользователь ' . $parts[1] .  ' написал: <br>'  . $parts[2] . '<br>' ;
            }
            else {
                echo $parts[3] . '<br> Пользователь ' . $parts[1] .  ' написал: <br>'  . $parts[2] . '<br>' ;
            }
        }
        else {
            break;
        }
    }

?>