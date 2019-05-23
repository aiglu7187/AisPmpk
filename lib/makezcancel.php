<?php


require ('/tpl/connect.php');

$jid = $_POST['jid'];

if (!$jid) {

$blockdata = $_POST['cblockdata'];


$findata = explode(";", $blockdata[0]);

$i = 0;
$j = count($findata);

for ($i=0; $i < $j; $i++) { 

	if ($findata[$i] == '') {
		$findata[$i] = 0;
	}

}



mysqli_query($link, "INSERT INTO zcancel (zc_name, zc_bdate, zc_reason) VALUES ('{$findata[0]}','{$findata[1]}','{$findata[2]}')") OR die("NIEN!");


} else {


$reason = $_POST['reason'];

$result = mysqli_query($link, "SELECT pr_fio, pr_bdate, pr_num FROM proto WHERE id_proto='{$jid}'") or die("ошибка");
$row = mysqli_fetch_row($result);

mysqli_query($link, "INSERT INTO zcancel (zc_name, zc_bdate, zc_reason) VALUES ('{$row[0]}','{$row[1]}','{$reason}')") OR die("NIEN! 2");

mysqli_query($link, "UPDATE proto SET status='2' WHERE id_proto='{$jid}'");

mysqli_query($link, "INSERT INTO zfreenumber (freenumber) VALUES ('{$row[2]}')") OR die("NIEN! 3");

}


?>
