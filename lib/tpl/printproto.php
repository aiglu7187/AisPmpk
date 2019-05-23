<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="../../semantic/dist/semantic.min.css">
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="../../semantic/dist/semantic.min.js"></script>
</head>

<body>


<?php

$getid = $_REQUEST["id"];
$ptype = $_REQUEST["ptype"];

if(!$getid) {
	die("Нет протокола на печать!");
}


require ('../connect.php');



$result4 = mysqli_query($link, "SELECT * FROM conf LIMIT 1") or die("ошибка в выборке ФИО");
$row4 = mysqli_fetch_row($result4);


if (!$ptype) {

$result = mysqli_query($link, "SELECT pr_num, pr_fio, pr_bdate, pr_regionoo, pr_numoo, pr_inv FROM proto WHERE status=1 AND id_proto=$getid") or die("ошибка в выборке ПРОТОКОЛА");

$row = mysqli_fetch_row($result);

$cdate = date("d.m.Y");

} else {

$result = mysqli_query($link, "SELECT fb_num, fb_fio, fb_bdate, fb_regionoo, fb_numoo, fb_invovz, fb_date FROM fullbase WHERE fb_status=2 AND id=$getid") or die("ошибка в выборке из Заключения");

$row = mysqli_fetch_row($result);

$cdate = strftime("%d.%m.%G", strtotime($row[6]));

}

?>



<div id="mainprnttpl" class="ui stackable " style="position: absolute; width: 797px; padding-left: 20px; padding-right: 10px; font-size: 1.4em; line-height: 1.2em" >


<div class="ui stackable one column grid ">
<div class="row">
<div class="column">

<div align="center">
	<br>
<b><?php 

$head = str_replace("\n", "<br>", $row4[1]);

echo $head; 
?>
<br><br>
ПРОТОКОЛ ОБСЛЕДОВАНИЯ<br><br><br>

</div>

</div>



<div class="column">

<div align="center">

<b>№ <?php echo $row[0];?> от <?php  echo $cdate; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</div>

</div>


<div class="column">
<br><br>
1. Ф.И.О. ребенка: <span> <?php echo $row[1]; ?></span>
<br><br><br>
2. Дата рождения: <?php echo strftime("%d.%m.%G", strtotime($row[2])) ; ?> &nbsp;&nbsp;&nbsp; Возраст: 

<?php

if(strftime("%m", strtotime($row[2])) > strftime("%m", strtotime($cdate)) || strftime("%m", strtotime($row[2])) == strftime("%m", strtotime($cdate)) && strftime("%d", strtotime($row[2])) > strftime("%d", strtotime($cdate))) {
$bdatey = (strftime("%y", strtotime($cdate)) - strftime("%y", strtotime($row[2])) - 1); 
$bdatem = (strftime("%m", strtotime($cdate)) - strftime("%m", strtotime($row[2])) + 12); 
} else {
$bdatey = (strftime("%y", strtotime($cdate)) - strftime("%y", strtotime($row[2])));
$bdatem = (strftime("%m", strtotime($cdate)) - strftime("%m", strtotime($row[2])));
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



</div>



<div class="column">
<br><br>

3. Инвалидность:
<?php

if ($row[5]==1) {
	echo " да ";
} else {
	echo " нет ";
}

?>

&nbsp;&nbsp;&nbsp;
№ __________________________________ 
&nbsp;
срок до «_____»_________20____г.



</div>



<div class="column">
<br><br>

4. Медицинское заключение ВК: да / нет  № _____________________  от «_____»_________20____г.

</div>

<div class="column">
<br><br>

5. Инициатор обращения в ПМПК: самостоятельно / направлен ОО / медицинским учреждением / учреждением социальной защиты / правоохранительными органами/ _____________________________________________________________________________________________________________ _____________________________________________________________________________________________________________


</div>


<div class="column">
<br><br>

6. Адрес регистрации ребенка:<br>
_____________________________________________________________________________________________________________
_____________________________________________________________________________________________________________

</div>


<div class="column">
<br><br>

Регистрация: постоянная / временная

</div>


<div class="column">
<br><br>

7. Семья: полная/неполная/многодетная (детей_______) / мать-одиночка / ребенок из семьи мигрантов / ребенок из двуязычной семьи / ребенок  под опекой / ребенок усыновлен _____________________________________________________________________________________________________________

</div>


<div class="column">
<br><br>

8. Ф.И.О. законного представителя: ________________________________________________________________ _____________________________________________________________________________________________________________<br>
Телефон: ____________________________________________ email: ____________________________________________<br><br>
Ф.И.О. законного представителя: ___________________________________________________________________ _____________________________________________________________________________________________________________<br>
Телефон: ____________________________________________ email: ____________________________________________<br>

</div>


<div class="column">
<br><br>

<b>9. Сведения об образовании</b><br><br>

Наименование ОО: 
<?php

if ($row[4] <> '' || $row[4] <> 0) {
	echo $row[4];
} else {
	echo " _______________________________________";
}

?>

&nbsp;&nbsp;&nbsp;
Округ ОО:

<?php

if ($row[3] <> '' && $row[3] <> 0) {
	$result = mysqli_query($link, "SELECT name FROM lib_regions WHERE status=1 AND id_region=$row[3]") or die("ошибка в выборке ПРОТОКОЛА");

$rowt = mysqli_fetch_row($result);

	echo $rowt[0];
} else {
	echo " _____________________________";
}

?>

<br><br>

Посещал / не посещал / посещает в настоящее время ОО
<br><br>
ОО:	государственная / негосударственная ______________________________________________________
<br><br>
уровень образования: дошкольный; начальный общий; основной общий; средний общий; общий; СПО
<br><br>
группа / класс: _________________________________________________________________________________________
<br><br>
форма обучения: очная; очно-заочная; заочная; семейное; самообразование
<br><br>
образовательная программа ________________________________________________________________________
<br><br>
реализация образовательной программы с применением электронного обучения; дистанционных образовательных технологий: да / нет
<br><br>
организация обучения: в образовательной организации; на дому; в санаторной ОО; <br>в медицинской организации
<br><br>
<b>10. Сведения из истории развития ребенка: (имеется / не имеется)</b> ______________
<br><br>
Беременность по счету ________ Особенности протекания: (токсикоз / резус конфликт / угроза выкидыша)
<br><br>
Перенесенные заболевания во время беременности _____________________________________________________________________________________________________________
<br><br>
Роды _____ на какой неделе _____ самостоятельные / оперативные / родовспоможение
<br><br>
Родовая травма (да/нет) Асфиксия (да/нет) Шкала Апгар ________ Рост ________ Вес ________
<br><br>
<b>Психомоторное развитие до  трех лет:</b> по возрасту / с задержкой / с опережением
<br><br>
Перенесенные заболевания _________________________________________________________________________
<br><br>
Наблюдение специалистов __________________________________________________________________________
<br><br>
<b>Речевое развитие ребенка:</b> по возрасту / с задержкой / с опережением; <br>гуление _____________; лепет _____________; первые слова _____________; речь фразой _____________
<br><br>
Навыки самообслуживания: сформированы / в стадии формирования / <br>не сформированы / грубо нарушены / ____________________________________________________________
<br><br>
<b>Развитие ребенка после трех лет:</b> перенесенные заболевания / травмы / случаи пребывания в больнице / часто болеющий _____________________________________________________________________________________________________________ _____________________________________________________________________________________________________________

</div>



</div>
</div>



<script type="text/javascript">

$('.modal')
  .modal()
  .modal('setting', 'closable', false)
;

$( document ).ready(function() {
	window.print();

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
    
    <a class="ui green button prntconfirm" href="/lib/tpl/printproto.php?id=<?php echo $getid; ?>&ptype=<?php echo $ptype; ?>">Повторная печать</a>
    <a class="ui orange button floated right" href="#!" onclick="window.close();">Закрыть</a>

  </div>
</div>


</script>