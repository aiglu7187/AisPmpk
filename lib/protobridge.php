<?php

if ($proto) {


$editmode=1;

$presult = mysqli_query($link, "SELECT * FROM proto WHERE status=1 AND id_proto=$proto LIMIT 1") or die("ошибка в выборе протокола");

$prow = mysqli_fetch_row($presult);

} 


if ($id) {

$mainedit=1;

$presult = mysqli_query($link, "SELECT * FROM fullbase WHERE id=$id LIMIT 1") or die("ошибка в выборе заключения");

$mrow = mysqli_fetch_row($presult);

} 

?>