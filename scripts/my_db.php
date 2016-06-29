<meta charset="UTF-8">
<?php
$db_hostname='localhost';
$db_database='ishop';
$db_username='admin';
$db_password='admin';
$db_server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server)die("It can not connect to DB in MySQL: " . mysql_error());
mysql_select_db($db_database)or die("It can be choose database: ".mysql_error());
// настройка кодировки
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");

function is_child($parent)
{
    $query = "SELECT COUNT(*) FROM categories WHERE parent={$parent}";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    return $row[0];
}

function show_tovars($cat_key){
    $query = "SELECT name FROM tovari WHERE categories_key={$cat_key} ORDER BY show_method";
    $result = mysql_query($query);
    $rows = mysql_num_rows($result);
    $text='<ol>';

    for ($j = 0; $j < $rows; $j++)
    {   $row = mysql_fetch_row($result);
        $text.= "<li>{$row[0]}</li>";
    }
    $text.= "</ol> ";

    return $text;
}

function show_catalog($parent=0)
{
    $query = "SELECT * FROM categories WHERE parent={$parent} ORDER BY show_method";
    $result = mysql_query($query);
    if (!$result) die("Сбой при доступе к базе данных: " . mysql_error());

    $rows = mysql_num_rows($result);
    $text='';
    for ($j = 0; $j < $rows; $j++)
    {
        $row = mysql_fetch_row($result);
        $text.="<ul> <li> {$row[1]} : </li>";
        if(is_child($row[0]))
        {
            $text.=show_catalog($row[0]);
        }
        else
        {
            $text.=show_tovars($row[0]);
        }
        $text.='</ul>';
    }

    return $text;
}
echo show_catalog();
