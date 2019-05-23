<?php
require ('../connect.php');


$result = mysqli_query($link, "SELECT * FROM fullbase ORDER BY fb_date DESC ") or die("ошибка в выборке данных в таблице 5");


while ($row = mysqli_fetch_row($result)) {

echo "<br>";
// number
echo $row[2].";";

// date
echo strftime("%d.%m.%G", strtotime($row[3])).";";

// fio
echo $row[4].";";

//bdate
echo strftime("%d.%m.%G", strtotime($row[5])).";";

// school
echo $row[37].";";


// code

if ($row[38]==0) {


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

}

echo ";";




} else {
	echo "-;";
}




// AOOP

if ($row[38]<>0) {

echo "Консультация";

} else {
//echo "<li><b style='color: #3333cc'>Образовательная программа:</b> ";
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
		echo " - Программа подготовки квалифицированных рабочих, служащих (ППКРС) - Программа подготовки специалистов среднего звена (ППССЗ)";
		}
		break;

}
}

echo ";";




//Уровень образования

if ($row[9] <> 0) {
//echo "<li><b style='color: #3333cc'>Уровень образования:</b> ";
$tempresult = mysqli_query($link, "SELECT name FROM lib_edulevel WHERE status=1 AND fb_edulevel = $row[9]") or die("ошибка в выборке обр прог");
$temprow = mysqli_fetch_row($tempresult);
echo $temprow[0];
echo ";";
}



}














$result5 = mysqli_query($link, "SELECT * FROM archive ORDER BY ar_date DESC ") or die("ошибка в выборке данных в таблице 7");

while ($row5 = mysqli_fetch_row($result5)) {


$date = new DateTime($row5[1]);
$bdate = new DateTime($row5[8]);

$tipdata = '';

//fio
$tipdata .= trim($row5[4]);
$tipdata .= ";";

//bdate
$tipdata .= $bdate->format('d.m.Y');
$tipdata .= ";";

// inv
if ($row5[2]==0) {
	$inv = "ОВЗ";
} else {
	$inv = "Инв";
}
$tipdata .= $inv;
$tipdata .= ";";

// num
$tipdata .= trim($row5[3]);
$tipdata .= ";";

//date
$tipdata .= $date->format('d.m.Y');
$tipdata .= ";";

// Тип услуги
$tipdata .= trim($row5[11]);
$tipdata .= ";";

// AOOP
if ($row5[12] <> null) {

$tipdata .= trim($row5[12]);
$tipdata .= ";";
} else {
$tipdata .= "-;";
}

// Уровень образования
$tipdata .= trim($row5[10]);
$tipdata .= ";";

// Образовательная организация
$tipdata .= trim($row5[9]);
$tipdata .= ";";


echo $tipdata;


}

























?>


