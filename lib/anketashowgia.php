<?php

$getid = $_REQUEST["id"];

if(!$getid) {
	die("Нет данных! 2");
}


require ('connect.php');

$result3 = mysqli_query($link, "SELECT gia_fio, gia_bdate FROM giabase WHERE gia_status=2 AND id=$getid") or die("ошибка в выборке ");

$row3 = mysqli_fetch_row($result3);


?>

<div class="ui tabular menu">

<?php

$fio = trim($row3[0]);

$result2 = mysqli_query($link, "SELECT * FROM giabase WHERE gia_fio LIKE '{$fio}' AND gia_bdate='{$row3[1]}' ORDER BY gia_date DESC ") or die("ошибка в выборке данных в таблице 4");

$j=0;

while ($row2 = mysqli_fetch_row($result2)) {

$date = new DateTime($row2[2]);


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


$result = mysqli_query($link, "SELECT * FROM giabase WHERE gia_fio LIKE '{$fio}' AND gia_bdate='{$row3[1]}' ORDER BY gia_date DESC ") or die("ошибка в выборке данных в таблице 5");

$j=0;

while ($row = mysqli_fetch_row($result)) {


if ($row[0]==$getid) {

echo '<div class="ui tab active" data-tab="tab-'.$j.'">';
} else {

echo '<div class="ui tab" data-tab="tab-'.$j.'">';
}

$j++;


echo "<h4><b style='color: #3333cc'>№</b> ".$row[1]." <b style='color: #3333cc'>от</b> ".strftime("%d.%m.%G", strtotime($row[2]))."</h4>";

?>



<h5>Протокол:</b></h5>

<ul>

<?php



echo "<li><b style='color: #3333cc'>Ф.И.О. обучающегося:</b> ";
echo $row[6];
echo "</li>";

echo "<li><b style='color: #3333cc'>Дата рождения:</b> ";
echo strftime("%d.%m.%G", strtotime($row[7]));
echo "</li>";

echo "<li><b style='color: #3333cc'>Обследование проводилось: </b> ";
$result2 = mysqli_query($link, "SELECT name FROM lib_gia_place WHERE id='{$row[3]}'") or die("ошибка в выборке ");
$row2 = mysqli_fetch_row($result2);
echo $row2[0];
echo " <b style='color: #3333cc'> в форме: </b>";

$resulttemp = mysqli_query($link, "SELECT pname FROM lib_gia_form WHERE id=$row[4] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];

echo "</li>";

echo "<li><b style='color: #3333cc'>Адрес проживания обучающегося: </b> ";
echo $row[8];
echo " <b style='color: #3333cc'> Ф.И.О. законного представителя: </b>";
echo $row[5];
echo "</li>";

echo "<li><b style='color: #3333cc'>Образовательная организация: </b> ";
echo $row[16];
echo "</li>";


echo "<li><b style='color: #3333cc'>Перечень предоставленных документов: </b> ";

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

echo "</li>";

echo "<li><b style='color: #3333cc'>Сведения об образовании обучающегося: </b> ";
$result8 = mysqli_query($link, "SELECT name, pname FROM lib_gia_class WHERE id='{$row[21]}'") or die("ошибка в выборке ");
$row8 = mysqli_fetch_row($result8);
echo $row8[0];
echo "</li>";

echo "<li><b style='color: #3333cc'>Программа обучения: </b> ";
$result2 = mysqli_query($link, "SELECT sname FROM lib_op WHERE id_op='{$row[22]}'") or die("ошибка в выборке ");
$row2 = mysqli_fetch_row($result2);
echo $row2[0];
echo "</li>";

echo "<li><b style='color: #3333cc'>Уровень образования: </b> ";
echo $row8[1];
echo "</li>";

echo "<li><b style='color: #3333cc'>Форма обучения: </b> ";
$result2 = mysqli_query($link, "SELECT name FROM lib_gia_eduform WHERE id='{$row[23]}'") or die("ошибка в выборке ");
$row2 = mysqli_fetch_row($result2);
echo $row2[0];
echo "</li>";

echo "<li><b style='color: #3333cc'>Организация обучения: </b> ";
$result2 = mysqli_query($link, "SELECT name FROM lib_gia_eduorg WHERE id='{$row[24]}'") or die("ошибка в выборке ");
$row2 = mysqli_fetch_row($result2);
echo $row2[0];
echo "</li>";



echo "<li><b style='color: #3333cc'>Инвалидность: </b> ";

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

echo "</li>";


echo "<li><b style='color: #3333cc'>Медицинское заключение о состоянии здоровья: </b> ";
if ($row[12]<>'0') {

echo "№ ".$row[12]."<br>";

echo "врачебная комиссия от ".strftime("%d.%m.%Y", strtotime($row[13]))."г., выдано ".$row[14];


} else {
	echo "нет";
}
echo "</li>";


echo "<li><b style='color: #3333cc'>Код заболевания: </b> ";
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_code WHERE id=$row[15] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
echo "</li>";


echo "<li><b style='color: #3333cc'>Координаты ответственного специалиста от образовательной организации:<br>Ф.И.О. специалиста: </b> ";
if ($row[18]<>'0') {
echo $row[18];
} else {
echo "нет данных";
}


echo "<b style='color: #3333cc'> Должность: </b> ";
if ($row[19]<>'0') {
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_ooprof WHERE id=$row[19] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
} else {
echo "нет данных";
}

echo "<b style='color: #3333cc'> Контактный телефон: </b> ";
if ($row[20]<>'0') {
echo $row[20];
} else {
echo "нет данных";
}

echo "</li>";

?>

</ul>



<h5>Заключение:</b></h5>

<ul>

<?php

echo "<li><b style='color: #3333cc'>Заключение ЦПМПК г.Москвы</b>";

if ($row[26]<>'0') {

echo " для создания условий при проведении ";

if ($row[21] < 4) {
	echo "ГИА по образовательной программе основного общего образования";
} elseif ($row[21] < 6) {
	echo "ГИА по образовательной программе среднего общего образования";
} else {
	if (strlen($row[26])>1) {
		echo "итогового сочинения (изложения), ГИА по образовательной программе среднего общего образования";
	} else {
		switch ($row[26]) {
			case '1':
				echo "итогового сочинения (изложения)";
				break;
			
			case '2':
				echo "ГИА по образовательной программе среднего общего образования";
				break;
		}
	}
}

if ($row[10]<>'0') {
  echo ' обучающемуся ребенку-инвалиду, инвалиду (Справка МСЭ № '.$row[10];

  if ($row[11]=='3000-01-01') {
    echo " бессрочно)";
  } else {
    echo " на срок до ".strftime("%d.%m.%Y", strtotime($row[11])).")";
  }
} else {

  if ($row[22]<11) {
    echo ' обучающемуся с ОВЗ ('.$row[46].')';
  } else {

    switch ($row[24]) {
      case '2':
        echo ' обучающемуся на дому (Медицинское заключение '.$row[46].')';
        break;
      
      case '3':
        echo ' обучающемуся в медицинской организации (Медицинское заключение '.$row[46].')';
        break;
        
      default:
        echo ' обучающемуся в соответствии с Медицинским заключением об актуальном состоянии здоровья (Медицинское заключение № '.$row[12].' от '.strftime("%d.%m.%Y", strtotime($row[13])).'г.)';
        break; 
    }

  }

}


} else {

echo ": не нуждается в создании условий при проведении ";

if ($row[21] < 4) {
echo "ГИА* по образовательной программе основного общего образования";
} elseif ($row[21] < 6) {
echo "ГИА* по образовательной программе среднего общего образования";
} else {
echo "итогового сочинения (изложения), ГИА* по образовательной программе среднего общего образования";
}

}

echo "</li>";



if ($row[26]<>'0') {
?>
<li>
<b style='color: #3333cc'>Основание для выбора формы ГИА: </b>
<?php 

if ($row[27]<>'0' || $row[28]<>'0') {
echo "да";
} else {
echo "нет";  
}
?>
</li>
<?php
if($row[21]<4) {
?>
<li>
<b style='color: #3333cc'>Основание для сокращения количества сдаваемых экзаменов до 2-х обязательных: </b>
<?php 

if ($row[27]<>'0' || $row[28]<>'0') {
echo "да";
} else {
echo "нет";  
}

?>
</li>
<?php
}

}



if ($row[27]<>'0' || $row[28]<>'0') {

echo "<li>";

if ($row[27]<>'0') {

echo "<b style='color: #3333cc'>Русский язык: </b>";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_liter WHERE id IN ($row[27]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."/";
}
$tempstr = substr($tempstr, 0, -1);
echo $tempstr;

}

if ($row[28]<>'0') {

echo "&nbsp;&nbsp;&nbsp;<b style='color: #3333cc'>Математика: </b>";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_liter WHERE id IN ($row[28]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."/";
}
$tempstr = substr($tempstr, 0, -1);
echo $tempstr;

}

echo "</li>";

}




if ($row[29]<>'0') {

echo "<li><b style='color: #3333cc'>Требование к оформлению КИМ: </b> ";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_kim WHERE id IN ($row[29]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;

echo "</li>";


}




if ($row[26]<>'0') {

?>

<div class="column">
<br>
<li><b style="color: #3333cc">Продолжительность экзамена:</b>
<?php 

if ($row[10]<>'0' || $row[22]<>'11') {echo " увеличивается на 1,5 часа;"; }

if ($row[21] < 4 && ($row[26]=='3' || strlen($row[26])>1)) {
	echo " продолжительность итогового собеседования по русскому языку увеличивается на 30 минут";
} elseif ($row[21] > 5 && ($row[26]=='2' || strlen($row[26])>1) && ($row[10]<>'0' || $row[22]<>'11')) {
	echo " продолжительность ЕГЭ по иностранным языкам (раздел «Говорение») увеличивается на 30 минут;";
} 

if ($row[21] > 5 && ($row[26]=='2' || strlen($row[26])>1)) {
  echo " продолжительность итогового сочинения (изложения) увеличивается на 1,5 часа";
}
?>

</li>
</div>


<?php
}





if ($row[30]<>'0') {

echo "<li><b style='color: #3333cc'>Требование к рабочему месту: </b> ";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_workplace WHERE id IN ($row[30]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;

echo "</li>";


}



if ($row[31]<>'0') {

echo "<li><b style='color: #3333cc'>Ассистент: </b> ";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_assist WHERE id IN ($row[31]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;

echo "</li>";


}





if ($row[32]<>'0') {

echo "<li><b style='color: #3333cc'>Требования к оформлению работы: </b> ";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_typogr WHERE id IN ($row[32]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;

echo "</li>";


}



if ($row[26]<>'0') {

echo "<li><b style='color: #3333cc'>Организация ППЭ: </b> ";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_ppe WHERE id=$row[33] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];

echo "</li>";


}




echo "<br>";


if ($row[36]>0) {
echo "<li><b >Педагог-психолог:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[36] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}

if ($row[37]>0) {
echo "<li><b >Педагог-психолог:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[37] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}


if ($row[38]>0) {
echo "<li><b >Учитель-логопед:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[38] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}


if ($row[39]>0) {
echo "<li><b >Учитель-дефектолог:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[39] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;
echo "</li>";
}

if ($row[40]>0) {
echo "<li><b >Социальный педагог:</b> ";
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[40] ") or die("ошибка в выборке ");
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