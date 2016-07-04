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
?>