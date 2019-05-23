<?php

require ('connect.php');

if ($_SESSION['ter']) {
	$ter = $_SESSION['ter'];
} else {
	$ter = 0;
}

$fulldata = $_POST['fulldata'];
$znum = $_POST['znum'];
$notnew = $_POST['notnew'];
$giareason = $_POST['giareason'];
$score = $_POST['score'];

str_replace(chr(13),'',$znum);
str_replace(chr(10),'',$znum);


//echo $fulldata[0]."<br><br>";

$findata = explode(";", $fulldata[0]);

$j = count($findata);

for ($i=0; $i < $j; $i++) {

	if ($findata[$i] == '') {
		$findata[$i] = 0;
	}

}

if ($findata[3]=="0") {

	$findata[3]="совершеннолетний";
}

if ($findata[9]==0) {
	$findata[9]="1000-01-01";
}

if ($findata[11]==0) {
	$findata[11]="1000-01-01";
}



if ($notnew) {

$findata[3] = trim($findata[3]);
$findata[3] = preg_replace("/ {2,}/"," ",$findata[3] );


$findata[4] = trim($findata[4]);
$findata[4] = preg_replace("/ {2,}/"," ",$findata[4] );



mysqli_query($link, "UPDATE giabase SET gia_date='{$findata[0]}',gia_place='{$findata[1]}',gia_form='{$findata[2]}',gia_parent='{$findata[3]}',gia_fio='{$findata[4]}',gia_bdate='{$findata[5]}',gia_adress='{$findata[6]}',gia_docs='{$findata[7]}',gia_msenum='{$findata[8]}',gia_msedate='{$findata[9]}',gia_vk='{$findata[10]}',gia_vkdate='{$findata[11]}',gia_medname='{$findata[12]}',gia_code='{$findata[13]}',gia_ooname='{$findata[14]}',gia_ooregion='{$findata[15]}',gia_oofio='{$findata[16]}',gia_ooprof='{$findata[17]}',gia_ootel='{$findata[18]}',gia_class='{$findata[19]}',gia_eduaoop='{$findata[20]}',gia_eduform='{$findata[21]}',gia_eduorg='{$findata[22]}',gia_edurel='{$findata[23]}',gia_spec='{$findata[24]}',gia_litrus='{$findata[25]}',gia_litmat='{$findata[26]}',gia_kim='{$findata[27]}',gia_workplace='{$findata[28]}',gia_assist='{$findata[29]}',gia_typogr='{$findata[30]}',gia_ppe='{$findata[31]}',gia_dolg='{$findata[32]}',gia_spsy1='{$findata[33]}',gia_spsy2='{$findata[34]}',gia_slog='{$findata[35]}',gia_sdef='{$findata[36]}',gia_ssoc='{$findata[37]}',gia_reason='{$giareason}',gia_score='{$score}',gia_pol='{$findata[38]}',gia_family='{$findata[39]}',gia_initd='{$findata[40]}' WHERE id='{$notnew}'") OR die("NIEN 6!");

?>




<a class="ui yellow button" href="/lib/tpl/gia.php?id=<?php echo $notnew; ?>">Редактировать текущее</a>
<?php echo '<a class="ui green button" href="/lib/tpl/printgiaproto.php?id='.$notnew.'" target="_blank">Печать Протокола и Заключения</a>'; ?>
<a class="ui orange button" href="/lib/tpl/showlist.php">Закрыть</a>

<?php

} else {



$findata[3] = trim($findata[3]);
$findata[3] = preg_replace("/ {2,}/"," ",$findata[3] );


$findata[4] = trim($findata[4]);
$findata[4] = preg_replace("/ {2,}/"," ",$findata[4] );


mysqli_query($link, "INSERT INTO giabase (gia_num,gia_date,gia_place,gia_form,gia_parent,gia_fio,gia_bdate,gia_adress,gia_docs,gia_msenum,gia_msedate,gia_vk,gia_vkdate,gia_medname,gia_code,gia_ooname,gia_ooregion,gia_oofio,gia_ooprof,gia_ootel,gia_class,gia_eduaoop,gia_eduform,gia_eduorg,gia_edurel,gia_spec,gia_litrus,gia_litmat,gia_kim,gia_workplace,gia_assist,gia_typogr,gia_ppe,gia_dolg,gia_spsy1,gia_spsy2,gia_slog,gia_sdef,gia_ssoc,gia_reason,gia_outdoor, gia_score,gia_pol,gia_family,gia_initd) VALUES ($znum,'{$findata[0]}','{$findata[1]}','{$findata[2]}','{$findata[3]}','{$findata[4]}','{$findata[5]}','{$findata[6]}','{$findata[7]}','{$findata[8]}','{$findata[9]}','{$findata[10]}','{$findata[11]}','{$findata[12]}','{$findata[13]}','{$findata[14]}','{$findata[15]}','{$findata[16]}','{$findata[17]}','{$findata[18]}','{$findata[19]}','{$findata[20]}','{$findata[21]}','{$findata[22]}','{$findata[23]}','{$findata[24]}','{$findata[25]}','{$findata[26]}','{$findata[27]}','{$findata[28]}','{$findata[29]}','{$findata[30]}','{$findata[31]}','{$findata[32]}','{$findata[33]}','{$findata[34]}','{$findata[35]}','{$findata[36]}','{$findata[37]}','{$giareason}','{$ter}','{$score}','{$findata[38]}','{$findata[39]}','{$findata[40]}')") OR die("NIEN!");



$tempresult = mysqli_query($link, "SELECT MAX(id) FROM giabase WHERE gia_status=2 ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);

?>


	<a class="ui yellow button" href="/lib/tpl/gia.php?id=<?php echo $temprow[0];?>">Редактировать текущее</a>
    <?php echo '<a class="ui green button" href="/lib/tpl/printgiaproto.php?id='.$temprow[0].'" target="_blank">Печать Протокола и Заключения</a>'; ?>
    <a class="ui orange button" href="/lib/tpl/showlist.php">Закрыть</a>

<?php

//mysqli_query($link, "UPDATE proto SET status='2' WHERE pr_num='{$znum}' LIMIT 1");


 }

?>
