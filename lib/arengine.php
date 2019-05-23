
<?php 

require ('tpl/connect.php');




$bdate = $_POST['bdate'];

$fio = $_POST['fio'];

$qafio = "";
$qfio = "";

$qabdate = "";
$qbdate = "";


if ($fio <> "" && $fio <> null) {
$qafio = " AND ar_fio LIKE '%".$fio."%'";
$qfio = " AND fb_fio LIKE '%".$fio."%'";
}


if ($bdate <> "" && $bdate <> null) {
$qabdate = " AND ar_bdate LIKE '%".$bdate."%'";
$qbdate = " AND fb_bdate LIKE '%".$bdate."%'";
}




$result = mysqli_query($link, "SELECT fb_date, fb_num, fb_fio, fb_bdate, fb_aoop, fb_dopaoop, fb_numoo, fb_edulevel FROM fullbase WHERE fb_status=2 $qfio $qbdate ORDER BY fb_date DESC") or die("ошибка в выборке данных в таблице");

while ($row = mysqli_fetch_row($result)) {
?>  



<tr>

<td>
<?php // печать даты прохождения
$d = new DateTime($row[0]);
echo $d->format('d.m.Y');
?>
</td>
<td>
<?php

echo $row[1];

?>
</td>
<td>
<?php

echo $row[2];

?>
</td>

<td>
<?php // печать даты рождения
$d = new DateTime($row[3]);
echo $d->format('d.m.Y');
?>
</td>



<td>
<?php // АООП

unset($pdopaoop);


if ($row[5] <> 0) {

		$prntaoop = " с учетом ";

		if (strlen($row[5])>1) {
			$pdopaoop = explode(",", $row[5]);
		} else {
				$pdopaoop[0] = $row[5];
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


$tempresult = mysqli_query($link, "SELECT tipname FROM lib_op WHERE status=1 AND id_op = $row[4]") or die("ошибка в выборке обр прог");
$temprow = mysqli_fetch_row($tempresult);
if ($temprow[0] == "") {
echo "Конс.";
} else {
echo $temprow[0].$prntaoop;
}

$tempresult = mysqli_query($link, "SELECT shortname FROM lib_edulevel WHERE status=1 AND fb_edulevel = $row[7]") or die("ошибка в выборке возраста");
$temprow = mysqli_fetch_row($tempresult);
echo " (".$temprow[0].")";



?>
</td>


<td>
<?php

echo $row[6];

?>
</td>

</tr>


<?php

}





$result = mysqli_query($link, "SELECT ar_date, ar_number, ar_fio, ar_bdate, ar_aoop, ar_edulevelvar, ar_oo FROM archive WHERE status=1 $qafio $qabdate ORDER BY ar_date DESC") or die("ошибка в выборке данных в таблице");

while ($row = mysqli_fetch_row($result)) {
?>  



<tr>

<td>
<?php // печать даты прохождения
$d = new DateTime($row[0]);
echo $d->format('d.m.Y');
?>
</td>
<td>
<?php

echo $row[1];

?>
</td>
<td>
<?php

echo $row[2];

?>
</td>

<td>
<?php // печать даты рождения
$d = new DateTime($row[3]);
echo $d->format('d.m.Y');
?>
</td>



<td>
<?php // АООП

unset($pdopaoop);

if ($row[5]<>null) {

echo $row[4]." (".$row[5].")";

} else {
	echo $row[4];
}

?>
</td>


<td>
<?php

echo $row[6];

?>
</td>

</tr>


<?php

}

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


</script>
