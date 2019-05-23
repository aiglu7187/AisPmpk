<?php

$id = $_REQUEST['id'];
$codeval = $_REQUEST['codeval'];

require ('connect.php');

mysqli_query($link, "UPDATE fullbase SET fb_customcode='{$codeval}' WHERE id='{$id}' LIMIT 1") or die("что-то пошло не так");

echo "<h4>Код программы успешно изменен!</h4>";

exit;


?>