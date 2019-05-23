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
$pinkblank = $_REQUEST["pink"];
$spsy1 = $_REQUEST["spsy1"];
$spsy2 = $_REQUEST["spsy2"];
$slog = $_REQUEST["slog"];
$sdef = $_REQUEST["sdef"];
$ssoc = $_REQUEST["ssoc"];

if ($spsy1 || $spsy2 || $slog || $sdef || $ssoc) {
	$customsigns = 1;
}



if(!$getid) {
	die("Нет заключения на печать!");
}


require ('../connect.php');


$result4 = mysqli_query($link, "SELECT * FROM conf LIMIT 1") or die("ошибка в выборке ФИО");
$row4 = mysqli_fetch_row($result4);


$result = mysqli_query($link, "SELECT gia_pinkprint FROM giabase WHERE id=$getid LIMIT 1") or die("ошибка в выборке ЗАКЛЮЧЕНИЯ");
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


mysqli_query($link, "UPDATE giabase SET gia_pinknumber='{$pinknum}' WHERE id='{$getid}' LIMIT 1") or die("что-то пошло не так 2");

}






$result = mysqli_query($link, "SELECT * FROM giabase WHERE id=$getid LIMIT 1") or die("ошибка в выборке ЗАКЛЮЧЕНИЯ");

$row = mysqli_fetch_row($result);










?>



<div id="mainprnttpl" class="ui stackable " style="<?php if(($row[22] == 11) && ($row[24] == 1) && ($row[10] == 0)) { echo "display:none; "; } ?>position: absolute; width: 797px; padding-left: 10px; padding-right: 10px; font-size: 1.1em" >



<div class="ui stackable one column grid" >
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
ЗАКЛЮЧЕНИЕ</b>
</div>




</div>

</div>




<div class="column">

<div align="center">

<b>о создании условий при проведении ГИА</b>
</div>

</div>


<div class="column">

<div align="center">
<b>Протокол № <?php echo $row[1];?> от <?php echo strftime("%d.%m.%Y", strtotime($row[2])) ; ?></b>

</div>

</div>


<div class="column">
<br>
<b>Ф.И.О. обучающегося: </b><span style="font-size: 1.2em;"> <?php echo $row[6]; ?></span>
<br><br>
<b>Дата рождения: </b><?php echo strftime("%d.%m.%Y", strtotime($row[7])) ; ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<b>Обучающийся: </b><?php 
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_class WHERE id=$row[21] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0]."а";
?>
<br><br>
<b>Наименование образовательной организации: </b><?php echo $row[16]; ?>

</div>



<div class="column">

<br>
<b>Заключение ПМПК</b><?php

if ($row[26]<>'0') {

echo " для создания условий при проведении ";

if ($row[21] < 4) {
	if (strlen($row[26])>1) {
		echo "итогового собеседования по русскому языку, ГИА по образовательной программе основного общего образования";
	} else {	
switch ($row[26]) {
	case '3':
		echo "итогового собеседования по русскому языку";
		break;

	case '2':
		echo "ГИА по образовательной программе основного общего образования";
		break;
}
}

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
        echo ' обучающемуся по медицинским показаниям (Медицинское заключение № '.$row[12].' от '.strftime("%d.%m.%Y", strtotime($row[13])).'г.)';
        break; 
    }

  }

}





} else {

echo ": не нуждается в создании условий при проведении ";

if ($row[21] < 4) {
echo "итогового собеседования по русскому языку, ГИА по образовательной программе основного общего образования";
} elseif ($row[21] < 6) {
echo "ГИА по образовательной программе среднего общего образования";
} else {
echo "итогового сочинения (изложения), ГИА по образовательной программе среднего общего образования";
}

}




if ($row[26]<>'0') {
?>
<br><br>
<b>Основание для выбора формы ГИА: </b>
<?php 

if ($row[27]<>'0' || $row[28]<>'0') {
echo "да";
} else {
echo "нет";  
}


if($row[21]<4) {
?>
<br>
<b>Основание для сокращения количества сдаваемых экзаменов до 2-х обязательных: </b>
<?php 

if ($row[27]<>'0' || $row[28]<>'0') {
echo "да";
} else {
echo "нет";  
}
}

}

if ($row[27]<>'0' || $row[28]<>'0') {
?>


<br>

<?php
//<b>Возможность выбора ГВЭ: </b>Да


if ($row[27]<>'0') {

echo "<b>Русский язык: </b>";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_liter WHERE id IN ($row[27]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."/";
}
$tempstr = substr($tempstr, 0, -1);
echo $tempstr;

}


if ($row[28]<>'0') {

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Математика: </b>";

$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_liter WHERE id IN ($row[28]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."/";
}
$tempstr = substr($tempstr, 0, -1);
echo $tempstr;

}

?>


<?php

}
?>

</div>

<?php
if ($row[29]<>'0') {
?>



<div class="column">
<br>
<b>Требование к оформлению КИМ: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_kim WHERE id IN ($row[29]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;
?>

</div>




<?php
}
?>




<?php
if ($row[26]<>'0') {
?>

<div class="column">
<br>
<b>Продолжительность экзамена: </b>
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


</div>


<?php
}
?>




<?php
if ($row[30]<>'0') {
?>

<div class="column">
<br>
<b>Требование к рабочему месту: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_workplace WHERE id IN ($row[30]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;
?>

<br>

</div>


<?php
}
?>





<?php
if ($row[31]<>'0') {
?>

<div class="column">
<br>
<b>Ассистент: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_assist WHERE id IN ($row[31]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;
?>

<br><br>

</div>


<?php
}
?>





<?php
if ($row[32]<>'0') {
?>

<div class="column">

<b>Требования к оформлению работы: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_typogr WHERE id IN ($row[32]) ") or die("ошибка в выборке");
$tempstr = '';
while ($rowtemp = mysqli_fetch_row($resulttemp)) {
$tempstr .= $rowtemp[0]."; ";
}
$tempstr = substr($tempstr, 0, -2);
echo $tempstr;
?>

<br><br>

</div>


<?php
}
?>





<?php
if ($row[26]<>'0') {
?>

<div class="column">

<b>Организация ППЭ: </b>
<?php
$resulttemp = mysqli_query($link, "SELECT name FROM lib_gia_ppe WHERE id=$row[33] LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);
echo $rowtemp[0];
?>

<br>

</div>


<?php
}
?>



</div>
</div>



<div class="ui three column grid " id="signs">
<div class="row">

<div class="eight  wide column">
<b><br>Руководитель ПМПК 
<br><br>

<?php 
if ($customsigns == 1) {

if ($spsy1 > 0) {
?>
Педагог-психолог
<br>
<?php
}


} elseif ($row[36]>0) {

?>
Педагог-психолог
<br>

<?php
}
?>


<?php 
if ($customsigns == 1) {

if ($spsy2 > 0) {
?>
Педагог-психолог
<br>
<?php
}


} elseif ($row[37]>0) {

?>
Педагог-психолог
<br>

<?php
}
?>


<?php 
if ($customsigns == 1) {

if ($slog > 0) {
?>
Учитель-логопед
<br>
<?php
}


} elseif ($row[38]>0) {

?>
Учитель-логопед
<br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($sdef > 0) {
?>
Учитель-дефектолог
<br>
<?php
}


} elseif ($row[39]>0) {

?>
Учитель-дефектолог
<br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($ssoc > 0) {
?>
Социальный педагог
<br>
<?php
}


} elseif ($row[40]>0) {

?>
Социальный педагог
<br>


</b>

</div>



<div class="eight  wide column" align="left">
<br>
<?php

$tempresult = mysqli_query($link, "SELECT name FROM lib_sboss WHERE status=1 ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
echo $temprow[0];

?>

<br><br>

<?php
if ($customsigns == 1) {

if ($spsy1 > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$spsy1 ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php

}


} elseif ($row[36]>0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[36] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php
}



if ($customsigns == 1) {

if ($spsy2 > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$spsy2 ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php

}


} elseif ($row[37]>0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[37] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php
}






if ($customsigns == 1) {

if ($slog > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$slog ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php

}


} elseif ($row[38]>0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[38] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php

}

if ($customsigns == 1) {

if ($sdef > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$sdef ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php

}


} elseif ($row[39]>0) {

$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[39] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php

}

if ($customsigns == 1) {

if ($ssoc > 0) {
$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$ssoc ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php

}


} elseif ($row[40]>0) {

$tempresult = mysqli_query($link, "SELECT first_name, second_name, third_name FROM users WHERE id_users=$row[40] ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);
$sfio = $temprow[1].' '.mb_substr($temprow[0],0,1,"UTF-8").'. '.mb_substr($temprow[2],0,1,"UTF-8").'.';
echo $sfio;

?>

<br>

<?php 
}
?>

</div>


<div class="two wide column">
<br>
__________________________________
<br><br>




<?php 
if ($customsigns == 1) {

if ($spsy1 > 0) {
?>
__________________________________
<br>
<?php
}


} elseif ($row[36]>0) {

?>
__________________________________
<br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($spsy2 > 0) {
?>
__________________________________
<br>
<?php
}


} elseif ($row[37]>0) {

?>
__________________________________
<br>

<?php
}
?>




<?php 
if ($customsigns == 1) {

if ($slog > 0) {
?>
__________________________________
<br>
<?php
}


} elseif ($row[38]>0) {

?>
__________________________________
<br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($sdef > 0) {
?>
__________________________________
<br>
<?php
}


} elseif ($row[39]>0) {

?>
__________________________________
<br>

<?php
}
?>

<?php 
if ($customsigns == 1) {

if ($ssoc > 0) {
?>
__________________________________
<br>
<?php
}


} elseif ($row[40]>0) {

?>
__________________________________
<br>

<?php
}
?>



</div>
</div>

</div>





<div class="ui stackable one column grid ">
<div class="row">
<div class="column">

<b>Дата выдачи рекомендаций ПМПК: </b>_________________________

</div>




<div class="column">
<br>

С рекомендациями ознакомлен(а). Оригинал получен.<br><br>

_________________________________ &nbsp;&nbsp;&nbsp; (________________________________________________________________________________)<br>
<span style="padding-left: 10%">(подпись)</span><span style="padding-left: 40%">(расшифровка)</span>

<br><br>


</div>






</div>
</div>


<?php

}

?>


</div>





<?php
if ($pinkblank == 1) {
	echo '<div style="position: absolute; top: 1145px; right: 40px">';
	echo $row[42];
	echo "</div>";
}


?>










<script type="text/javascript">


function pinkblank(idp) {

$.ajax({
    type: "POST",
    data:{ "chid": idp }, 
    url: "/lib/pinkblankgia.php",
    dataType: "html",            
    success: function(response){
        window.close();
    }

});

}




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
    
    <a class="ui blue button prntconfirm" href="/lib/tpl/printgia.php?id=<?php 
    echo $getid; 
    if ($customsigns == 1) {
    	if ($spsy1) {
    		echo "&spsy1=".$spsy1;
    	}
    	if ($spsy2) {
    		echo "&spsy2=".$spsy2;
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
    		echo "&pink=1";
    	}
    ?>">Повторная печать</a>
    <a class="ui green button floated right" href="#!" <?php if($pinkblank==1) { ?> onclick="pinkblank(<?php echo $getid; ?>)"  <?php } else { ?> onclick="window.close();" <?php } ?> >Успешно распечатано</a>
    <a class="ui orange button floated right" href="#!" onclick="window.close();">Отмена</a>

  </div>
</div>

<?php 

/*

<div style="position: absolute; top: 1095px; font-size: 0.7em  !important; line-height: 1em !important">
<i >* Не является основанием для установления статуса "обучающийся с ОВЗ"</i>
<br><br>
<i >** Ст.59 ч.5, ч.13 п.1 Федерального закона от 29.12.2012 г. № 273-ФЗ «Об образовании в Российской Федерации», приказы Минобрнауки РФ от 20.09.2013 г. № 1082  «Об утверждении Положения о психолого-медико-педагогической комиссии»; от 07.11.2018 г. №189/1513 «Об утверждении порядка проведения государственной итоговой аттестации по образовательным программам основного общего образования»; от 07.11.2018 г. № 190/1512 «Об утверждении порядка проведения государственной итоговой аттестации по образовательным программам среднего общего образования»</i>

</div>
*/

?>

</body>
</html>
