<?php

$id = $_REQUEST['id'];
$chout = $_REQUEST['chout'];

require ('connect.php');

mysqli_query($link, "UPDATE fullbase SET fb_outdoor='{$chout}' WHERE id='{$id}'") or die("что-то пошло не так");

exit;


?>