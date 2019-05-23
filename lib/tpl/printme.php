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
$customsigns = 0;
$getid = $_REQUEST["id"];
$pinkblank = $_REQUEST["pinkblank"];
$spsy = $_REQUEST["spsy"];
$slog = $_REQUEST["slog"];
$sdef = $_REQUEST["sdef"];
$ssoc = $_REQUEST["ssoc"];

if ($spsy || $slog || $sdef || $ssoc) {
	$customsigns = 1;
}



if(!$getid) {
	die("Нет заключения на печать!");
}


require ('../connect.php');


$result4 = mysqli_query($link, "SELECT * FROM conf LIMIT 1") or die("ошибка в выборке ФИО");
$row4 = mysqli_fetch_row($result4);


$result = mysqli_query($link, "SELECT fb_pinknumber FROM fullbase WHERE id=$getid LIMIT 1") or die("ошибка в выборке ЗАКЛЮЧЕНИЯ");
$row = mysqli_fetch_row($result);


if ($pinkblank == 1 && $row[0] == 0) {

$pinknum = '';


$result = mysqli_query($link, "SELECT * FROM pnumber ORDER BY id DESC LIMIT 1") or die("ошибка выборки номера");

$row = mysqli_fetch_row($result);

$row[2] += 1;

for ($i=5-strlen($row[2]); $i > 0; $i--) { 
	$pinknum .= '0';
}


$pinknum .= $row[2]." ".$row4[2].substr($row[1], -2);


mysqli_query($link, "UPDATE pnumber SET pcnumber='{$row[2]}' WHERE id='{$row[0]}'") OR die("NIEN! 3");


mysqli_query($link, "UPDATE fullbase SET fb_pinknumber='{$pinknum}' WHERE id='{$getid}' LIMIT 1") or die("что-то пошло не так");

}






$result = mysqli_query($link, "SELECT * FROM fullbase WHERE fb_status=2 AND id=$getid LIMIT 1") or die("ошибка в выборке ЗАКЛЮЧЕНИЯ");

$row = mysqli_fetch_row($result);









?>



<div id="mainprnttpl" class="ui stackable " style="position: absolute; width: 797px; padding-left: 10px; padding-right: 10px; font-size: 1.1em" >


<div class="ui stackable one column grid ">
<div class="row">
<div class="column">






<div align="center">
<div <?php if($row4[3]==1) { echo "style='color: #FFF; opacity: 0'"; } ?> >
	<br>
<b><?php 

$head = str_replace("\n", "<br>", $row4[1]);

echo $head; 
?>
<br><br>
</div>
<div>
ЗАКЛЮЧЕНИЕ
</div>

<?php

if ($row[7] <> 11 && $row[1]<>1) {

?>

<div align="center" style="border: solid; border-width: 1px; padding-top: 1px; padding-bottom: 1px; padding-left: 12px; padding-right: 12px;  float: right; position: relative; <?php if($row4[4]==0) { echo "color: #FFF; opacity: 0"; } ?>">

<?php 

if ($row[47]=='0') {

if ($row[6] > 0) {
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
/*
	if ($row[7]<9 && ($row[1] == 2 || $row[1] == 4)) {

	if (strripos($row[8], "7") || $row[8] == 7 || $row[7]==5 || $row[7]==7) {
		echo ".2";
	} elseif (strripos($row[8], "9") || $row[8]==9) {
		echo ".3";
	} else {
		echo ".1";
	}

	}
*/
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
/*
	if ($row[7]<9 && ($row[1] == 2 || $row[1] == 4)) {

	if (strripos($row[8], "7") || $row[8] == 7 || $row[7]==5 || $row[7]==7) {
		echo ".2";
	} elseif (strripos($row[8], "9") || $row[8]==9) {
		echo ".3";
	} else {
		echo ".1";
	}
}
*/
}


if ($row[1]==3) {
	echo ".".$row[10];
}

} else {
	if ($row[6]<>0) {
	echo "И ".$row[47];
	} else {
	echo "О ".$row[47];	
	} 
}

?>
</b>
</div>


<?php

} else {

?>

<div>
&nbsp;<br></b>
</div>

<?php


}
 //end if

?>


</div>



</div>




<div class="column">

<div align="center">
	<br>
<?php 

if($row[7] == '11') {
if ($row[25]==0 && $row[26]==0 && $row[27]==0 && $row[28]==0 ) {
	//echo "<b>о создании специальных условий для получения образования обучающемуся с ограниченными возможностями здоровья, инвалидностью</b>";
} elseif ($row[1]<>1) {

	if ($row[50]==1) {
	echo "<b>о предоставлении психолого-педагогической, медицинской и социальной помощи и организации специального педагогического подхода к обучающемуся с девиантным поведением, испытывающему трудности в освоении основных общеобразовательных программ, развитии и социальной адаптации</b>";
	} else {
	echo "<b>о предоставлении психолого-педагогической, медицинской и социальной помощи обучающемуся, испытывающему трудности в освоении основных общеобразовательных программ, развитии и социальной адаптации</b>";
	}
}
} else {
if ($row[50]==1) {
echo "<b>о создании специальных условий для получения образования и организации специального педагогического подхода к обучающемуся с девиантным поведением с ограниченными возможностями здоровья, инвалидностью</b>";
} else {
echo "<b>о создании специальных условий для получения образования обучающемуся с ограниченными возможностями здоровья, инвалидностью</b>";
}
}
?>
</div>

</div>


<div class="column">

<div align="center">
<b>№ <?php echo $row[2];?> от <?php echo strftime("%d.%m.%Y", strtotime($row[3])) ; ?></b>

</div>

</div>


<div class="column">
<br><br>
<b>Ф.И.О. ребенка: </b><span style="font-size: 1.2em;"> <?php echo $row[4]; ?></span>
<br><br>
<b>Дата рождения: </b><?php echo strftime("%d.%m.%Y", strtotime($row[5])) ; ?>
<br>

</div>


<div class="column">
<br>
<?php 

if($row[7] <> '11') {
echo "Предоставление специальных условий образования обучающемуся с ограниченными возможностями здоровья:";
}

?>

</div>

<div class="column">

<ul>

<li>
	<b>Образовательная программа: </b>

	<?php

	if ($row[8] <> 0) {

		$prntaoop = " с учетом психофизических особенностей";

		if (strlen($row[8])>1) {
			$pdopaoop = explode(",", $row[8]);
		} else {
				$pdopaoop[0] = $row[8];
		}
		
		for ($i=0; $i < count($pdopaoop); $i++) { 

			

			$tempresult = mysqli_query($link, "SELECT zakname FROM lib_op WHERE status=1 AND id_op = $pdopaoop[$i]") or die("ошибка в выборке обр прог");
			$temprow = mysqli_fetch_row($tempresult);



			$prntaoop .= " ".$temprow[0].",";
			
		}

		$prntaoop = substr($prntaoop, 0, strlen($prntaoop)-1);

	} else {
		$prntaoop = "";
	}


if(strftime("%m", strtotime($row[5])) > strftime("%m", strtotime($row[3])) || strftime("%m", strtotime($row[5])) == strftime("%m", strtotime($row[3])) && strftime("%d", strtotime($row[5])) > strftime("%d", strtotime($row[3]))) {
$bdate = (strftime("%y", strtotime($row[3])) - strftime("%y", strtotime($row[5])) - 1); 
} else {
$bdate = (strftime("%y", strtotime($row[3])) - strftime("%y", strtotime($row[5])));
}



switch ($row[1]) {
	case '1':
		echo "-";
		break;

	case '2':
		$tempresult = mysqli_query($link, "SELECT dname FROM lib_op WHERE status=1 AND id_op = $row[7]") or die("ошибка в выборке обр прог");
		$temprow = mysqli_fetch_row($tempresult);
		echo $temprow[0].$prntaoop;

		
		

		if ($bdate < 3) {
			echo " (c трёх лет)";
		}

		break;

	case '3':
		$tempresult = mysqli_query($link, "SELECT sname FROM lib_op WHERE status=1 AND id_op = $row[7]") or die("ошибка в выборке обр прог");
		$temprow = mysqli_fetch_row($tempresult);
		
		if($row[7] == 9) {
			$temprow[0] .= " (интеллектуальными нарушениями)";
		}

		echo $temprow[0].$prntaoop;

		break;

	case '4':
		$tempresult = mysqli_query($link, "SELECT sname FROM lib_op WHERE status=1 AND id_op = $row[7]") or die("ошибка в выборке обр прог");
		$temprow = mysqli_fetch_row($tempresult);
		echo $temprow[0].$prntaoop;
		break;

	case '5':
		$tempresult = mysqli_query($link, "SELECT spname FROM lib_op WHERE status=1 AND id_op = $row[7]") or die("ошибка в выборке обр прог");
		$temprow = mysqli_fetch_row($tempresult);
		echo $temprow[0].$prntaoop;
		if ($row[7] <> 9) {
		echo "<br> - Программа подготовки квалифицированных рабочих, служащих (ППКРС)<br> - Программа подготовки специалистов среднего звена (ППССЗ)";
		}
		break;


}


	?>
</li>

<?php 

if ($row[1] == 5 && $row[7] == 9 ) {

// СПО С УО НЕ ПИСАТЬ НИЧЕГО

} else {

if ($row[9] <> 0) {

?>
<li>
	<b>Уровень образования: </b> 
<?php

$tempresult = mysqli_query($link, "SELECT name FROM lib_edulevel WHERE status=1 AND fb_edulevel = $row[9]") or die("ошибка в выборке обр прог");
$temprow = mysqli_fetch_row($tempresult);
echo $temprow[0];

?> 
</li>

<?php  

}  

if ($row[1] == 3) { 

$tempresult = mysqli_query($link, "SELECT name, fb_edulevelvarcase FROM lib_edulevelvartime WHERE status=1 AND fb_edulevelvar = $row[10] AND fb_aoop = $row[7] AND fb_edulevelvarcase = $row[13]") or die("ошибка в выборке обр прог");
$temprow = mysqli_fetch_row($tempresult);

?>

<li>
	<b>Вариант и срок реализации программы: </b>Вариант 
<?php 

if ($row[7] == 9) {
	echo $row[10];
} else {
	echo $row[7].".".$row[10];
	if ($temprow[1] > 0) {
		switch ($temprow[1]) {
			case '1':
				echo " (I отделение)";
				break;
			
			case '2':
				echo " (II отделение)";
				break;
		}
	}
}

echo " - ".$temprow[0];

}

?>

</li>


<?php 

if ($row[1] > 2) { 

?>

<li>
	<b>Реализация образовательной программы с применением электронного обучения и дистанционных образовательных технологий: </b>при отсутствии медицинских противопоказаний
</li>

<?php 

}




if (($row[1] <> 5 || $row[7] <> 11) && $row[15] <> 0) { 

?>

<li>
	<b>Предоставление услуг ассистента (помощника):</b>

<?php

	

	
if (strlen($row[15])>1) {
	$dopassist = explode(",", $row[15]);
} else {
	$dopassist[0] = $row[15];
}

$prntassist = "";


for ($i=0; $i < count($dopassist); $i++) { 
	$tempresult = mysqli_query($link, "SELECT name FROM lib_assist WHERE status=1 AND fb_assist = $dopassist[$i]") or die("ошибка в выборке assist");
	$temprow = mysqli_fetch_row($tempresult);

	$prntassist .= " ".$temprow[0].";";
	
}

$prntassist = substr($prntassist, 0, strlen($prntassist)-1);

echo $prntassist;
	

?>

</li>

<?php 

}



if ($row[7] <> 11 && $row[16] <> 0) { 

?>

<li>
	<b>Специальные методы обучения: </b>

<?php	

if ($row[1] == 1) {
	echo "требуются";
} else {
	echo "в соответствии с программой";
}


?>

</li>

<?php 

}




if ($row[7] <> 11 && $row[1] > 2 && $row[17] <> 0) { 

?>

<li>
	<b>Специальные учебники: </b>

<?php	

if ($row[1] > 3) {
	echo "в соответствии с программой";
} else {
	
$tempresult = mysqli_query($link, "SELECT name FROM lib_edubook WHERE status=1 AND fb_aoop = $row[7] AND fb_edulevelvar = $row[10]") or die("ошибка в выборке bks");
$temprow = mysqli_fetch_row($tempresult);

echo $temprow[0];

}


?>

</li>

<?php 

}




if ($row[7] <> 11 && $row[18] <> 0) { 

?>

<li>
	<b>Специальные учебные пособия: </b>

<?php	


switch ($row[1]) {
	case '1':
		echo "требуются";
		break;

	case '3':
		$tempresult = mysqli_query($link, "SELECT name FROM lib_edunotes WHERE status=1 AND fb_aoop = $row[7] AND fb_edulevelvar = $row[10]") or die("ошибка в выборке notes");
		$temprow = mysqli_fetch_row($tempresult);

		echo $temprow[0];
		break;

	default:
		echo "в соответствии с программой";
		break;
}


?>

</li>

<?php 

}



if ($row[7] <> 11 && $row[19] <> 0) {  

?>

<li>
	<b>Специальные технические средства обучения: </b>

<?php	


if ($row[1] <> 3) {
	echo "требуются";
} else {
	
	$tempresult = mysqli_query($link, "SELECT name FROM lib_edutech WHERE status=1 AND fb_aoop = $row[7] AND fb_edulevelvar = $row[10]") or die("ошибка в выборке notes");
	$temprow = mysqli_fetch_row($tempresult);

	echo $temprow[0];

}


?>

</li>

<?php 

}

if ($row[1] == 5 && $row[7]<>11) { 

?>

<li>
	<b>Адаптационные дисциплины: </b>в соответствии с программой
</li>

<?php

if ($row[21] == 1) {
?>
<li>
	<b>Безбарьерная архитектурная среда: </b>требуется
</li>

<?php 
}
?>
<li>
	<b>Специальная организация рабочего места: </b>требуется
</li>

<?php

}




if ($row[7] <> 11 || $row[1] == 5) { 

echo "<li><b>Организация пространства: </b>";

switch ($row[1]) {
	case '1':
		echo "требуется";
		break;
	
	case '3':
		if ($row[7] == 9) {
			echo "в соответствии с ФГОС УО";
		} else {
			echo "в соответствии с ФГОС НОО ОВЗ";
		}

		break;

	default:
		echo "в соответствии с ФГОС";
		break;
}

echo "</li>";

}





if ($row[24] <> 0) { 

?>

<li>
	<b>Тьюторское сопровождение обучающихся:</b>

<?php	

	
if (strlen($row[24])>1) {
	$doptutor = explode(",", $row[24]);
} else {
	$doptutor[0] = $row[24];
}

$doptutorprint = "";


for ($i=0; $i < count($doptutor); $i++) { 
	$tempresult = mysqli_query($link, "SELECT name FROM lib_tutor WHERE status=1 AND fb_tutor = $doptutor[$i]") or die("ошибка в выборке tutor");
	$temprow = mysqli_fetch_row($tempresult);

	$doptutorprint .= " ".$temprow[0].";";
	
}

$doptutorprint = substr($doptutorprint, 0, strlen($doptutorprint)-1);

echo $doptutorprint;


?>

</li>

<?php 

}

}
?>

</ul>


</div>










<div class="column">

<?php

if ($row[1]==5) {
	echo "Психолого-педагогическое сопровождение:";
} elseif($row[25]==0 && $row[26]==0 && $row[27]==0 && $row[28]==0) {

	echo "<b>Не нуждается в создании специальных условий для получения образования обучающемуся с ограниченными возможностями здоровья, инвалидностью</b>";

} else {
	echo "Направления коррекционной работы:";
}

?>


</div>

<div class="column">

<ul>


<?php

if($row[25] <> 0) {



if ($row[1]==5 && $row[7]<>9) {
	echo "<li><b>Педагог-психолог (специальный психолог): </b>";
} else {
	echo "<li><b>Педагог-психолог: </b>";
}

if (strlen($row[25])>1) {
	$doppsy = explode(",", $row[25]);
} else {
	$doppsy[0] = $row[25];
}

$doppsyprint = "";


for ($i=0; $i < count($doppsy); $i++) { 
	$tempresult = mysqli_query($link, "SELECT name FROM lib_workpsy WHERE status=1 AND fb_workpsy = $doppsy[$i]") or die("ошибка в выборке workpsy");
	$temprow = mysqli_fetch_row($tempresult);

	$doppsyprint .= " ".$temprow[0].",";
	
}

$doppsyprint = substr($doppsyprint, 0, strlen($doppsyprint)-1);

echo $doppsyprint."</li>";


}






if($row[26] <> 0) {




	echo "<li><b>Учитель-логопед: </b>";


if (strlen($row[26])>1) {
	$doplog = explode(",", $row[26]);
} else {
	$doplog[0] = $row[26];
}

$doplogprint = "";


for ($i=0; $i < count($doplog); $i++) { 
	$tempresult = mysqli_query($link, "SELECT name FROM lib_worklog WHERE status=1 AND fb_worklog = $doplog[$i]") or die("ошибка в выборке worklog");
	$temprow = mysqli_fetch_row($tempresult);

/*
	if(strripos($temprow[0], "звукопроизношения, развитие фонематических") && $bdate < 5) {
		$templog = " (c пяти лет)";
	} else {
		$templog = "";
	}

	$doplogprint .= " ".$temprow[0].$templog.",";
*/
	$doplogprint .= " ".$temprow[0].",";
}

$doplogprint = substr($doplogprint, 0, strlen($doplogprint)-1);

echo $doplogprint."</li>";


}




if($row[27] <> 0) {

if ($row[7]<3 || $row[8]==1 || $row[8]==2 || strripos($row[8], "1") || strripos($row[8], "2")) {
	$tempdefval1 = 1;
} else {
	$tempdefval1 = 0;
}

if ($row[7]==3 || $row[7]==4 || strripos($row[8], "3") || strripos($row[8], "4") || $row[8]==3 || $row[8]==4) {
	$tempdefval2 = 5;
} else {
	$tempdefval2 = 0;
}

$tempdefval = $tempdefval1 + $tempdefval2;

switch ($tempdefval) {
	case '1':
		$tempdef = " (сурдопедагог)";
		break;

	case '5':
		$tempdef = " (тифлопедагог)";
		break;

	case '6':
		$tempdef = " (сурдотифлопедагог)";
		break;

	default:
		$tempdef = "";
		break;
}


echo "<li><b>Учитель-дефектолог".$tempdef.": </b>";


if (strlen($row[27])>1) {
	$dopdef = explode(",", $row[27]);
} else {
	$dopdef[0] = $row[27];
}

$dopdefprint = "";


for ($i=0; $i < count($dopdef); $i++) { 
	$tempresult = mysqli_query($link, "SELECT name FROM lib_workdef WHERE status=1 AND fb_workdef = $dopdef[$i]") or die("ошибка в выборке workpsy");
	$temprow = mysqli_fetch_row($tempresult);

	$dopdefprint .= " ".$temprow[0].",";
	
}

$dopdefprint = substr($dopdefprint, 0, strlen($dopdefprint)-1);

echo $dopdefprint."</li>";


}



if($row[28] <> 0 || ($row[7] < 11 && $row[1]>2)) {



if ($row[1]==5) {
	echo "<li><b>Социальный педагог (социальный работник): </b>";
} else {
	echo "<li><b>Социальный педагог: </b>";
}

if ($row[7] < 11 && $row[1]>2) {
	echo "координация взаимодействия субъектов образовательного процесса";
	if ($row[28] <> 0) {
		echo ", ";
	}
}


if (strlen($row[28])>1) {
	$dopsoc = explode(",", $row[28]);
} else {
	$dopsoc[0] = $row[28];
}

$dopsocprint = "";


for ($i=0; $i < count($dopsoc); $i++) { 
	$tempresult = mysqli_query($link, "SELECT name FROM lib_worksoc WHERE status=1 AND fb_worksoc = $dopsoc[$i]") or die("ошибка в выборке soc");
	$temprow = mysqli_fetch_row($tempresult);

	$dopsocprint .= " ".$temprow[0].",";
	
}

$dopsocprint = substr($dopsocprint, 0, strlen($dopsocprint)-1);

echo $dopsocprint."</li>";


}

if (($row[1] == 4) && ($row[29] == 3 || $row[29] >= 5 )) {

echo "<li><b>Обучение по индивидуальному учебному плану с учетом особенностей и образовательных потребностей обучающегося, содержащему меры компенсирующего воздействия по предметам, по которым академическая задолженность не была ликвидирована; организация внеурочной деятельности, ориентированной на обеспечение индивидуальных потребностей обучающегося</b></li>";
}


?>


</ul>

</div>


<?php
/*

if($row[6] > 0) {

?>

<div class="column">

<ul>
<li>
<b>Другие условия: </b>

<?php

if ($row[29] >= 0) {
	echo "в соответствии с индивидуальной программой реабилитации (абилитации) инвалида";
} else {
	$tempresult = mysqli_query($link, "SELECT name FROM lib_otherspec WHERE status=1 AND fb_otherspec = $row[29]") or die("ошибка в выборке inv");
	$temprow = mysqli_fetch_row($tempresult);
	echo $temprow[0];
}

?>


</li>

</ul>

</div>



<?php

}
*/
?>
<div  id="breaker1" style="position:relative; ">
&nbsp;
</div>

<?php
if($row[30] <> 0) {

?>



<div class="column">
<br>

<?php

$tempresult = mysqli_query($link, "SELECT name FROM lib_time WHERE status=1 AND fb_time = $row[30]") or die("ошибка в выборке inv");
$temprow = mysqli_fetch_row($tempresult);

if ($row[30]==1 || strripos($temprow[0], "весь период обучения") ) {
	echo "<b>Срок проведения обследования с целью подтверждения ранее данных комиссией рекомендаций: </b>".$temprow[0];
} else {
	echo "<b>Срок проведения обследования с целью уточнения/изменения ранее данных комиссией рекомендаций: </b>".$temprow[0];
}

?>

</div>

<?php

}

?>


</div>


</div>

<div id="breaker2" style="position:relative; ">
&nbsp;
</div>

<div class="ui three column grid " id="signs">
<div class="row">

<div class="eight  wide column">
<b><br>Руководитель ПМПК 
<br><br>

<?php 
if ($customsigns == 1) {

if ($spsy > 0) {
?>
Педагог-психолог
<br><br>
<?php
}


} elseif ($row[32]>0) {

?>
Педагог-психолог
<br><br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($slog > 0) {
?>
Учитель-логопед
<br><br>
<?php
}


} elseif ($row[33]>0) {

?>
Учитель-логопед
<br><br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($sdef > 0) {
?>
Учитель-дефектолог
<br><br>
<?php
}


} elseif ($row[34]>0) {

?>
Учитель-дефектолог
<br><br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($ssoc > 0) {
?>
Социальный педагог
<br><br>
<?php
}


} elseif ($row[35]>0) {

?>
Социальный педагог
<br><br>

<?php
}
?>

</b>

</div>



<div class="eight  wide column" align="left">
<br>
<?php

$tempresult = mysqli_query($link, "SELECT name FROM lib_sboss WHERE status=1") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
echo $temprow[0];

?>

<br><br>

<?php
if ($customsigns == 1) {

if ($spsy > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$spsy ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php

}


} elseif ($row[32]>0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[32] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php
}

if ($customsigns == 1) {

if ($slog > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$slog ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php

}


} elseif ($row[33]>0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[33] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php

}

if ($customsigns == 1) {

if ($sdef > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$sdef ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php

}


} elseif ($row[34]>0) {

$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[34] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php

}

if ($customsigns == 1) {

if ($ssoc > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$ssoc ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php

}


} elseif ($row[35]>0) {

$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[35] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br><br>

<?php 
}
?>

</div>


<div class="two wide column" style="position: relative; right:80px">
<br>
__________________________________
<br><br>




<?php 
if ($customsigns == 1) {

if ($spsy > 0) {
?>
__________________________________
<br><br>
<?php
}


} elseif ($row[32]>0) {

?>
__________________________________
<br><br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($slog > 0) {
?>
__________________________________
<br><br>
<?php
}


} elseif ($row[33]>0) {

?>
__________________________________
<br><br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($sdef > 0) {
?>
__________________________________
<br><br>
<?php
}


} elseif ($row[34]>0) {

?>
__________________________________
<br><br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($ssoc > 0) {
?>
__________________________________
<br><br>
<?php
}


} elseif ($row[35]>0) {

?>
__________________________________
<br><br>

<?php
}
?>



</div>
</div>

</div>

<div id="breaker3" style="position:relative; ">
&nbsp;
</div>




<?php

if ($row[55]<>'' || $row[55]<>'0') {

?>

<div class="ui stackable three column grid ">

<?php

$result5 = mysqli_query($link, "SELECT first_name, second_name, third_name, other_prof FROM users WHERE id_users IN ('$row[55]')") or die("ошибка в выборке ФИО");
while ($row5 = mysqli_fetch_row($result5)) {

?>

<div class="row">

<div class="column">
<b>
<?php
echo $row5[3];
?>
</b>
</div>

<div class="column">

<?php
echo $row5[1].' '.mb_substr($row5[0],0,1,"UTF-8").'. '.mb_substr($row5[2],0,1,"UTF-8").'.';
?>

</div>

<div class="column" >
<div style="right: 80px; position: relative;">
<?php
echo "__________________________________";
?>
</div>
</div>

</div>

<?php

}

?>

</div>

<?php
}

?>






<div class="ui stackable four column grid ">

<div class="row">

<div align="center" class="right floated column">

<b>М.П.</b>

</div>
</div>
</div>





<div id="breaker4" style="position:relative; ">
&nbsp;
</div>


<div class="column">

<b>Дата выдачи рекомендаций ПМПК: </b>_________________________

</div>


<div id="breaker5" style="position:relative; ">
&nbsp;
</div>


<div class="column">
<br>

С рекомендациями ознакомлен(а). Оригинал получен.<br><br>

_________________________________ &nbsp;&nbsp;&nbsp; (________________________________________________________________________________)<br>
<span style="padding-left: 10%">(подпись)</span><span style="padding-left: 40%">(расшифровка)</span>


</div>




</div>



<?php
if ($row4[5]== 1 && $pinkblank == 1) {
	echo '<div style="position: absolute; top: 1145px; right: 40px">';
	echo $row[46];
	echo "</div>";
}


?>










<script type="text/javascript">


function pinkblank(idp) {

$.ajax({
    type: "POST",
    data:{ "chid": idp }, 
    url: "/lib/pinkblank.php",
    dataType: "html",            
    success: function(response){
        window.close();
    }

});

}


</script>


<div class="ui modal ">
  <div class="header ">
    Выберите дальнейшее действие:
  </div>

  <div class="prntmsg">
    
  </div>
  <div class="actions "> 
    
    <a class="ui blue button prntconfirm" href="/lib/tpl/printme.php?id=<?php 
    echo $getid; 
    if ($customsigns == 1) {
    	if ($spsy) {
    		echo "&spsy=".$spsy;
    	}
    	if ($slog) {
    		echo "&slog=".$slog;
    	}
    	if ($sdef) {
    		echo "&sdef=".$sdef;
    	}
    	if ($ssoc) {
    		echo "&ssoc=".$ssoc;
    	}
    }
    if ($pinkblank==1) {
    		echo "&pinkblank=1";
    	}
    ?>">Повторная печать</a>
    <a class="ui green button floated right" href="#!" <?php if($pinkblank==1) { ?> onclick="pinkblank(<?php echo $getid; ?>)"  <?php } else { ?> onclick="window.close();" <?php } ?> >Успешно распечатано</a>
    <a class="ui orange button floated right" href="#!" onclick="window.close();">Отмена</a>

  </div>
</div>


<script type="text/javascript">

$( document ).ready(function() {
breakme1 = $("#breaker1").offset();
breakme2 = $("#breaker2").offset();
breakme3 = $("#breaker3").offset();
breakme4 = $("#breaker4").offset();
breakme5 = $("#breaker5").offset();


if (breakme1.top > 1000 && breakme1.top < 1200) {
	$("#breaker1").css("height", 1200 - breakme1.top);

} 
if (breakme2.top > 1100 && breakme2.top < 1200) {
	$("#breaker2").css("height", 1200 - breakme2.top);

} 
if (breakme3.top > 1000 && breakme3.top < 1200) {
	$("#breaker3").css("height", 1200 - breakme3.top);

} 
if (breakme4.top > 1000 && breakme4.top < 1200) {
	$("#breaker4").css("height", 1200 - breakme4.top);

} 
if (breakme5.top > 1000 && breakme5.top < 1200) {
	$("#breaker5").css("height", 1200 - breakme5.top);

} 


	

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

</body>
</html>
