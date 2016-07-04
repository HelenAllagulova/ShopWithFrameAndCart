<meta charset="UTF-8">
<?php

    include_once 'const.php';
    require_once '../db_config.php';


    If ( !($rows = fileToArray(FILENAMERED)) )
        exit(-1);
    //var_dump($rows);
    $count = count($rows);
    $i = 0; //Счетчит отвечает за строк файла db
    foreach ( $rows as $row ) {
        $i++;
        if($i!=$count)
        {
            $parts = explode(';', $row); // explode — Разбивает строку $row с помощью разделителя ;
            if(!isset($_GET['idTovar']))
            {

                echo $parts[4] . '<br> Пользователь ' . $parts[2] . ' написал: <br>' . $parts[3] . '<br>'.
                (isset($parts[5])?($parts[5]):''). '<br>';

                continue;
            }

            if ($parts[1] == $_GET['idTovar']) {
                echo $parts[4] . '<br> Пользователь ' . $parts[2] . ' написал: <br>' . $parts[3] . '<br>'.
                    (isset($parts[5])?($parts[5]):''). '<br>';
            }
        }
        else
            break;
    }

//if(!isset($_GET['idTovar'])) {
//    $query = "SELECT * FROM comments JOIN images ON comments.id_comment=images.id_comment";
//    $result = mysql_query($query);
//    if (!$result) {
//        echo 'Error with reading from DB: ' . mysql_error();
//    }
//    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
//        $img_path = htmlspecialchars_decode($row['img_path'], ENT_QUOTES);
//        echo $row['date'] . '<br> Пользователь ' . $row['name_customer'] . ' написал: <br>' . $row['comment'] . $img_path . '<br>';
//    }
//}



if (isset($_GET['idTovar'])) {
    $tov = substr($_GET['idTovar'],3,1);
    $query = "SELECT * FROM comments JOIN images ON comments.id_comment=images.id_comment WHERE comments.id_tovar={$tov}";

    $result = mysql_query($query);
    if (!$result) {
        echo 'Error with reading from DB: ' . mysql_error();
    }
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $img_path = htmlspecialchars_decode($row['img_path'],ENT_QUOTES);
        echo $row['date'] . '<br> Пользователь ' . $row['name_customer'] . ' написал: <br>' . $row['comment'] . $img_path . '<br>';
    }
}
?>