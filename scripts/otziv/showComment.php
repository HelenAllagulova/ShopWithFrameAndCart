<?php

    include_once 'const.php';


    If ( !($rows = fileToArray(FILENAME)) )
        exit(-1);
    //var_dump($rows);
    $count = count($rows);
    $i = 0; //Счетчит отвечает за строк файла db
    foreach ( $rows as $row ) {
        $i++;
        if($i!=$count)
        {
            $parts = explode(';', $row);// explode — Разбивает строку $row с помощью разделителя ;
            if ($parts[1] == $_GET['idTovar']) {
                echo $parts[4] . '<br> Пользователь ' . $parts[2] . ' написал: <br>' . $parts[3] . '<br>'.$parts[5]. '<br>';
            }
        }
        else
            break;
    }
?>