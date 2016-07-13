<?php


class admin_class
{
        private  $msg='';
        public $connection='';
    
        public function __construct()
        {
            session_start();
        }
    
        public function admin_exit(){
            if (isset($_SESSION['login']))
                unset($_SESSION['login']);
        }
        
        public function admin_enter()
        {
            if ($_POST['login'] == '' || $_POST['password'] == '') {
                die('Недостаточно параметров');
            }
            $str = file_get_contents('secret.txt');
            $arrAdmin = explode(';', $str);
            if ($arrAdmin[0] == $_POST['login'] && $arrAdmin[1] == $_POST['password']) {
                $_SESSION['login'] = $_POST['login'];
                $msg = 'Успешная авторизация <br>';
                return $msg;
            } else {
                die('Неверное значение имени и пароля!');
            }
        }

        public  function ShowAllImage( $path, $baza_comments ) {
            global $arrImages;

            $pathImage = opendir($path);
            $text = '<ol>';
            $fl = 0;
            while ( $file = readdir($pathImage)) {
                if ( $file == '..' || $file == '.' || $file > 38)
                    continue;
                elseif (filetype($path . '/' . $file) == 'dir')
                    $text .= $file  . '><br>' . $this->ShowAllImage( $path . '/' . $file,$baza_comments );
                else {
                    $fullName = trim("$path/$file");
                    $check_baza="<img src='{$fullName}'>";
                    $com_vivod='';
                    foreach ($baza_comments as $row){
                        $comment=explode(';',$row);
                        if (!isset($comment[5])) continue;
                        $pos=strstr($comment[5],$check_baza);
                        if($pos!==false){
                            $com_vivod=$comment[3];
                            $idForTextAreaAndCheckBox = $comment[0];
                        }
                    }
                    //$isChecked = in_array($fullName, $arrImages) ? 'checked' : '';
                    foreach($arrImages as $value)
                    {
                        if (strstr($value, $fullName))
                        {
                            $isChecked = 'checked';
                            break;
                        }
                        else
                        {
                            $isChecked = '';
                        }
                    }
                    if (($fl == 0) && (isset($idForTextAreaAndCheckBox)))
                    {
                        $text .= "<br> User comment: <br>
                        <input type='text' hidden form='fSavePerm' name='forId[]'  value='{$idForTextAreaAndCheckBox}'>
                        <textarea form='fSavePerm' name='comment[]'>$com_vivod</textarea><br>"; $fl = 1;
                    } elseif (isset($idForTextAreaAndCheckBox)){
                        $text .= "<div> $file 
                        <input type='checkbox'  $isChecked  form='fSavePerm' name='{$idForTextAreaAndCheckBox}[]' value='$fullName'/>
                        <li> $fullName</li> 
                        <img src='$fullName' width='50px' /></div><br>";
                    }
                }
            }

            return $text.'</ol>';
        }

        public  function commentFromFileWithoutIMG($baza_comments)
        {
            for ($i = 0; $i < count($baza_comments) - 1; $i++) {
                $stroka = explode(';', $baza_comments[$i]);
                if ($stroka[5] === '') {
                    echo '<div> User ' . $stroka[2] . ' comment from data: 
                        <li>' . FILENAME . '</li> to the item - ' . $stroka[1] . '<br> 
                        <input type="checkbox" form="fSavePerm">
                        <input type="text" hidden form="fSavePerm" name="forId[]" value=' . $stroka[0] . '>
                        <textarea form="fSavePerm" name="comment[]">' . $stroka[3] . '</textarea></div>';
                }
            }

        }
        
    public function connectDB($db_hostname,$db_username,$db_password,$db_database){
        $this->connection=mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
        if(!$this->connection){
            die('Ошибка подключения к БД'.mysqli_connect_error());
        }else{echo'Успешно подключение к БД';}
    }

    public function commentFromDB(){
        $query = "SELECT * FROM comments JOIN images ON comments.id_comment=images.id_comment";
        $result = mysqli_query($this->connection,$query);
        if(!$result){
            die('Ошибка чтения данных из БД'.mysqli_error());
        }else{echo'Успешно читаем из БД';}
        while ($row = mysqli_fetch_array($result)){
            $img_path = htmlspecialchars_decode($row['img_path'], ENT_QUOTES);
            echo '<br>'.$row['date'] . '  Пользователь ' . $row['name_customer'] . ' написал: <br> <input type="checkbox" form="fSavePerm"> <textarea>' . $row['comment'] .'</textarea>'. $img_path . '<br>';
        }

    }
    
}