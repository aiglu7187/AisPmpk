<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/semantic/dist/semantic.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

</head>

<body>


<?php
require ('lib/connect.php');
?>

<div id="maintpl" class="ui stackable container">

<table border="1" width="100%">

<tr>

<td>
№ п/п
</td>

<td>
ФИО
</td>

<td>
Принятые на тер.
</td>

<td>
Выезды
</td>

<td>
Всего
</td>

</tr>


<?php

// месяц
$mon = '2018-09-01';


$result = mysqli_query($link, "SELECT id_users, second_name, first_name, third_name FROM users ORDER BY second_name ") or die("ошибка в выборке ");
$i = 0;
while ($row = mysqli_fetch_row($result)) {

?>

<tr>

<td>
<?php echo ++$i; ?>
</td>

<td>
<?php
echo ucfirst($row[1])." ".ucfirst($row[2])." ".ucfirst($row[3]);
?>
</td>

<td>
<?php
$j=0;
$rezcount1 = mysqli_query($link, "SELECT COUNT(*) FROM fullbase WHERE (fb_spsy=$row[0] OR fb_sdef=$row[0] OR fb_slog=$row[0] OR fb_ssoc=$row[0]) AND fb_outdoor<>1 AND fb_outdoor<>2 AND fb_date >= '$mon'") or die("ошибка в выборке");
$row_cnt1 = mysqli_fetch_row($rezcount1);
$j=$row_cnt1[0];
$rezcount2 = mysqli_query($link, "SELECT COUNT(*) FROM giabase WHERE (gia_spsy1=$row[0] OR gia_spsy2=$row[0] OR gia_sdef=$row[0] OR gia_slog=$row[0] OR gia_ssoc=$row[0]) AND gia_outdoor<>1 AND gia_outdoor<>2  AND gia_date >= '$mon'") or die("ошибка в выборке");
$row_cnt2 = mysqli_fetch_row($rezcount2);
$j+=$row_cnt2[0];
echo $j;

?>
</td>

<td>
<?php
$k=0;
$rezcount3 = mysqli_query($link, "SELECT COUNT(*) FROM fullbase WHERE (fb_spsy=$row[0] OR fb_sdef=$row[0] OR fb_slog=$row[0] OR fb_ssoc=$row[0]) AND (fb_outdoor=1 OR fb_outdoor=2) AND fb_date >= '$mon'") or die("ошибка в выборке");
$row_cnt3 = mysqli_fetch_row($rezcount3);
$k=$row_cnt3[0];
$rezcount4 = mysqli_query($link, "SELECT COUNT(*) FROM giabase WHERE (gia_spsy1=$row[0] OR gia_spsy2=$row[0] OR gia_sdef=$row[0] OR gia_slog=$row[0] OR gia_ssoc=$row[0]) AND (gia_outdoor=1 OR gia_outdoor=2) AND gia_date >= '$mon'") or die("ошибка в выборке");
$row_cnt4 = mysqli_fetch_row($rezcount4);
$k+=$row_cnt4[0];
echo $k;

?>
</td>

<td>
<?php
echo $j+$k;
?>
</td>

</tr>

<?php

}

?>




</table>


</div>
