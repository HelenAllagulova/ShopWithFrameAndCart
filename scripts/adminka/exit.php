<?php
require_once 'admin_class.php';
$adm = new admin_class();
$adm ->admin_exit();
header('Location: admin.html');