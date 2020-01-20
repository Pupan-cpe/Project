<?php

$link = mysqli_connect('localhost', 'root', '', 'project') or die('ไม่สามารถติดต่อฐานข้อมูลได้'.mysqli_connect_error());

mysqli_set_charset($link, 'utf8');

?>
