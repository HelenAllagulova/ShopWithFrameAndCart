<meta charset="UTF-8">
<?php

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    $idMass = $_POST['forId'];
    $comMass = $_POST['comment'];

    array_multisort($idMass, $comMass);

    echo '<pre>idMassafetr';
    var_dump($idMass);
    echo '</pre>';


    echo '<pre>comMassafter';
    var_dump($comMass);
    echo '</pre>';

    include_once '../otziv/const.php';
    $baza_comments=fileToArray(FILENAME);

    $text = '';
    for($i=0; $i<count($baza_comments)-1;$i++ ){
        $stroka=explode(';',$baza_comments[$i]);
        $stroka[3] = $comMass[$i];
        if (isset($_POST[$stroka[0]]))
            foreach($_POST[$stroka[0]] as $photo){
                $trueFotos .= "<img src='{$photo}'>";
                $allTrueFotos .= "<img src='{$photo}'>".PHP_EOL;
            }
        echo '<pre>';
        var_dump($stroka);
        echo '</pre>';
        $text .= $stroka[0].';'.$stroka[1].';'.$stroka[2].';'
            .$stroka[3].';'.$stroka[4].(isset($trueFotos)?';'.$trueFotos:'').PHP_EOL;
        unset($trueFotos);
    }
    echo '<pre>text';
    var_dump($text);
    echo '</pre>';
    file_put_contents('../../data/db_redact.txt', $text);


    file_put_contents('true_image.txt', $allTrueFotos);
    echo 'Изменения успешно сохранены.';