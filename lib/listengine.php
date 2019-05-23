
<?php 

require ('connect.php');

$per_page=10;

if (isset($_POST['page'])) $page=($_POST['page']-1); else $page=0;

$start=abs($page*$per_page);


$qfilter = ' ';
$gqfilter = ' ';

$pdate = $_POST['pdate'];
$bdate = $_POST['bdate'];
$znum = $_POST['znum'];
$fio = $_POST['fio'];
$checkstat = $_POST['checkstat'];

$invfilter = 0;
$aoopfilter = '';
$edulevel = '';

$finfilter = explode(",", $checkstat[0]);

$onlygia = 0;
$onlyzacl = 0;

for ($i=0; $i < 31; $i++) {

switch ($i) {

	case '28':
		
		if ($checkstat[$i] == 1 && $checkstat[0] <> 1 && $checkstat[1] <> 1) {
			$onlygia = 1;
		} elseif ($checkstat[$i] <> 1 && ($checkstat[0]==1 || $checkstat[1]==1)) {
			$onlyzacl = 1;
		}
	break;

	case '0':
		if ($checkstat[$i] == 1 && $checkstat[$i+1] <> 1) {
			$qfilter .= " AND fb_consult=0";
		} 
	break;

	case '1':
		if ($checkstat[$i] == 1 && $checkstat[$i-1] <> 1) {
			$qfilter .= " AND fb_consult=1";
		} 
	break;

	case '2':
		if ($checkstat[$i] == 1) {
		$invfilter += 1;
		$gqfilter .= " AND gia_msenum<>0";
		}
	break;

	case '3':
		if ($checkstat[$i] == 1) {
		$invfilter += 10;
		$gqfilter .= " AND gia_msenum=0 AND gia_eduaoop<>11";
		}
	break;

	case '4':
		if ($checkstat[$i] == 1) {
		$invfilter += 100;
		$gqfilter .= " AND gia_msenum=0 AND gia_eduaoop=11";
		}
	break;

	case '5':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "1" ;
			} else {
				$aoopfilter .= ",1" ;
			}
			$gqfilter .= " AND gia_eduaoop=1";
		}
	break;

	case '6':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "2" ;
			} else {
				$aoopfilter .= ",2" ;
			}
			$gqfilter .= " AND gia_eduaoop=2";
		}
	break;

	case '7':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "3" ;
			} else {
				$aoopfilter .= ",3" ;
			}
			$gqfilter .= " AND gia_eduaoop=3";
		}
	break;

	case '8':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "4" ;
			} else {
				$aoopfilter .= ",4" ;
			}
			$gqfilter .= " AND gia_eduaoop=4";
		}
	break;

	case '9':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "5" ;
			} else {
				$aoopfilter .= ",5" ;
			}
			$gqfilter .= " AND gia_eduaoop=5";
		}
	break;

	case '10':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "6" ;
			} else {
				$aoopfilter .= ",6" ;
			}
			$gqfilter .= " AND gia_eduaoop=6";
		}
	break;

	case '11':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "7" ;
			} else {
				$aoopfilter .= ",7" ;
			}
			$gqfilter .= " AND gia_eduaoop=7";
		}
	break;

	case '12':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "8" ;
			} else {
				$aoopfilter .= ",8" ;
			}
			$gqfilter .= " AND gia_eduaoop=8";
		}
	break;

	case '13':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "9" ;
			} else {
				$aoopfilter .= ",9" ;
			}
			$gqfilter .= " AND gia_eduaoop=9";
		}
	break;

	case '14':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "10" ;
			} else {
				$aoopfilter .= ",10" ;
			}
			$gqfilter .= " AND gia_eduaoop=10";
		}
	break;

	case '15':
		if ($checkstat[$i] == 1) {
			if ($aoopfilter=='') {
				$aoopfilter = "11" ;
			} else {
				$aoopfilter .= ",11" ;
			}
			$gqfilter .= " AND gia_eduaoop=11";
		}
	break;

	case '16':
		if ($checkstat[$i] == 1) {
			if ($edulevel=='') {
				$edulevel = "1,9" ;
			} else {
				$edulevel .= ",1,9" ;
			}
			$onlyzacl=1;
		}
	break;

	case '17':
		if ($checkstat[$i] == 1) {
			if ($edulevel=='') {
				$edulevel = "6,10" ;
			} else {
				$edulevel .= ",6,10" ;
			}
			$onlyzacl=1;
		}
	break;

	case '18':
		if ($checkstat[$i] == 1) {
			if ($edulevel=='') {
				$edulevel = "2,7,11" ;
			} else {
				$edulevel .= ",2,7,11" ;
			}
			$onlyzacl=1;
		}
	break;

	case '19':
		if ($checkstat[$i] == 1) {
			if ($edulevel=='') {
				$edulevel = "3,12" ;
			} else {
				$edulevel .= ",3,12" ;
			}
			$gqfilter .= " AND gia_class<4";
		}
	break;

	case '20':
		if ($checkstat[$i] == 1) {
			if ($edulevel=='') {
				$edulevel = "4,13" ;
			} else {
				$edulevel .= ",4,13" ;
			}
			$gqfilter .= " AND gia_class>3";
		}
	break;

	case '21':
		if ($checkstat[$i] == 1) {
			if ($edulevel=='') {
				$edulevel = "5,8,14" ;
			} else {
				$edulevel .= ",5,8,14" ;
			}
			$onlyzacl=1;
		}
	break;

	case '22':
		if ($checkstat[$i] == 1) {
			if ($edulevel=='') {
				$edulevel = "15" ;
			} else {
				$edulevel .= ",15" ;
			}
			$onlyzacl=1;
		}
	break;

	case '23':
		if ($checkstat[$i] == 1) {
			$qfilter .= " AND fb_rdoop=1";
			$onlyzacl=1;
		}
	break;

	case '24':
		if ($checkstat[$i] == 1) {
			$qfilter .= " AND fb_dolg=1";
			$gqfilter .= " AND gia_dolg=1";
		}
	break;

// СДЕЛАТЬ ЛУЧШЕ!


	case '25':
		if ($checkstat[$i] == 1) {
			if ($checkstat[$i+1] == 1 && $checkstat[$i+2] <> 1) {
				$qfilter .= " AND fb_pinkprint=0";
				$gqfilter .= " AND gia_pinkprint=0";
			} elseif ($checkstat[$i+2] == 1 && $checkstat[$i+1] <> 1) {
				$qfilter .= " AND (fb_rdoop=1 OR fb_dolg=1 OR fb_pinkprint>0)";
				$gqfilter .= " AND (gia_dolg=1 OR gia_pinkprint>0)";
				} elseif($checkstat[$i+2] == 1 && $checkstat[$i+1] == 1) {

				} else {
					$qfilter .= " AND (fb_pinkprint=0 AND (fb_rdoop=1 OR fb_dolg=1))";
					$gqfilter .= " AND (gia_dolg=1 AND gia_pinkprint=0)";
				}
			
		}
	break;

	case '26':
		if ($checkstat[$i] == 1 && $checkstat[$i-1] <> 1) {
			if ($checkstat[$i+1] == 1) {
				$qfilter .= " AND ((fb_rdoop=0 AND fb_dolg=0) OR (fb_pinkprint>0))";
				$gqfilter .= " AND (gia_dolg=0 OR gia_pinkprint>0)";
			} else {
				$qfilter .= " AND (fb_pinkprint=0 AND fb_rdoop=0 AND fb_dolg=0)";
				$gqfilter .= " AND (gia_dolg=0 AND gia_pinkprint=0)";
			}
		}
		
	break;

	case '27':
		if ($checkstat[$i] == 1 && $checkstat[$i-1] <> 1 && $checkstat[$i-2] <> 1) {
			$qfilter .= " AND fb_pinkprint>0";
			$gqfilter .= " AND gia_pinkprint>0";
		}
	break;

	case '29':
		
		if ($checkstat[$i] == 1 && $checkstat[$i+1]==0) {
			$qfilter .= " AND fb_outdoor=1";
			$gqfilter .= " AND gia_outdoor=1";
		} elseif ($checkstat[$i] == 1 && $checkstat[$i+1]==1) {
			$qfilter .= " AND fb_outdoor>0";
			$gqfilter .= " AND gia_outdoor>0";
		}
	break;

	case '30':
		
		if ($checkstat[$i] == 1 && $checkstat[$i-1]==0) {
			$qfilter .= " AND fb_outdoor=2";
			$gqfilter .= " AND gia_outdoor=2";
		} elseif ($checkstat[$i] == 1 && $checkstat[$i-1]==1) {
			$qfilter .= " AND fb_outdoor>0";
			$gqfilter .= " AND gia_outdoor>0";
		}
	break;

}


}


switch ($invfilter) {
	case '1':
		$qfilter .= " AND fb_invovz>0";
		break;
	
	case '10':
		$qfilter .= " AND (fb_invovz=0 AND fb_edurel=0)";
		break;

	case '100':
		$qfilter .= " AND (fb_edurel=1 AND fb_invovz=0)";
		break;

	case '11':
		$qfilter .= " AND (fb_invovz>0 OR (fb_invovz=0 AND fb_edurel=0))";
		break;

	case '110':
		$qfilter .= " AND fb_invovz=0";
		break;

	case '101':
		$qfilter .= " AND (fb_invovz>0 OR (fb_edurel=1 AND fb_invovz=0))";
		break;
}






if ($aoopfilter <> "") {
$qfilter .= " AND fb_aoop IN (".$aoopfilter.")";
}


if ($edulevel <> "") {
$qfilter .= " AND fb_edulevel IN (".$edulevel.")";
}



function trueDate($v) {


$tempdate = explode(".", $v);
$j = 0;
while ($tempdate[$j]) {

	if (strlen($tempdate[$j])==1) {
		$tempdate[$j] = "0".$tempdate[$j];
	} 
	$j++;
}



switch (count($tempdate)) {
	case '3':
		
		for ($i=0; $i < 4; $i++) { 

		if (strlen($tempdate[$i])=='') {
			$tempdate[$i] = "%%";
		} 
		
		}	

$findate = $tempdate[2]."%-".$tempdate[1]."-".$tempdate[0];

		break;
	
	case '2':
		
		if ($tempdate[0]=='' && strlen($tempdate[1])>2) {
			$findate = $tempdate[1]."%-%%-%%";
		} elseif ($tempdate[0]=='') {
			$findate = "%%%%-".$tempdate[1]."-%%";
		} elseif ($tempdate[1]=='') {
			$findate = "%%%%-%%-".$tempdate[0];
		} else {
			$findate = "%".$tempdate[1]."%-".$tempdate[0]."%";
		}

		break;

	case '1':
		
		$findate = $tempdate[0]."%-%";

		break;

	default:
		$errlog = "Ошибка в дате";
	break;
}


return $findate;

}


if (strlen($pdate)>2) {


$pdate = trueDate($pdate);


	$qpdate = " AND fb_date LIKE '%".trim($pdate)."'";
	$gqpdate = " AND gia_date LIKE '%".trim($pdate)."'";
} else {
	$qpdate = '';
	$gqpdate = '';
}

if (strlen($bdate)>2) {

$bdate = trueDate($bdate);

	$qbdate = " AND fb_bdate LIKE '%".trim($bdate)."'";
	$gqbdate = " AND gia_bdate LIKE '%".trim($bdate)."'";
} else {
	$qbdate = '';
	$gqbdate = '';
}

if (strlen($znum)>2) {

	$qznum = " AND fb_num LIKE '%".trim($znum)."%'";
	$gqznum = " AND gia_num LIKE '%".trim($znum)."%'";
} else {
	$qznum = '';
	$gqznum = '';
}

if (strlen($fio)>2) {

	$qfio = " AND fb_fio LIKE '%".trim($fio)."%'";
	$gqfio = " AND gia_fio LIKE '%".trim($fio)."%'";
} else {
	$qfio = '';
	$gqfio = '';
}




unset($data);

if ($onlygia==0) {

$result = mysqli_query($link, "SELECT id, fb_date, fb_num, fb_fio, fb_bdate, fb_consult, fb_rdoop, fb_dolg, fb_invovz, fb_aoop, fb_dopaoop, fb_type, fb_edulevelvar, fb_edulevel, fb_pinkprint, fb_customcode, fb_outdoor FROM fullbase WHERE fb_status=2 $qpdate $qznum $qfio $qbdate $qfilter ") or die("ошибка в выборке данных в таблице 3");

while ($row = mysqli_fetch_row($result)) {

$data[] = array('id' => $row[0], 'pdate' => $row[1], 'num' => $row[2], 'fio' => $row[3], 'bdate' => $row[4], 'ltype' => $row[5], 'specone' => $row[6], 'dolg' => $row[7], 'inv' => $row[8], 'aoop' => $row[9], 'dopaoop' => $row[10], 'ztype' => $row[11], 'edulevelvar' => $row[12], 'edulevel' => $row[13], 'pink' => $row[14], 'code' => $row[15], 'outdoor' => $row[16] );

}

} 

if ($onlyzacl==0) {

$result = mysqli_query($link, "SELECT id, gia_date, gia_num, gia_fio, gia_bdate, gia_dolg, gia_msenum, gia_class, gia_outdoor, gia_pinkprint FROM giabase WHERE gia_status=2 $gqpdate $gqznum $gqfio $gqbdate $gqfilter") or die("ошибка в выборке данных в таблице 1"); 



while ($row = mysqli_fetch_row($result)) {

$data[] = array('id' => $row[0], 'pdate' => $row[1], 'num' => $row[2], 'fio' => $row[3], 'bdate' => $row[4], 'ltype' => 2, 'specone' => $row[7], 'dolg' => $row[5], 'inv' => $row[6], 'aoop' => 0, 'dopaoop' => 0, 'ztype' => 0, 'edulevelvar' => 0, 'edulevel' => 0, 'pink' => $row[9], 'code' => 0, 'outdoor' => $row[8] );

}

}


unset($pdate);
unset($num);
unset($key);
unset($krow);

if (isset($data)) {
foreach ($data as $key => $krow) {
    $pdate[$key]  = $krow['pdate'];
    $num[$key] = $krow['num'];
}

array_multisort($pdate, SORT_DESC, $num, SORT_DESC, $data);

}

//                                                       НАЧАЛО ЦИКЛА ЗАПОЛНЕНИЯ ТАБЛИЦЫ



for ($i=$start; $i < $per_page*($page+1); $i++) { 
	
	if (!$data[$i]["fio"]) {
		break;
	}
?>

<tr>

<td>
<?php // печать даты прохождения
$d = new DateTime($data[$i]["pdate"]);
echo $d->format('d.m.Y');
?>
</td>
<td>

<?php 
if ($onlygia==0) {
?>
<a id='oc<?php echo $data[$i]['id']; ?>'>

<?php
}


echo $data[$i]["num"];

switch ($data[$i]["outdoor"]) {
	case '1':
		echo '&nbsp;&nbsp;&nbsp;<i class="car icon olive tipstatus" data-content="Выезд"></i>';
		break;
	
	case '2':
		echo '&nbsp;&nbsp;&nbsp;<i class="user icon olive tipstatus" data-content="На дому"></i>';
		break;
}


if ($onlygia==0) {
?>
</a>

<?php } ?>


</td>
<td>
<?php

echo $data[$i]["fio"];



?>
</td>
<?php // печать даты рождения
$d = new DateTime($data[$i]["bdate"]);

if(strftime("%m", strtotime($data[$i]["bdate"])) > strftime("%m", strtotime($data[$i]["pdate"])) || strftime("%m", strtotime($data[$i]["bdate"])) == strftime("%m", strtotime($data[$i]["pdate"])) && strftime("%d", strtotime($data[$i]["bdate"])) > strftime("%d", strtotime($data[$i]["pdate"]))) {
$bdatey = (strftime("%G", strtotime($data[$i]["pdate"])) - strftime("%G", strtotime($data[$i]["bdate"])) - 1); 
$bdatem = (strftime("%m", strtotime($data[$i]["pdate"])) - strftime("%m", strtotime($data[$i]["bdate"])) + 12); 
} else {
$bdatey = (strftime("%G", strtotime($data[$i]["pdate"])) - strftime("%G", strtotime($data[$i]["bdate"])));
$bdatem = (strftime("%m", strtotime($data[$i]["pdate"])) - strftime("%m", strtotime($data[$i]["bdate"])));
}

$bdatefin = '';

if ($bdatey > 0) {

switch ($bdatey) {
	case '1':
		$bdatey .= " год ";
		break;

	case '2':
		$bdatey .= " года ";
		break;

	case '3':
		$bdatey .= " года ";
		break;

	case '4':
		$bdatey .= " года ";
		break;

	case '21':
		$bdatey .= " год ";
		break;

	case '22':
		$bdatey .= " года ";
		break;

	case '23':
		$bdatey .= " года ";
		break;

	case '24':
		$bdatey .= " года ";
		break;

	default:
		$bdatey .= " лет ";
		break;
}

$bdatefin .= $bdatey;

}


if ($bdatem > 0) {
	$bdatefin .= $bdatem." мес.";
}

?>


<td class="tipstatus" data-content="<?php echo $bdatefin; ?>" data-position="left center">
<?php
echo $d->format('d.m.Y');
?>
</td>

<td>

<div class="ui equal width center aligned  grid">
<div class="row" style=" margin: 1px; padding: 2px">
<div class="notactive column tipstatus" style=" margin: 1px; padding: 2px" data-content="Наименование услуги">

<?php


switch ($data[$i]["ltype"]) {
	case '0':
		echo "<a class='typechange zakl' id='tc".$data[$i]['id']."' onclick='chtype(".$data[$i]['id'].",1)'>Закл</a>";
		break;

	case '1':
		echo "<a class='typechange cons' id='tc".$data[$i]['id']."' onclick='chtype(".$data[$i]['id'].",0)'>Конс</a>";
		break;

	case '2':
		echo "ГИА";
		break;
}

?>

</div>


<?php


switch ($data[$i]["ltype"]) {
	case '0':
		if ($data[$i]["pink"]==0) {
			$pink = "pink";
		} else {
			$pink = "";
		}
		
		if($data[$i]["specone"]==1) {
			echo '<div class="notactive '.$pink.' column tipstatus" style=" margin: 1px; padding: 2px" data-content="Рекомендовано дообследование">Д</div>';
		} else { 
			echo '<div class="column notactive" style=" margin: 1px; padding: 2px">&nbsp;</div>';
		}
		break;

	case '1':
		echo '<div class="column notactive" style=" margin: 1px; padding: 2px">&nbsp;</div>';
		break;

	case '2':
		$tempvar = $data[$i]["specone"];
		$resulttemp = mysqli_query($link, "SELECT giatype FROM lib_gia_class WHERE id='{$tempvar}' LIMIT 1") or die("ошибка в выборке");
		$rowtemp = mysqli_fetch_row($resulttemp);

		echo '<div class="column notactive" style=" margin: 1px; padding: 2px">'.$rowtemp[0].'</div>';
		break;
}


?>



<div class="<?php if($data[$i]['dolg']==1 && $data[$i]['pink']==0 && $data[$i]['ltype']<>1) {echo 'pink'; } else { echo 'notactive'; } ?> column tipstatus" style=" margin: 1px; padding: 2px"  <?php if($data[$i]['dolg']==1) {echo 'data-content="Имеются задолженности по документам">Долг'; } else { echo '>&nbsp;'; } ?>
</div>



<div class="notactive column tipstatus" style=" margin: 1px; padding: 2px"  <?php if ($data[$i]['ltype']==0) { echo 'data-content="Код программы"'; } else { echo "data-content='Инвалидность'";} ?> >

<?php

switch ($data[$i]['ltype']) {
	case '0':
		

if ($data[$i]['code']=='0' ) {

if ($data[$i]['inv']>0) { 
	echo '<a class="codechange" id="ch'.$data[$i]["id"].'" onclick="chcodenum='.$data[$i]["id"].'">';

	echo "И ";
	if ($data[$i]['inv'] > 3) {
		echo "12";
	} else {
		if ($data[$i]['aoop']==9 && $data[$i]['ztype'] == 4) {
			echo "9.1";
		} elseif ($data[$i]['aoop']==10 && $data[$i]['ztype'] == 4) {
			echo "9.2";
		} else {
			echo $data[$i]['aoop'];
		}
	}
/*
	if ($data[$i]['aoop']<9 && ($data[$i]['ztype'] == 2 || $data[$i]['ztype'] == 4)) {

	if (strripos($data[$i]['dopaoop'], "7") || $data[$i]['dopaoop'] == 7 || $data[$i]['aoop']==5 || $data[$i]['aoop']==7) {
		echo ".2";
	} elseif (strripos($data[$i]['dopaoop'], "9") || $data[$i]['dopaoop']==9) {
		echo ".3";
	} else {
		echo ".1";
	}

	}
*/
} elseif ($data[$i]['aoop']==11) {
	echo "-";
} else {
	echo '<a class="codechange" id="ch'.$data[$i]["id"].'" onclick="chcodenum='.$data[$i]["id"].'">';
	echo "O ";
	if ($data[$i]['aoop']==9 && $data[$i]['ztype'] == 4) {
			echo "9.1";
		} elseif ($data[$i]['aoop']==10 && $data[$i]['ztype'] == 4) {
			echo "9.2";
		} else {
			echo $data[$i]['aoop'];
		}
/*
	if ($data[$i]['aoop']<9 && ($data[$i]['ztype'] == 2 || $data[$i]['ztype'] == 4)) {

	if (strripos($data[$i]['dopaoop'], "7") || $data[$i]['dopaoop'] == 7 || $data[$i]['aoop']==5 || $data[$i]['aoop']==7) {
		echo ".2";
	} elseif (strripos($data[$i]['dopaoop'], "9") || $data[$i]['dopaoop']==9) {
		echo ".3";
	} else {
		echo ".1";
	}
}
*/
}


if ($data[$i]['ztype']==3) {
	echo ".".$data[$i]['edulevelvar'];
}


echo '</a>';

} else {
	echo '<a class="codechange" id="ch'.$data[$i]["id"].'" onclick="chcodenum='.$data[$i]["id"].'">';
	if ($data[$i]['inv']>0) { 
	echo "И ".$data[$i]['code'];
	} else {
	echo "О ".$data[$i]['code'];	
	}
	echo '</a>';
}

	break;

	
	case '1':

if ($data[$i]['inv']>0) { 
	echo "И";
} else {
	echo "&nbsp;";
}

	break;

	case '2':

if ($data[$i]['inv']>0) { 
	echo "И";
} else {
	echo "&nbsp;";
}

	break;
}

?>

</div>




<div class="notactive column tipstatus" style=" margin: 1px; padding: 2px"  data-content="Уровень образования">

<?php

if ($data[$i]['ltype']==2) {

$tempvar = $data[$i]["specone"];
$resulttemp = mysqli_query($link, "SELECT realcalss FROM lib_gia_class WHERE id='{$tempvar}' LIMIT 1") or die("ошибка в выборке");
$rowtemp = mysqli_fetch_row($resulttemp);

echo $rowtemp[0];

} else {

if ($data[$i]['ztype']==1) {
	echo "РП";
} else {
	$tempvar = $data[$i]['edulevel'];
	$result2 = mysqli_query($link, "SELECT shortname FROM lib_edulevel WHERE fb_edulevel='{$tempvar}'") or die("ошибка в выборке ");
	$row2 = mysqli_fetch_row($result2);
	echo $row2[0];
}

}

?>


</div>







<?php 


switch ($data[$i]['ltype']) {
	case '0':

if($data[$i]['pink']>0) {

$finrez = 'data-content="Заключение полностью готово и распечатано"'; 
$fincolor = "green";
$finicon = "checkmark";

} elseif ($data[$i]['specone']==1 || $data[$i]['dolg']==1) {

$finrez = 'data-content="Документы ожидают рассмотрения"'; 
$fincolor = "pink";
$finicon = "help";

} else {

$finrez = 'data-content="Ожидание печати Заключения"'; 
$fincolor = "yellow";
$finicon = "hourglass half";

}
		break;
	
	case '1':

$finrez = 'data-content="Консультация успешно проведена"'; 
$fincolor = "green";
$finicon = "thumbs up";

	break;

	case '2':

if($data[$i]['pink']>0) {

$finrez = 'data-content="Заключение полностью готово и распечатано"'; 
$fincolor = "green";
$finicon = "checkmark";

} elseif ($data[$i]['dolg']==1) {

$finrez = 'data-content="Документы ожидают рассмотрения"'; 
$fincolor = "pink";
$finicon = "help";

} else {

$finrez = 'data-content="Ожидание печати Заключения"'; 
$fincolor = "yellow";
$finicon = "hourglass half";

}

	break;
}

?>

<div class="<?php echo $fincolor; ?> column tipstatus" style=" margin: 1px; padding: 2px; margin-right: 25px" <?php echo $finrez; ?>  >
<i class=" <?php echo $finicon; ?> icon"></i>
</div>

</div>
</div>

</td>

<td style="padding: 3px; margin: 0px; width: 145px">

<?php

if ($data[$i]['ltype']<>2) {

?>

<button class=" blue ui icon button showchild" childid="<?php echo $data[$i]['id']; ?>" id="show<?php echo $data[$i]['id']; ?>" style="opacity: 0.8" title="Просмотр">
<i class="search icon"></i>
</button>

<?php

} else {

?>

<button class=" blue ui icon button showgia" childid="<?php echo $data[$i]['id']; ?>" id="show<?php echo $data[$i]['id']; ?>" style="opacity: 0.8" title="Просмотр">
<i class="search icon"></i>
</button>

<?php

}


switch ($data[$i]['ltype']) {
	case '0':

?>

<a class="orange ui icon button editchild"  childid="<?php echo $data[$i]['id']; ?>" childztype="<?php echo $data[$i]['ztype']; ?>" childaoop="<?php echo $data[$i]['aoop']; ?>" id="show<?php echo $data[$i]['id']; ?>"  style="opacity: 0.8" title="Редактировать">
<i class="edit icon"></i>
</a>

<a class="grey ui icon button printme" id="prnt<?php echo $data[$i]['id']; ?>"  childid="<?php echo $data[$i]['id']; ?>"  style="opacity: 0.8"  title="Печать Заключения">
<i class="print icon"></i>
</a>


<?php

	break;
	
	case '1':

?>

<a class="orange ui icon button editchildc"  childid="<?php echo $data[$i]['id']; ?>" id="show<?php echo $data[$i]['id']; ?>"  style="opacity: 0.8" title="Редактировать">
<i class="edit icon"></i>
</a>

<a class="grey ui icon button printmec" target="_blank"  id="prnt<?php echo $data[$i]['id']; ?>" childid="<?php echo $data[$i]['id']; ?>"  style="opacity: 0.8"  title="Печать Протокола">
<i class="print icon"></i>
</a>

<?php

	break;

	case '2':
?>

<a class="orange ui icon button" href="/lib/tpl/gia.php?id=<?php echo $data[$i]['id']; ?>" style="opacity: 0.8" title="Редактировать">
<i class="edit icon"></i>
</a>

<a class="grey ui icon button printmegia" childid="<?php echo $data[$i]['id']; ?>"  target="_blank" style="opacity: 0.8"  title="Печать Протокола и Заключения">
<i class="print icon"></i>
</a>

<?php

	break;

}
?>

</td>

</tr>

<?php

}

?>


<tr >

<?php

if ($onlygia==0) {
$rezcount3 = mysqli_query($link, "SELECT COUNT(*) FROM fullbase WHERE fb_status=2 $qpdate $qznum $qfio $qbdate $qfilter") or die("ошибка в выборке данных в таблице");
$row_cnt3 = mysqli_fetch_row($rezcount3);
} else {
	$row_cnt3[0]=0;
}


if ($onlyzacl==0) {

$rezcount4 = mysqli_query($link, "SELECT COUNT(*) FROM giabase WHERE gia_status=2 $gqpdate $gqznum $gqfio $gqbdate  $gqfilter") or die("ошибка в выборке данных в таблице");
$row_cnt4 = mysqli_fetch_row($rezcount4);
} else {
	$row_cnt4[0]=0;
}


$total_rows = $row_cnt3[0] + $row_cnt4[0];


$num_pages=ceil($total_rows/$per_page);
if ($num_pages == 0) {

		echo '<th colspan="6" class="center aligned"><br><br><h3>По вашему запросу ничего не найдено. '.$errlog.'</h3><br><br></th>';
} else {

?>

<th colspan="3">
<div class="ui left floated pagination menu" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 3px">

<?php


$j=0;
$k = 0;

if ($num_pages>12) {
	$limitpages = 12;
} else {
	$limitpages = $num_pages;
}

for($i=1;$i<=$limitpages;$i++) {

if ($i-1 == $page) {
echo "<a class='item ui blue basic button'>".$i."</a>";
} else {
echo "<a onclick='beginsearch(".$i.")' class='item'>".$i."</a>";
}

}


?>



</div>
<br><br><br>



<div class="main">
<div id="preview" class="preview" style="display: none">
	<span>1</span>
</div>
<div id="slider" class="sp-slider-wrapper">
<nav>
	<a href="#" class="sp-prev">Предыдущая</a>
	<a href="#" class="sp-next">Следующая</a>
</nav>
</div>
</div>

<script>

;( function( $, window, undefined ) {

	'use strict';

	var globaltotal = <?php if (isset($num_pages)) { echo $num_pages; } else { echo "1"; } ?>;
	var startvalue = <?php if (isset($page)) { echo $page+1; } else { echo "1"; } ?>;

	$.Slider = function( settings, element ) {
		
		this.$el = element;
		this.value = startvalue;
		this.total = globaltotal;
		this.width = settings.width;
		this._create();
	};
	$.Slider.prototype = {
		_create : function() {
			
			var self = this;
			this.slider = this.$el.slider( {
				value : this.value,
				min : 1,
				max : this.total,
				step : 1
			} );
			this.$value = $( '<span>' + this.value + '</span>' );
			this.getHandle().append( this.$value );

		},
		setValue : function( value ) {
			this.value = value;
			this.$value.text( value );
			this.slider.slider( 'value', value );

		},
		getValue : function() {
			return this.value;
		},
		getHandle : function() {
			return this.$el.find( 'a.ui-slider-handle' );
		},
		getSlider : function() {
			return this.slider;
		},
		getSliderEl : function() {
			return this.$el;
		},
		next : function( callback ) {
			if( this.value < this.total ) {
				this.setValue( ++this.value );
				if( callback ) {
					
					callback.call( this, this.value );
					
					beginsearch(this.value);
					
				}
			}
		},
		previous : function( callback ) {
			if( this.value > 1 ) {
				this.setValue( --this.value );
				if( callback ) {
					
					callback.call( this, this.value );
					beginsearch(this.value);
				}
			}
		}
	};

	$.Pagination = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.Pagination.defaults = {
		value : 1,
		total : 5,
		width : 360,
		onChange : function( value ) { return false; },
		onSlide : function( value ) { return false; }
	};

	$.Pagination.prototype = {

		_init : function( options ) {

			// options
			this.options = $.extend( true, {}, $.Pagination.defaults, options );
			var transEndEventNames = {
				'WebkitTransition' : 'webkitTransitionEnd',
				'MozTransition' : 'transitionend',
				'OTransition' : 'oTransitionEnd',
				'msTransition' : 'MSTransitionEnd',
				'transition' : 'transitionend'
			};
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ];
			$.fn.applyStyle = Modernizr.csstransitions ? $.fn.css : $.fn.animate;
			this._layout();
			this._initEvents();

		},
		_layout : function() {

			// next and previous
			this.$navNext = this.$el.find( 'nav > a.sp-next' );
			this.$navPrev = this.$el.find( 'nav > a.sp-prev' );
			// slider
			var $slider = $( '<div class="sp-slider"></div>' ).appendTo( this.$el );
			this.slider = new $.Slider( { value : this.options.value, total : this.options.total, width : this.options.width }, $slider );
			// control if the slider is opened/closed
			this.isSliderOpened = false;
			
		},
		_initEvents : function() {
			
			var self = this;

			this.slider.getHandle().on( 'click', function() {
				
				if( self.isSliderOpened ) {
					return false;
				}
				self.isSliderOpened = true;
				self.slider.getSliderEl().addClass( 'sp-slider-open' );
				// expand slider wrapper
				self.$el.stop().applyStyle( { width : self.options.width }, $.extend( true, [], { duration : '150ms' } ) );
				// hide navigation
				self.toggleNavigation( false );
				return false;

			} );

			this.slider.getSlider().on( {
				'slidestop' : function( event, ui ) {
				
					if( !self.isSliderOpened ) {
						return false;
					}

					var animcomplete = function() {

						self.isSliderOpened = false;
						self.slider.getSliderEl().removeClass( 'sp-slider-open' );
						// show navigation
						self.toggleNavigation( true );
						beginsearch(ui.value);

					};
					self.$el.stop().applyStyle( { width : 0 }, $.extend( true, [], { duration : '150ms', complete : animcomplete } ) ).on( self.transEndEventName, function() {
					
						$( this ).off( self.transEndEventName );
						animcomplete.call();

					} );

					self.options.onChange( ui.value );

				},
				'slide' : function( event, ui ) {
				
					if( !self.isSliderOpened ) {
						return false;
					}
					self.slider.setValue( ui.value );
					self.options.onSlide( ui.value );

				}
			} );

			this.$navNext.on( 'click', function() {

				self.slider.next( function( value ) {
					self.options.onChange( value );
				} );
				return false;

			} );
			this.$navPrev.on( 'click', function() {
				
				self.slider.previous( function( value ) {
					self.options.onChange( value );
				} );
				return false;

			} );

		},
		toggleNavigation : function( toggle ) {
			
			$.fn.render = toggle ? $.fn.show : $.fn.hide;
			this.$navNext.render();
			this.$navPrev.render();

		}

	}

	$.fn.pagination = function( options ) {
		var instance = $.data( this, 'pagination' );
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				instance[ options ].apply( instance, args );
			});
		}
		else {
			this.each(function() {
				instance ? instance._init() : instance = $.data( this, 'pagination', new $.Pagination( options, this ) );
			});
		}
		return instance;
	};

} )( jQuery, window );


			$(function() {

				var $update = $( '#preview > span' );

				$( "#slider" ).pagination( {
					total : 100,
					onChange : function( value ) {
						$update.text( value );
					}
				} );

			});
		</script>

<br>



</th>
<th colspan="3">
<div class="ui "  style="margin: 10px">
Найдено дел: <?php echo $total_rows."<br>"; ?>
</div>

</th>

<?php

}

?>
</tr>

<?php

//                                                      КОНЕЦ ЦИКЛА ЗАПОЛНЕНИЯ ТАБЛИЦЫ

?>

<script type="text/javascript">


$('.checkbox')
.checkbox()
;

$('.radio.checkbox')
  .checkbox()
;

$('.dropdown')
  .dropdown()
; 

$('.modal')
  .modal()
  .modal('setting', 'closable', false)
;

$('.tipstatus')
  .popup()
;


$( ".printme" ).click(function() {

chid = $(this).attr("childid");

$.ajax({
    type: "POST",
    data:{"id":chid }, 
    url: "/lib/printsings.php",
    dataType: "html",            
    success: function(response){
        $(".prntmsg").html("<div style='padding: 20px; margin: 20px' class=''>"+response+"</div>");
    }

});

$('.modal.printsings').modal('show');

});



$( ".printmegia" ).click(function() {

chid = $(this).attr("childid");

$.ajax({
    type: "POST",
    data:{"id":chid }, 
    url: "/lib/printsingsgia.php",
    dataType: "html",            
    success: function(response){
        $(".prntmsggia").html("<div style='padding: 20px; margin: 20px' class=''>"+response+"</div>");
        $('.modal.printsingsgia').modal('refresh');
    }

});

$('.modal.printsingsgia').modal('show');

});





$( ".showchild" ).click(function() {

anketa = "";
anid = $(this).attr("childid");

$.ajax({
    type: "POST",
    data:{"id":anid }, 
    url: "/lib/anketashow.php",
    dataType: "html",            
    success: function(response){
        $(".msg").html("<div style='padding: 20px; margin: 10px' class=''>"+response+"</div>");
		$('.modal.showtime').modal('refresh');
    }

});

$('.modal.showtime').modal('show');

});


$( ".showgia" ).click(function() {

anketa = "";
anid = $(this).attr("childid");

$.ajax({
    type: "POST",
    data:{"id":anid }, 
    url: "/lib/anketashowgia.php",
    dataType: "html",            
    success: function(response){
        $(".msggia").html("<div style='padding: 20px; margin: 10px' class=''>"+response+"</div>");
		$('.modal.showmegia').modal('refresh');
    }

});

$('.modal.showmegia').modal('show');

});



addEventListener("keydown", moveRect);

klite=0;

function moveRect(e){

if (e.keyCode == 45) {
//$('.modal.changecode').modal('show');
klite += 1;
} 

}

$( ".codechange" ).click(function() {


if (klite >= 3) {
$('.modal.changecode').modal('show');

}


});




$( ".editchild" ).click(function() {


chid = $(this).attr("childid");
chztype = $(this).attr("childztype");
chaoop = $(this).attr("childaoop");

goadress = '/index.php?id='+chid+'&ztype='+chztype+'&aoop='+chaoop;


$(this).attr("href", goadress);

});

$( ".editchildc" ).click(function() {

chid = $(this).attr("childid");

goadress = '/lib/tpl/docons.php?cons='+chid;

$(this).attr("href", goadress);

});


$( ".printmec" ).click(function() {

chid = $(this).attr("childid");

goadress = '/lib/tpl/printproto.php?id='+chid+'&ptype=1';

$(this).attr("href", goadress);

});




</script>
