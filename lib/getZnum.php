<?php


require ('tpl/connect.php');

$rezcount = mysqli_query($link, "SELECT COUNT(*) FROM zfreenumber") or die("ошибка в выборке данных в таблице 1");

$row_cnt = mysqli_fetch_row($rezcount);

if ($row_cnt[0]>0) {

$result = mysqli_query($link, "SELECT * FROM zfreenumber LIMIT 1") or die("ошибка выборки свободного номера");
$row = mysqli_fetch_row($result);

echo $row[1];

mysqli_query($link, "DELETE FROM zfreenumber WHERE id='{$row[0]}'") or die("ошибка удаления");


} else {

$result = mysqli_query($link, "SELECT id, zcnumber FROM znumber ORDER BY id DESC LIMIT 1") or die("ошибка выборки номера");
$row = mysqli_fetch_row($result);

$row[1] += 1;
echo $row[1];

mysqli_query($link, "UPDATE znumber SET zcnumber='{$row[1]}' WHERE id='{$row[0]}'") OR die("NIEN! 3");


}








?>
