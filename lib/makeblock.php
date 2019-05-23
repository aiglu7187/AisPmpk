<?php


require ('tpl/connect.php');


$blockdata = $_POST['blockdata'];
$notnew =  $_POST['notnew'];


$findata = explode(";", $blockdata[0]);

$i = 0;
$j = count($findata);

for ($i=0; $i < $j; $i++) { 

	if ($findata[$i] == '' && $i<>4) {
		$findata[$i] = 0;
	}

}

if ($notnew) {


	mysqli_query($link, "UPDATE proto SET pr_fio='{$findata[1]}', pr_bdate='{$findata[2]}', pr_regionoo='{$findata[3]}', pr_numoo='{$findata[4]}', pr_inv='{$findata[5]}', pr_dolg='{$findata[6]}' WHERE id_proto='{$notnew}'") OR die("NIEN! 2");

	echo $notnew;

} else {

mysqli_query($link, "INSERT INTO proto (pr_num, pr_fio, pr_bdate, pr_regionoo, pr_numoo, pr_inv, pr_dolg) VALUES ($findata[0],'{$findata[1]}','{$findata[2]}','{$findata[3]}','{$findata[4]}','{$findata[5]}','{$findata[6]}')") OR die("NIEN!");

	$tempresult = mysqli_query($link, "SELECT MAX(id_proto) FROM proto WHERE status=1 ") or die("ошибка в выборке ");
	$temprow = mysqli_fetch_row($tempresult);
	echo $temprow[0];
}


?>
