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

<div id="" class="">

<table border="1" width="100%">

<tr>

<td>
№ п/п
</td>

<td>
№ Заключения
</td>

<td>
Дата прохождения
</td>

<td>
Фамилия
</td>

<td>
Имя
</td>

<td>
Отчество
</td>

<td>
Дата рождения
</td>

<td>
Подтверждение, уточнение, изменение программы
</td>

<td>
Программа
</td>

<td>
Вариант
</td>

<td>
Уровень
</td>
<td>
Психолог
</td>
<td>
Логопед
</td>
<td>
Дефектолог
</td>
<td>
Др.спец-ты
</td>

</tr>


<?php

// месяц



$result = mysqli_query($link, "SELECT * FROM fullbase WHERE fb_consult=0 AND fb_status=2 AND fb_date >= '2018-10-01'") or die("ошибка в выборке ");

$i = 0;

while ($row = mysqli_fetch_row($result)) {

?>

<tr>

<td>
<?php echo ++$i; ?>
</td>


<td>
<?php echo $row[2]; ?>
</td>


<td>
<?php 
$d = new DateTime($row[3]);
echo $d->format('d.m.Y');
?>
</td>


<td>
<?php 

$fio = explode(" ", $row[4]);

echo $fio[0];
?>
</td>


<td>
<?php 
echo $fio[1];
?>
</td>

<td>
<?php 
echo $fio[2];
if ($fio[3]) {
	echo " ".$fio[3];
}
?>
</td>


<td>
<?php 
$d = new DateTime($row[5]);
echo $d->format('d.m.Y');
?>
</td>


<td>
<?php 

switch ($row[45]) {
	case '1':
		echo "Подтверждение";
		break;
	case '2':
		echo "Изменение";
		break;

	default:
		echo "Первичное";
		break;
}

?>
</td>


<td>
<?php 
if ($row[7] <> 11) {

$tepmaoop = $row[7];
$tempresult = mysqli_query($link, "SELECT gia FROM lib_op WHERE id_op=$tepmaoop ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);

echo $temprow[0]; 
} else {
	echo "ООП";
}
?>
</td>


<td>

<?php


if ($row[47]=='0' ) {

if ($row[6]>0) { 
	

	echo "И ";
	if ($row[6] > 3) {
		echo "12";
	} else {
		if ($row[7]==9 && $row[1] == 4) {
			echo "9.1";
		} elseif ($row[7]==10 && $row[1] == 4) {
			echo "9.2";
		} else {
			echo $row[7];
		}
	}

	if ($row[7]<9 && ($row[1] == 2 || $row[1] == 4)) {

	if (strripos($row[8], "7") || $row[8] == 7 || $row[7]==5 || $row[7]==7) {
		echo ".2";
	} elseif (strripos($row[8], "9") || $row[8]==9) {
		echo ".3";
	} else {
		echo ".1";
	}

	}

} elseif ($row[7]==11) {
	echo "-";
} else {
	
	echo "O ";
	if ($row[7]==9 && $row[1] == 4) {
			echo "9.1";
		} elseif ($row[7]==10 && $row[1] == 4) {
			echo "9.2";
		} else {
			echo $row[7];
		}

	if ($row[7]<9 && ($row[1] == 2 || $row[1] == 4)) {

	if (strripos($row[8], "7") || $row[8] == 7 || $row[7]==5 || $row[7]==7) {
		echo ".2";
	} elseif (strripos($row[8], "9") || $row[8]==9) {
		echo ".3";
	} else {
		echo ".1";
	}
}

}


if ($row[1]==3) {
	echo ".".$row[10];
}



} else {
	
	if ($row[6]>0) { 
	echo "И ".$row[47];
	} else {
	echo "О ".$row[47];	
	}

}




?>

</td>


<td>
<?php 

$tempresult = mysqli_query($link, "SELECT name FROM lib_edulevel WHERE fb_edulevel=$row[9]") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);

if ($temprow[0] <> '') {
echo $temprow[0];
} else {
	echo "общий";
}
?>
</td>


<td>
<?php 

if ($row[25] <> 0) {
	echo "Да";
} else {
	echo "Нет";
}

?>
</td>



<td>
<?php 

if ($row[26] <> 0) {
	echo "Да";
} else {
	echo "Нет";
}

?>
</td>



<td>
<?php 

if ($row[27] <> 0) {
	echo "Да";
} else {
	echo "Нет";
}

?>
</td>



<td>
<?php 

if ($row[28] <> 0) {
	echo "Да";
} else {
	echo "Нет";
}

?>
</td>


</tr>

<?php

}



$result = mysqli_query($link, "SELECT * FROM giabase WHERE gia_date >= '2018-10-01'") or die("ошибка в выборке ");

while ($row = mysqli_fetch_row($result)) {

?>

<tr>


<td>
<?php echo ++$i; ?>
</td>


<td>
<?php echo $row[1]; ?>
</td>


<td>
<?php 
$d = new DateTime($row[2]);
echo $d->format('d.m.Y');
?>
</td>


<td>
<?php 

$fio = explode(" ", $row[6]);

echo $fio[0];
?>
</td>


<td>
<?php 
echo $fio[1];
?>
</td>

<td>
<?php 
echo $fio[2];
if ($fio[3]) {
	echo " ".$fio[3];
}
?>
</td>


<td>
<?php 
$d = new DateTime($row[7]);
echo $d->format('d.m.Y');
?>
</td>


<td>
-
</td>


<td>
<?php 
if ($row[22] <> 11) {
$tempresult = mysqli_query($link, "SELECT gia FROM lib_op WHERE id_op=$row[22]") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);

echo $temprow[0]; 
} else {
	echo "ООП";
}
?>
</td>


<td>
-
</td>


<td>
<?php 

if ($row[21] < 4) {
	echo "ООО";
} elseif ($row[21] == 8) {
	echo "СПО";
} else {
	echo "СОО";
}
 

?>
</td>


<td>
-
</td>

<td>
-
</td>

<td>
-
</td>

<td>
-
</td>




</tr>

<?php

}



?>




</table>


</div>