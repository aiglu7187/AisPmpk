<?php

require ('connect.php');

$today = date("Y-m-d"); 



$result = mysqli_query($link, "SELECT pr_num FROM proto WHERE creation_date NOT LIKE '{$today}%' AND status=1") or die("ошибка");

while ($row = mysqli_fetch_row($result)) {
	mysqli_query($link, "INSERT INTO zfreenumber (freenumber) VALUES ('{$row[0]}')") OR die("NIEN! 3");
}

mysqli_query($link, "DELETE FROM proto WHERE creation_date NOT LIKE '{$today}%' ") or die("ошибка удаления");






?>