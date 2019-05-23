<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="../../semantic/dist/semantic.min.css">
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="../../semantic/dist/semantic.min.js"></script>


<style type="text/css">
li {
margin-top: 1em; 
margin-bottom: 1em; 
 }
</style>


</head>

<body>


<?php

$getid = $_REQUEST["id"];

$spsy1 = $_REQUEST["spsy1"];
$spsy2 = $_REQUEST["spsy2"];
$slog = $_REQUEST["slog"];
$sdef = $_REQUEST["sdef"];
$ssoc = $_REQUEST["ssoc"];

if ($spsy1 || $spsy2 || $slog || $sdef || $ssoc) {
	$customsigns = 1;
}

if(!$getid) {
	die("Нет протокола на печать!");
}


require ('../connect.php');


$result = mysqli_query($link, "SELECT * FROM giabase WHERE id=$getid LIMIT 1") or die("ошибка в выборке");
$row = mysqli_fetch_row($result);


?>



<div id="mainprnttpl" class="ui stackable " style="position: absolute; width: 797px; padding-left: 20px; padding-right: 10px; font-size: 1.2em; line-height: 1.4em" >


<div class="ui stackable one column grid ">
<div class="row">
<div class="column">

<div align="center">
<div <?php if($pinkblank==1) { echo "style='color: #FFF; opacity: 0'"; } ?> >
	<br>
<b>ПРОТОКОЛ ОБСЛЕДОВАНИЯ<br>
ПСИХОЛОГО-МЕДИКО-ПЕДАГОГИЧЕСКОЙ КОМИССИИ<br>
(государственная итоговая аттестация)</b><br>
</div>




</div>

</div>


<div class="column">
<br><br>
<div align="center">
<b>№ <?php echo $row[1];?> от <?php echo strftime("%d.%m.%Y", strtotime($row[2])) ; ?></b>

</div>

</div>



<div class="column">
<br><br>
<b>Обследование проводилось: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_place WHERE id=$row[3] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>
&nbsp;&nbsp;&nbsp;
<b>в форме: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT pname FROM lib_gia_form WHERE id=$row[4] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>
<br>

</div>


<div class="column">
<br>
<b>Ф.И.О. обучающегося: </b><span style="font-size: 1.2em;"> <?php echo $row[6]; ?></span>
<br><br>
<b>Дата рождения:  </b><?php echo strftime("%d.%m.%Y", strtotime($row[7]))."г."; ?>
&nbsp;&nbsp;&nbsp;
<b>Возраст:</b>
<?php

if(strftime("%m", strtotime($row[7])) > strftime("%m", strtotime($row[2])) || strftime("%m", strtotime($row[7])) == strftime("%m", strtotime($row[2])) && strftime("%d", strtotime($row[7])) > strftime("%d", strtotime($row[2]))) {
$bdatey = (strftime("%G", strtotime($row[2])) - strftime("%G", strtotime($row[7])) - 1); 
$bdatem = (strftime("%m", strtotime($row[2])) - strftime("%m", strtotime($row[7])) + 12); 
} else {
$bdatey = (strftime("%G", strtotime($row[2])) - strftime("%G", strtotime($row[7])));
$bdatem = (strftime("%m", strtotime($row[2])) - strftime("%m", strtotime($row[7])));
}

if ($bdatey <> 0) {
echo $bdatey;


switch ($bdatey) {
	case '1':
		echo " год ";
		break;

	case '2':
		echo " года ";
		break;

	case '3':
		echo " года ";
		break;

	case '4':
		echo " года ";
		break;

	case '21':
		echo " год ";
		break;

	case '22':
		echo " года ";
		break;

	case '23':
		echo " года ";
		break;

	case '24':
		echo " года ";
		break;

	default:
		echo " лет ";
		break;
}
}


if ($bdatem <> 0) {
	echo $bdatem." мес.";
}


?>
<br>

</div>



<div class="column">

<b>Пол: </b> 
<?php 
if ($row[48] == 0) {
echo "мужской"; 
} else {
echo "женский";
} 
?>
<br>

</div>


<div class="column">
<?php

echo "<b>Состав / статус семьи: </b>"; 

$tempstr = '';

if ($row[49]<>'0') {
$resulttemp = mysqli_query($link, "SELECT name FROM lib_family WHERE id_family IN ($row[49])") or die("ошибка в выборке");

while ($rowtemp = mysqli_fetch_row($resulttemp)) {

$tempstr .= $rowtemp[0]."; ";

}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;
} else {
echo "нет данных";
}



?>
<br>

</div>


<div class="column">

<b>Инициатор обращения: </b> 
<?php 
if ($row[50] <> '0') {
$resulttemp = mysqli_query($link, "SELECT name FROM lib_init WHERE id_init=$row[50]") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
} else {
echo "нет данных";
} 
?>
<br>

</div>


<div class="column">

<b>Адрес проживания обучающегося: </b> <?php 
if ($row[8] <> '0') {
echo $row[8]; 
} else {
echo "нет данных";
} 
?>
<br>

</div>

<div class="column">

<b>Ф.И.О. законного представителя: </b> <?php echo $row[5]; ?>
<br><br>

</div>


<div class="column">

<b>Образовательная организация: </b> <?php
if ($row[16] <> '0') {
echo $row[16]; 
} else {
echo "нет данных";
}

?>
<br><br>

</div>



<div class="column">

<b>Перечень документов, предоставленных на ПМПК:</b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_docs WHERE id IN ($row[9]) ") or die("ошибка в выборке");
$tempstr = '';
if ($row[10]<>'0') {
	$tempstr .= "копия справки МСЭ и ИПРА; ";
}
if ($row[12]<>'0') {
	$tempstr .= "Медицинское заключение о состоянии здоровья и рекомендациях по организации образовательного процесса (ГИА); ";
}
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;
?>

<br><br>

</div>




<div class="column">

<b>Сведения об образовании обучающегося: </b> 

<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_class WHERE id=$row[21] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>

<br>
<b>Программа обучения: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT gia FROM lib_op WHERE id_op=$row[22] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>

<br>
<b>Уровень образования: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT pname FROM lib_gia_class WHERE id=$row[21] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>

<br>
<b>Форма обучения: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_eduform WHERE id=$row[23] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];


if ($row[25]<>'0') {
?>
<br>
<b>Реализация с применением: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_edurel WHERE id IN ($row[25])") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;
}
?>


<br>
<b>Организация обучения: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_eduorg WHERE id=$row[24] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>

<br><br>


<b>Инвалидность: </b>
<?php
if ($row[10]<>'0') {

echo "МСЭ № ".$row[10]." ";

if (substr($row[11], 0, 4) == '3000') {
	echo " (бессрочно)";
} else {
	echo "на срок до ".strftime("%d.%m.%Y", strtotime($row[11]))."г.";
}

} else {
	echo "нет";
}
?>

<br><br>

<b>Медицинское заключение о состоянии здоровья: </b>
<?php
if ($row[12]<>'0') {

echo "№ ".$row[12]."<br>";

echo "врачебная комиссия от ".strftime("%d.%m.%Y", strtotime($row[13]))."г., выдано ".$row[14];


} else {
	echo "нет";
}
?>

<?php

/*
<br><br>

<b>Код заболевания: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_code WHERE id=$row[15] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>

*/

?>

<br><br>

<b>Координаты ответственного специалиста от образовательной организации: </b>
<br>
<b>Ф.И.О. специалиста: </b>
<?php
if ($row[18]<>'0') {
echo $row[18];
} else {
echo "нет данных";
}
?>
<br>
<b>Должность: </b>
<?php

if ($row[19]<>'0') {
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_ooprof WHERE id=$row[19] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
} else {
echo "нет данных";
}

?>
<br>
<b>Контактный телефон: </b>
<?php
if ($row[20]<>'0') {
echo $row[20];
} else {
echo "нет данных";
}
?>

<?php
if ($row[47]<>'0') {
?>
<br>
<br>
<b>Нуждается в специальных критериях оценивания итогового собеседования по русскому языку</b>

<?php
}
?>




</div>


</div>
</div>




</div>




<script type="text/javascript">



$( document ).ready(function() {
	window.print();

$('.modal')
  .modal()
  .modal('setting', 'closable', false)
;

setTimeout(
  function() 
  {
    $('.modal').modal('show');
  }, 700);




});
</script>


<div class="ui modal ">
  <div class="header ">
    Выберите дальнейшее действие:
  </div>

  <div class="prntmsg">
    
  </div>
  <div class="actions "> 
    
    <?php

    if ($customsigns==1) {
    	$addsigns = "&spsy1=".$spsy1."&spsy2=".$spsy2."&slog=".$slog."&sdef=".$sdef."&ssoc=".$ssoc;
    } else {
    	$addsigns = '';
    }

    ?>


    <a class="ui blue button" href="/lib/tpl/printgiaproto.php?id=<?php 
    echo $getid.$addsigns; ?>">Повторная печать</a>
    <a class="ui grey button floated right" href="/lib/tpl/printgia.php?id=<?php 
    echo $getid.$addsigns; ?>">Белый бланк</a>
    <a class="ui pink button floated right" href="/lib/tpl/printgia.php?id=<?php 
    echo $getid.$addsigns."&pink=1"; ?>">Розовый бланк</a>
    <a class="ui orange button floated right" href="#!" onclick="window.close();">Отмена</a>

  </div>
</div>


</body>
</html>