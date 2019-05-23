<?php

$chid = $_REQUEST['chid'];



require ('connect.php');


$result = mysqli_query($link, "SELECT gia_pinkprint FROM giabase WHERE id='{$chid}' LIMIT 1") or die("ошибка в выборке бланка");
$row = mysqli_fetch_row($result);
$row[0] += 1;

mysqli_query($link, "UPDATE giabase SET gia_pinkprint={$row[0]} WHERE id='{$chid}' LIMIT 1") or die("что-то пошло не так");

exit;


?>