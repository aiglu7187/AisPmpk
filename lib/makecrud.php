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

//echo $fulldata[0]."<br><br>";

$findata = explode(";", $fulldata[0]);

$j = count($findata);

for ($i=0; $i < $j; $i++) { 

	if ($findata[$i] == '' && $i<>34) {
		$findata[$i] = 0;
	}

}



if ($notnew) {

$findata[2] = trim($findata[2]);

$findata[2] = preg_replace("/ {2,}/"," ",$findata[2] );


mysqli_query($link, "UPDATE fullbase SET fb_type='{$findata[0]}',fb_num='{$znum}',fb_date='{$findata[1]}',fb_fio='{$findata[2]}',fb_bdate='{$findata[3]}',fb_invovz='{$findata[4]}',fb_aoop='{$findata[5]}',fb_dopaoop='{$findata[6]}',fb_edulevel='{$findata[7]}',fb_edulevelvar='{$findata[8]}',fb_edurel='{$findata[9]}',fb_eduorg='{$findata[10]}',fb_remote='{$findata[11]}',fb_assist='{$findata[12]}',fb_edumeth='{$findata[13]}',fb_edubook='{$findata[14]}',fb_edunotes='{$findata[15]}',fb_edutech='{$findata[16]}',fb_adapt='{$findata[17]}',fb_block='{$findata[18]}',fb_workspace='{$findata[19]}',fb_orgspace='{$findata[20]}',fb_tutor='{$findata[21]}',fb_workpsy='{$findata[22]}',fb_worklog='{$findata[23]}',fb_workdef='{$findata[24]}',fb_worksoc='{$findata[25]}',fb_otherspec='{$findata[26]}',fb_time='{$findata[27]}',fb_spsy='{$findata[28]}',fb_slog='{$findata[29]}',fb_sdef='{$findata[30]}',fb_ssoc='{$findata[31]}',fb_edulevelvarcase='{$findata[32]}',fb_regionoo='{$findata[33]}',fb_numoo='{$findata[34]}',fb_rdoop='{$findata[35]}',fb_dolg='{$findata[36]}',fb_comtype='{$findata[37]}',fb_roadmap='{$findata[38]}',fb_pol='{$findata[39]}',fb_deviant='{$findata[40]}',fb_bil='{$findata[41]}',fb_place='{$findata[42]}',fb_family='{$findata[43]}',fb_initd='{$findata[44]}',fb_othersign='{$findata[45]}' WHERE id='{$notnew}'") OR die("NIEN 6!");

?>




<a class="ui yellow button" href="/index.php?id=<?php echo $notnew;?>&ztype=<?php echo $findata[0]; ?>&aoop=<?php echo $findata[5]; ?>">Редактировать текущее</a>
<?php echo '<a class="ui green button" href="lib/tpl/printme.php?id='.$notnew.'" target="_blank">Печать бланка Заключения</a>'; ?>
<?php echo '<a class="ui pink button" href="lib/tpl/printme.php?id='.$notnew.'&pinkblank=1" target="_blank">Печать бланка для выдачи</a>'; ?>
<a class="ui orange button" href="lib/tpl/showlist.php">Закрыть</a>

<?php

} else {

$findata[2] = trim($findata[2]);

$findata[2] = preg_replace("/ {2,}/"," ",$findata[2] );


mysqli_query($link, "INSERT INTO fullbase (fb_type,fb_num,fb_date,fb_fio,fb_bdate,fb_invovz,fb_aoop,fb_dopaoop,fb_edulevel,fb_edulevelvar,fb_edurel,fb_eduorg,fb_remote,fb_assist,fb_edumeth,fb_edubook,fb_edunotes,fb_edutech,fb_adapt,fb_block,fb_workspace,fb_orgspace,fb_tutor,fb_workpsy,fb_worklog,fb_workdef,fb_worksoc,fb_otherspec,fb_time,fb_spsy,fb_slog,fb_sdef,fb_ssoc,fb_edulevelvarcase,fb_regionoo,fb_numoo,fb_rdoop,fb_dolg,fb_comtype,fb_roadmap,fb_outdoor,fb_pol,fb_deviant,fb_bil,fb_place,fb_family,fb_initd,fb_othersign) VALUES ('{$findata[0]}',$znum,'{$findata[1]}','{$findata[2]}','{$findata[3]}','{$findata[4]}','{$findata[5]}','{$findata[6]}','{$findata[7]}','{$findata[8]}','{$findata[9]}','{$findata[10]}','{$findata[11]}','{$findata[12]}','{$findata[13]}','{$findata[14]}','{$findata[15]}','{$findata[16]}','{$findata[17]}','{$findata[18]}','{$findata[19]}','{$findata[20]}','{$findata[21]}','{$findata[22]}','{$findata[23]}','{$findata[24]}','{$findata[25]}','{$findata[26]}','{$findata[27]}','{$findata[28]}','{$findata[29]}','{$findata[30]}','{$findata[31]}','{$findata[32]}','{$findata[33]}','{$findata[34]}','{$findata[35]}','{$findata[36]}','{$findata[37]}','{$findata[38]}','{$ter}','{$findata[39]}','{$findata[40]}','{$findata[41]}','{$findata[42]}','{$findata[43]}','{$findata[44]}','{$findata[45]}')") OR die("NIEN!");




$tempresult = mysqli_query($link, "SELECT MAX(id) FROM fullbase WHERE fb_status=2 ") or die("ошибка в выборке ");
$temprow = mysqli_fetch_row($tempresult);

?>


	<a class="ui yellow button" href="/index.php?id=<?php echo $temprow[0];?>&ztype=<?php echo $findata[0]; ?>&aoop=<?php echo $findata[5]; ?>">Редактировать текущее</a>
    <?php echo '<a class="ui green button" href="lib/tpl/printme.php?id='.$temprow[0].'" target="_blank">Печать бланка Заключения</a>'; ?>
    <?php echo '<a class="ui pink button" href="lib/tpl/printme.php?id='.$temprow[0].'&pinkblank=1" target="_blank">Печать бланка для выдачи</a>'; ?>
    <a class="ui orange button" href="lib/tpl/showlist.php">Закрыть</a>

<?php

mysqli_query($link, "UPDATE proto SET status='2' WHERE pr_num='{$znum}' LIMIT 1");


}

?>
