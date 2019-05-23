<?php

$chtid = $_REQUEST['chtid'];
$chval = $_REQUEST['chval'];

require ('connect.php');

mysqli_query($link, "UPDATE fullbase SET fb_consult='{$chval}' WHERE id='{$chtid}'") or die("что-то пошло не так");

exit;


?>