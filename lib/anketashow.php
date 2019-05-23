<?php

$getid = $_REQUEST["id"];

if(!$getid) {
	die("Нет данных!");
}


require ('tpl/connect.php');

$result3 = mysqli_query($link, "SELECT fb_fio, fb_bdate FROM fullbase WHERE fb_status=2 AND id=$getid") or die("ошибка в выборке ");

$row3 = mysqli_fetch_row($result3);


?>

<div class="ui tabular menu">

<?php

$fio = trim($row3[0]);

$result2 = mysqli_query($link, "SELECT * FROM fullbase WHERE fb_fio LIKE '{$fio}' AND fb_bdate='{$row3[1]}' ORDER BY fb_date DESC ") or die("ошибка в выборке данных в таблице 4");

$j=0;

while ($row2 = mysqli_fetch_row($result2)) {

$date = new DateTime($row2[3]);


if ($row2[0]==$getid) {

echo '<div class="item active" data-tab="tab-'.$j.'"><span style="color:green">'.$date->format('d.m.Y').'</span></div>';
} else {

echo '<div class="item" data-tab="tab-'.$j.'">'.$date->format('d.m.Y').'</div>';

 }

$j++;

}


$rezcount2 = mysqli_query($link, "SELECT COUNT(*) FROM archive WHERE ar_fio LIKE '{$fio}' AND ar_bdate='{$row3[1]}' ") or die("ошибка в выборке данных в таблице 6");
$row_cnt2 = mysqli_fetch_row($rezcount2);


if ($row_cnt2[0]>0) {

echo "<div class='item'><i style='color:purple'>Архив:</i></div>";

$result4 = mysqli_query($link, "SELECT * FROM archive WHERE ar_fio LIKE '{$fio}' AND ar_bdate='{$row3[1]}' ORDER BY ar_date DESC ") or die("ошибка в выборке данных в таблице 7");


while ($row4 = mysqli_fetch_row($result4)) {

$date = new DateTime($row4[1]);

echo '<div class="item" data-tab="tab-'.$j.'">'.$date->format('d.m.Y').'</div>';


$j++;

}

}

?>


</div>





<?php


$result = mysqli_query($link, "SELECT * FROM fullbase WHERE fb_fio LIKE '{$fio}' AND fb_bdate='{$row3[1]}' ORDER BY fb_date DESC ") or die("ошибка в выборке данных в таблице 5");

$j=0;

while ($row = mysqli_fetch_row($result)) {


if ($row[0]==$getid) {

echo '<div class="ui tab active" data-tab="tab-'.$j.'">';
} else {

echo '<div class="ui tab" data-tab="tab-'.$j.'">';
}

$j++;

if ($row[44]>0 || $row[45]>0) {

	$ribbonname = '';

	if ($row[44]>0) {
		$result2 = mysqli_query($link, "SELECT name FROM lib_comtype WHERE fb_comtype=$row[44]") or die("ошибка в выборке ");
		$row2 = mysqli_fetch_row($result2);
		$ribbonname .= $row2[0];
	}

	if ($row[45]>0) {
		$result2 = mysqli_query($link, "SELECT name FROM lib_roadmap WHERE fb_roadmap=$row[45]") or die("ошибка в выборке ");
		$row2 = mysqli_fetch_row($result2);
		$ribbonname .= " (".$row2[0].")";
	}

	echo '<div style="position:relative; right: 16px "><a class="ui blue ribbon label">'.ucfirst($ribbonname).'</a></div>';
}




echo "<h4><b style='color: #3333cc'>№</b> ".$row[2]." <b style='color: #3333cc'>от</b> ".strftime("%d.%m.%G", strtotime($row[3]));
if ($row[38]==1) {
	echo " (консультация)";
} 
echo "</h4>";
?>



<h5>Протокол:</b></h5>

<ul>

<?php



echo "<li><b style='color: #3333cc'>Ф.И.О. ребенка:</b> ";
echo $row[4];
echo "</li>";

echo "<li><b style='color: #3333cc'>Дата рождения:</b> ";
echo strftime("%d.%m.%G", strtotime($row[5]));
echo "</li>";


if ($row[37]<>'') {
echo "<li><b style='color: #3333cc'>Наименование ОО:</b> ";
echo $row[37];
echo "</li>";
}

if ($row[39]==1) {
echo "<li><b style='color: #3333cc'>Рекомендовано дообследование:</b> да";
echo "</li>";
}

if ($row[40]==1) {
echo "<li><b style='color: #3333cc'>Неполный пакет документов (долги):</b> да";
echo "</li>";
}


if ($row[38]==0) {
?>

</ul>



<h5>Заключение:</b></h5>

<ul>

<?php

}

if ($row[38]==0) {
echo "<li><b style='color: #3333cc'>Код:</b> ";

if ($row[47] <> '0') {

	if ($row[6]<>0) {
	echo "И ".$row[47];
	} else {
	echo "О ".$row[47];	
	} 

//echo "И ".$row[47];

} else {

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

echo "</li>";

}


}






if ($row[38]==0) {
echo "<li><b style='color: #3333cc'>Образовательная программа:</b> ";
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
echo "</li>";

}




if ($row[9] <> 0) {
echo "<li><b style='color: #3333cc'>Уровень образования:</b> ";
$tempresult = mysqli_query($link, "SELECT name FROM lib_edulevel WHERE status=1 AND fb_edulevel = $row[9]") or die("ошибка в выборке обр прог");
$temprow = mysqli_fetch_row($tempresult);
echo $temprow[0];
echo "</li>";
}


if ($row[1] == 3) { 

$tempresult = mysqli_query($link, "SELECT name, fb_edulevelvarcase FROM lib_edulevelvartime WHERE status=1 AND fb_edulevelvar = $row[10] AND fb_aoop = $row[7] AND fb_edulevelvarcase = $row[13]") or die("ошибка в выборке обр прог");
$temprow = mysqli_fetch_row($tempresult);
echo "<li><b style='color: #3333cc'>Вариант и срок реализации программы:</b> Вариант";
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
echo "</li>";
}


if ($row[1] > 2) { 
echo "<li><b style='color: #3333cc'>Реализация образовательной программы с применением электронного обучения и дистанционных образовательных технологий:</b> при отсутствии медицинских противопоказаний";
echo "</li>";
}

if (($row[1] <> 5 || $row[7] <> 11) && $row[15] <> 0) { 
echo "<li><b style='color: #3333cc'>Предоставление услуг ассистента (помощника):</b> ";
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
echo "</li>";
}

if ($row[7] <> 11 && $row[16] <> 0) { 
echo "<li><b style='color: #3333cc'>Специальные методы обучения:</b> ";
if ($row[1] == 1) {
	echo "требуются";
} else {
	echo "в соответствии с программой";
}
echo "</li>";
}

if ($row[7] <> 11 && $row[1] > 2 && $row[17] <> 0) { 
echo "<li><b style='color: #3333cc'>Специальные учебники:</b> ";
if ($row[1] > 3) {
	echo "в соответствии с программой";
} else {
	
$tempresult = mysqli_query($link, "SELECT name FROM lib_edubook WHERE status=1 AND fb_aoop = $row[7] AND fb_edulevelvar = $row[10]") or die("ошибка в выборке bks");
$temprow = mysqli_fetch_row($tempresult);

echo $temprow[0];

}
echo "</li>";
}

if ($row[7] <> 11 && $row[18] <> 0) { 
echo "<li><b style='color: #3333cc'>Специальные учебные пособия:</b> ";
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
echo "</li>";
}

if ($row[7] <> 11 && $row[19] <> 0) {  
echo "<li><b style='color: #3333cc'>Специальные технические средства обучения:</b> ";
if ($row[1] <> 3) {
	echo "требуются";
} else {
	
	$tempresult = mysqli_query($link, "SELECT name FROM lib_edutech WHERE status=1 AND fb_aoop = $row[7] AND fb_edulevelvar = $row[10]") or die("ошибка в выборке notes");
	$temprow = mysqli_fetch_row($tempresult);

	echo $temprow[0];

}
echo "</li>";
}


if ($row[1] == 5) { 
echo "<li><b style='color: #3333cc'>Адаптационные дисциплины:</b> в соответствии с программой";
echo "</li>";

if ($row[21] == 1) {
echo "<li><b style='color: #3333cc'>Безбарьерная архитектурная среда:</b> требуется";
echo "</li>";
}

echo "<li><b style='color: #3333cc'>Специальная организация рабочего места:</b> требуется";
echo "</li>";
}


if (($row[7] <> 11 || $row[1] == 5) && $row[38]==0) { 
echo "<li><b style='color: #3333cc'>Организация пространства:</b> ";
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
echo "<li><b style='color: #3333cc'>Тьюторское сопровождение:</b> ";
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
echo "</li>";

}

echo "</ul>";




if ($row[1]==5) {
	echo "Психолого-педагогическое сопровождение:";
} elseif ($row[25] <> 0 || $row[26] <> 0 || $row[27] <> 0 || $row[28] <> 0) {
	echo "Направления коррекционной работы:";
}

echo "<ul>";

if($row[25] <> 0) {



if ($row[1]==5) {
	echo "<li><b style='color: #3333cc'>Педагог-психолог (специальный психолог):</b> ";
} else {
	echo "<li><b style='color: #3333cc'>Педагог-психолог:</b> ";
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




	echo "<li><b style='color: #3333cc'>Учитель-логопед:</b> ";


if (strlen($row[26])>1) {
	$doplog = explode(",", $row[26]);
} else {
	$doplog[0] = $row[26];
}

$doplogprint = "";


for ($i=0; $i < count($doplog); $i++) { 
	$tempresult = mysqli_query($link, "SELECT name FROM lib_worklog WHERE status=1 AND fb_worklog = $doplog[$i]") or die("ошибка в выборке worklog");
	$temprow = mysqli_fetch_row($tempresult);

	if(strripos($temprow[0], "звукопроизношения, развитие фонематических") && $bdate < 5) {
		$templog = " (c пяти лет)";
	} else {
		$templog = "";
	}

	$doplogprint .= " ".$temprow[0].$templog.",";
	
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


echo "<li><b style='color: #3333cc'>Учитель-дефектолог".$tempdef.":</b> ";


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
	echo "<li><b style='color: #3333cc'>Социальный педагог (социальный работник): </b>";
} else {
	echo "<li><b style='color: #3333cc'>Социальный педагог: </b>";
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







if($row[29] > 0 && $row[1]<>5) {
echo "<li><b style='color: #3333cc'>Другие условия:</b> ";
if ($row[29] == 1) {
	echo "в соответствии с индивидуальной программой реабилитации (абилитации) инвалида";
} else {
	$tempresult = mysqli_query($link, "SELECT name FROM lib_otherspec WHERE status=1 AND fb_otherspec = $row[29]") or die("ошибка в выборке inv");
	$temprow = mysqli_fetch_row($tempresult);
	echo $temprow[0];
}
echo "</li>";
}


if($row[30] <> 0) {

echo "<li><b style='color: #3333cc'>";

$tempresult = mysqli_query($link, "SELECT name FROM lib_time WHERE status=1 AND fb_time = $row[30]") or die("ошибка в выборке inv");
$temprow = mysqli_fetch_row($tempresult);

if ($row[30]==1 || strripos($temprow[0], "весь период обучения") ) {
	echo "Срок проведения обследования с целью подтверждения ранее данных комиссией рекомендаций:</b> ".$temprow[0];
} else {
	echo "Срок проведения обследования с целью уточнения/изменения ранее данных комиссией рекомендаций:</b> ".$temprow[0];
}

echo "</li>";
}

echo "<br>";


if ($row[32]>0) {
echo "<li><b >Педагог-психолог:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[32] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}


if ($row[33]>0) {
echo "<li><b >Учитель-логопед:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[33] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}


if ($row[34]>0) {
echo "<li><b >Учитель-дефектолог:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[34] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}

if ($row[35]>0) {
echo "<li><b >Социальный педагог:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[35] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}

?>

</ul>


</div>

<?php

}










if ($row_cnt2[0]>0) {



$result5 = mysqli_query($link, "SELECT * FROM archive WHERE ar_fio LIKE '{$fio}' AND ar_bdate='{$row3[1]}' ORDER BY ar_date DESC ") or die("ошибка в выборке данных в таблице 7");

while ($row5 = mysqli_fetch_row($result5)) {


echo '<div class="ui tab" data-tab="tab-'.$j.'">';

$date = new DateTime($row5[1]);
$bdate = new DateTime($row5[8]);

$tipdata = '';

$tipdata .= "<ul>";

$tipdata .= "<li>";
$tipdata .= "ФИО: <b>".trim($row5[4]);
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Дата рождения: <b>".$bdate->format('d.m.Y');
$tipdata .= "</b></li>";

$tipdata .= "<li>";
if ($row5[2]==0) {
	$inv = "Нет";
} else {
	$inv = "Да";
}
$tipdata .= "Наличие инвалидности: <b>".$inv;
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Номер протокола/заключения: <b>".trim($row5[3]);
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Дата прохождения комиссии: <b>".$date->format('d.m.Y');
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Тип услуги: <b>".trim($row5[11]);
$tipdata .= "</b></li>";

if ($row5[12] <> null) {
$tipdata .= "<li>";
$tipdata .= "Вариант АООП: <b>".trim($row5[12]);
$tipdata .= "</b></li>";
}

$tipdata .= "<li>";
$tipdata .= "Уровень образования: <b>".trim($row5[10]);
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Образовательная организация: <b>".trim($row5[9]);
$tipdata .= "</b></li>";


$tipdata .= "</ul>";

$j++;

echo $tipdata;

echo "</div>";

}

}























?>



<script type="text/javascript">
	
	$('.tabular.menu .item').tab();



</script>


</style>
