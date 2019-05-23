<?php


require ('tpl/connect.php');

$checkfio = $_POST['checkfio'];
$checkbdate = $_POST['checkbdate'];
if ($_POST['notnew']) {
	$notnew = "AND id <> ".$_POST['notnew'];
} else {
	$notnew = "";
}

$checkfio = '%'.trim($checkfio).'%';


$rezcount = mysqli_query($link, "SELECT COUNT(*) FROM archive WHERE ar_fio LIKE '{$checkfio}' AND ar_bdate='{$checkbdate}'") or die("ошибка в выборке данных в таблице 1");
$row_cnt = mysqli_fetch_row($rezcount);

$rezcount2 = mysqli_query($link, "SELECT COUNT(*) FROM fullbase WHERE fb_fio LIKE '{$checkfio}' AND fb_bdate='{$checkbdate}' $notnew") or die("ошибка в выборке данных в таблице 2");
$row_cnt2 = mysqli_fetch_row($rezcount2);


if ($row_cnt[0]>0 || $row_cnt2[0]>0) {

if ($row_cnt[0]>0) {

$result = mysqli_query($link, "SELECT * FROM archive WHERE ar_fio LIKE '{$checkfio}' AND ar_bdate='{$checkbdate}' $notnew ORDER BY ar_date ASC") or die("ошибка в выборке данных в таблице 3");

echo '<div class="item">Найденные дела в архиве:</div>';


while ($row = mysqli_fetch_row($result)) {

$date = new DateTime($row[1]);
$bdate = new DateTime($row[8]);

$tipdata = '';

$tipdata .= "<ul style='width: 450px'>";

$tipdata .= "<li>";
$tipdata .= "ФИО: <b>".trim($row[4]);
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Дата рождения: <b>".$bdate->format('d.m.Y');
$tipdata .= "</b></li>";

$tipdata .= "<li>";
if ($row[2]==0) {
	$inv = "Нет";
} else {
	$inv = "Да";
}
$tipdata .= "Наличие инвалидности: <b>".$inv;
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Номер протокола/заключения: <b>".trim($row[3]);
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Дата прохождения комиссии: <b>".$date->format('d.m.Y');
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Тип услуги: <b>".trim($row[11]);
$tipdata .= "</b></li>";

if ($row[12] <> null) {
$tipdata .= "<li>";
$tipdata .= "Вариант АООП: <b>".trim($row[12]);
$tipdata .= "</b></li>";
}

$tipdata .= "<li>";
$tipdata .= "Уровень образования: <b>".trim($row[10]);
$tipdata .= "</b></li>";

$tipdata .= "<li>";
$tipdata .= "Образовательная организация: <b>".trim($row[9]);
$tipdata .= "</b></li>";




$tipdata .= "</ul>";

echo '<a class="item tips" data-html="'.$tipdata.'">'.$date->format('d.m.Y').'г.</a>';



}

?>

<script type="text/javascript">
	$('#oldcases').show();
	//$('.tips').popup();

	$('.tips').popup({
    setFluidWidth: false
  })
;
</script>

<?php

}



if ($row_cnt2[0]>0) {


$result = mysqli_query($link, "SELECT id, fb_date FROM fullbase WHERE fb_fio LIKE '{$checkfio}' AND fb_bdate='{$checkbdate}' $notnew ORDER BY fb_date ASC ") or die("ошибка в выборке данных в таблице 4");


echo '<div class="item">Найденные дела в базе:</div>';


while ($row = mysqli_fetch_row($result)) {

$date = new DateTime($row[1]);

echo '<a class="item tips showchild" data-html="Щелкните для просмотра" childid="'.$row[0].'" id="show'.$row[0].'">'.$date->format('d.m.Y').'г.</a>';



}

?>

<script type="text/javascript">

$('#oldcases').show();

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

</script>




<div class="ui modal showtime">
  <div class="actions ">
    <div class="ui orange button ok floated right">X</div>
  </div>

  <div class="msg">
    
  </div>

</div>


<?php


}




} else {

?>

<script type="text/javascript">
$('#oldcases').hide();
</script>

<?php

}





?>

