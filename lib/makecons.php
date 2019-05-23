<?php

require ('connect.php');

if ($_SESSION['ter']) {
	$ter = $_SESSION['ter'];
} else {
	$ter = 0;
}

$fulldata = $_POST['blockdata'];

$strite = $_POST['strite'];

$notnew = $_POST['notnew'];

$zdate = $_POST['zdate'];

//echo $fulldata[0]."<br><br>";

$findata = explode(";", $fulldata[0]);

$i = 0;
$j = count($findata);

for ($i=0; $i < $j; $i++) { 

	if ($findata[$i] == '' && $i<>4) {
		$findata[$i] = 0;
	}

}

if ($zdate) {
$cdate = $zdate;
} else {
$cdate = date("Y-m-d");
}

if ($strite==1) {

if ($notnew) {

$findata[1] = trim($findata[1]);

$findata[1] = preg_replace("/ {2,}/"," ",$findata[1] );

	mysqli_query($link, "UPDATE fullbase SET fb_date='{$cdate}', fb_fio='{$findata[1]}', fb_bdate='{$findata[2]}', fb_regionoo='{$findata[3]}', fb_numoo='{$findata[4]}', fb_invovz='{$findata[5]}', fb_spsy='{$findata[6]}', fb_slog='{$findata[7]}', fb_sdef='{$findata[8]}', fb_ssoc='{$findata[9]}', fb_edulevel='{$findata[10]}', fb_comtype='{$findata[11]}' WHERE id='{$notnew}'") OR die("NIEN! 3");

	echo $notnew;

} else {

$findata[1] = trim($findata[1]);

$findata[1] = preg_replace("/ {2,}/"," ",$findata[1] );

mysqli_query($link, "INSERT INTO fullbase (fb_type,fb_num,fb_date,fb_fio,fb_bdate,fb_invovz,fb_aoop,fb_dopaoop,fb_edulevel,fb_edulevelvar,fb_edurel,fb_eduorg,fb_remote,fb_assist,fb_edumeth,fb_edubook,fb_edunotes,fb_edutech,fb_adapt,fb_block,fb_workspace,fb_orgspace,fb_tutor,fb_workpsy,fb_worklog,fb_workdef,fb_worksoc,fb_otherspec,fb_time,fb_spsy,fb_slog,fb_sdef,fb_ssoc,fb_edulevelvarcase,fb_regionoo,fb_numoo,fb_rdoop,fb_dolg, fb_consult, fb_comtype, fb_outdoor) VALUES ('0',$findata[0],'{$cdate}','{$findata[1]}','{$findata[2]}','{$findata[5]}','0','0','{$findata[10]}','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','{$findata[6]}','{$findata[7]}','{$findata[8]}','{$findata[9]}','0','{$findata[3]}','{$findata[4]}','0','0','1','{$findata[11]}','{$ter}')") OR die("NIEN!");


	$tempresult = mysqli_query($link, "SELECT MAX(id) FROM fullbase WHERE fb_status=2") or die("ошибка в выборке ");
	$temprow = mysqli_fetch_row($tempresult);
	echo $temprow[0];
}

} else {


$result = mysqli_query($link, "SELECT pr_num, pr_fio, pr_bdate, pr_regionoo, pr_numoo, pr_inv FROM proto WHERE id_proto=$findata[4]") or die("ошибка");
$row = mysqli_fetch_row($result);

// СДЕЛАТЬ № ЗАКЛЮЧЕНИЯ fb_num

$row[1] = trim($row[1]);

$row[1] = preg_replace("/ {2,}/"," ",$row[1] );

mysqli_query($link, "INSERT INTO fullbase (fb_type,fb_num,fb_date,fb_fio,fb_bdate,fb_invovz,fb_aoop,fb_dopaoop,fb_edulevel,fb_edulevelvar,fb_edurel,fb_eduorg,fb_remote,fb_assist,fb_edumeth,fb_edubook,fb_edunotes,fb_edutech,fb_adapt,fb_block,fb_workspace,fb_orgspace,fb_tutor,fb_workpsy,fb_worklog,fb_workdef,fb_worksoc,fb_otherspec,fb_time,fb_spsy,fb_slog,fb_sdef,fb_ssoc,fb_edulevelvarcase,fb_regionoo,fb_numoo,fb_rdoop,fb_dolg, fb_consult, fb_comtype, fb_outdoor) VALUES ('0',$row[0],'{$cdate}','{$row[1]}','{$row[2]}','{$row[5]}','0','0','{$findata[5]}','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','{$findata[0]}','{$findata[1]}','{$findata[2]}','{$findata[3]}','0','{$row[3]}','{$row[4]}','0','0','1','{$findata[6]}','{$ter}')") OR die("NIEN!");

//$tempresult = mysqli_query($link, "SELECT MAX(id) FROM fullbase WHERE fb_status=2 ") or die("ошибка в выборке ");
//$temprow = mysqli_fetch_row($tempresult);

mysqli_query($link, "UPDATE proto SET status='2' WHERE id_proto='{$findata[4]}'");

echo "Консультация успешно сохранена!";

}




?>
