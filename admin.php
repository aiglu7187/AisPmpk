<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>

<style type="text/css">
  
.price {
  color: #eee !important;
}

.item.active {
	background-color: #a7d997 !important;
}

.label {
	background-color: #d5ecf1 !important;
}

td {
	padding-top: 2px !important;
	padding-bottom: 2px !important;
}

</style>

</head>

<body>


<?php
require ('lib/connect.php');


echo "<br><br>";

?>


<!-- Меню -->
<div class="ui stackable container">



<div class="ui top attached tabular menu">
  <a class="item active" data-tab="first">Общие данные</a>
  <a class="item" data-tab="second">Специалисты</a>
  <a class="item" data-tab="third">Библиотека</a>

  <a class="item" href="index.php">Выход</a>
</div>

<?php
$result = mysqli_query($link, "SELECT * FROM conf LIMIT 1") or die("ошибка в выборке ФИО");
$row = mysqli_fetch_row($result);
?>



<div class="ui bottom attached tab segment active" data-tab="first">

<div class="row">
<div class=" column">

<div class="ui fluid labeled input">
<div class="ui label" style="width: 300px">
Полное наименование ПМПК<br>(идет в шапку на бланк)
</div>
<textarea rows="4" id="pmpkname" name="pmpkname" type="text" style="width: 100%; padding: 12px" placeholder="" ><?php echo $row[1]; ?>
</textarea>
</div>
</div>
<br>
</div>

<?php
$result2 = mysqli_query($link, "SELECT fullname FROM lib_sboss LIMIT 1") or die("ошибка в выборке ");
$row2 = mysqli_fetch_row($result2);
?>


<div class="row">
<div class=" column">

<div class="ui fluid labeled input">
<div class="ui label"  style="width: 300px">
ФИО руководителя ПМПК
</div>
<input id="bossname" name="bossname" type="text" style="width: 100%" placeholder="" value="<?php echo $row2[0]; ?>">
</div>
</div>
<br>
</div>

<?php
$result3 = mysqli_query($link, "SELECT * FROM znumber LIMIT 1") or die("ошибка в выборке ");
$row3 = mysqli_fetch_row($result3);
?>

<div class="ui stackable three column grid ">

<div class=" column">
<div class="ui fluid labeled input">
<div class="ui label">
Текущий год
</div>
<input id="pyear" name="pyear" maxlength="4" type="text" style="width: 100%" placeholder="" value="<?php echo $row3[1]; ?>">
</div>
</div>

<div class=" column">
<div class="ui fluid labeled input">
<div class="ui label">
Текущий № Заключения
</div>
<input id="pnum" name="pnum" type="text" maxlength="7" style="width: 100%" placeholder="" value="<?php echo $row3[2]; ?>">
</div>
</div>

<div class=" column">
<div class="ui fluid labeled input">
<div class="ui label">
Аббревиатура бланка 
</div>
<input id="pabbr" name="pabbr" type="text" maxlength="6" style="width: 100%" placeholder="" value="<?php echo $row[2]; ?>">
</div>
</div>

<br>

</div>
<br>
<hr>



<div class="ui stackable three column grid ">
<div class=" column">
<div class="inline field">
<div class="ui toggle checkbox ">
<input id="hidehead" name="hidehead" type="checkbox" tabindex="0" class="hidden" <?php if($row[3]==1) {echo "checked"; } ?> > 
<label>Скрывать шапку на бланке для выдачи</label>
</div>
</div>
</div>


<div class=" column">
<div class="inline field">
<div class="ui toggle checkbox ">
<input id="hidecode" name="hidecode" type="checkbox" tabindex="0" class="hidden" <?php if($row[4]==1) {echo "checked"; } ?> > 
<label>Печать кода программы под шапкой</label>
</div>
</div>
</div>

<div class=" column">
<div class="inline field">
<div class="ui toggle checkbox ">
<input id="hidesec" name="hidesec" type="checkbox" tabindex="0" class="hidden" <?php if($row[5]==1) {echo "checked"; } ?> > 
<label>Печать защитного кода бланка выдачи</label>
</div>
</div>
</div>


</div>


<div class="ui stackable three column grid ">

<div class=" column">
<button class="ui positive button savemain"><i class="icon save"></i>Сохранить</button>
</div>

<div class=" column">
<div id="msg" style="color: green; font-size: 16px"></div>
</div>

<div class=" column" style="text-align: right;">
<a href="admin.php" class="ui orange basic button"><i class="icon erase"></i>Очистить</a>
</div>

</div>

</div>














<div class="ui bottom attached tab segment" data-tab="second">

<h3>Педагог-психолог</h3>


<div class=" column">

<table class="ui celled table striped ">
  <thead>
    <tr>
<th>ФИО специалиста</th>
<th width="200px"><button class="ui positive basic button addpsy"><i class="icon plus"></i>Добавить</button></th>  
</tr></thead>

<tbody id="maintablepsy">  	
<?php

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role FROM users WHERE profession=1 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="1"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}

?>
</tbody>

</table>

</div>


<h3>Учитель-логопед</h3>


<div class=" column">

<table class="ui celled table striped ">
  <thead>
    <tr>
<th>ФИО специалиста</th>
<th width="200px"><button class="ui positive basic button addlog"><i class="icon plus"></i>Добавить</button></th>  
</tr></thead>

<tbody id="maintablelog">  	
<?php

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=2 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="2"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}

?>
</tbody>

</table>

</div>


<h3>Учитель-дефектолог</h3>


<div class=" column">

<table class="ui celled table striped ">
  <thead>
    <tr>
<th>ФИО специалиста</th>
<th width="200px"><button class="ui positive basic button adddef"><i class="icon plus"></i>Добавить</button></th>  
</tr></thead>

<tbody id="maintabledef">  	
<?php

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=3 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="3"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}

?>
</tbody>

</table>

</div>


<h3>Социальный педагог</h3>


<div class=" column">

<table class="ui celled table striped ">
  <thead>
    <tr>
<th>ФИО специалиста</th>
<th width="200px"><button class="ui positive basic button addsoc"><i class="icon plus"></i>Добавить</button></th>  
</tr></thead>

<tbody id="maintablesoc">
<?php

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=4 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="4"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}

?>
</tbody>

</table>

</div>


<h3>Иные специалисты</h3>


<div class=" column">

<table class="ui celled table striped ">
  <thead>
    <tr>
<th>ФИО специалиста</th>
<th>Должность</th>
<th width="200px"><button class="ui positive basic button addoth"><i class="icon user"></i>Добавить</button></th>  
</tr></thead>

<tbody id="maintableoth">  	
<?php

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, other_prof, role FROM users WHERE profession=0 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[5]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td>'.$row[4].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="0" id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}

?>
</tbody>

</table>

</div>



</div>
















<div class="ui bottom attached tab segment " data-tab="third">

В доработке...

</div>






</div>







<div class="ui modal modpsy">
  
  <div class="header green">
    Добавление педагога-психолога
  </div>
  <div class="image content">

    <div class="description ui stackable three column grid">


<div class="row">
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="psyname1" id="psyname1" value="" placeholder="Фамилия">
 </div>
 </div>
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="psyname2" id="psyname2" value="" placeholder="Имя">
 </div>
 </div>
  <div class="column">
<div class="ui fluid input">
	<input type="text" name="psyname3" id="psyname3" value="" placeholder="Отчество">
 </div>
</div>
 </div>

     </div>
  </div>
  <div class="actions finbutton">
  	<a class="ui basic green button" id="savepsy" onclick="">Сохранить</a>
    <a class="ui basic red button" onclick="$('.modal').modal('hide');" >Закрыть</a>
  </div>
</div>





<div class="ui modal modlog">
  
  <div class="header green">
    Добавление учителя-логопеда
  </div>
  <div class="image content">

    <div class="description ui stackable three column grid">


<div class="row">
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="logname1" id="logname1" value="" placeholder="Фамилия">
 </div>
 </div>
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="logname2" id="logname2" value="" placeholder="Имя">
 </div>
 </div>
  <div class="column">
<div class="ui fluid input">
	<input type="text" name="logname3" id="logname3" value="" placeholder="Отчество">
 </div>
</div>
 </div>

     </div>
  </div>
  <div class="actions finbutton">
  	<a class="ui basic green button" id="savelog" onclick="">Сохранить</a>
    <a class="ui basic red button" onclick="$('.modal').modal('hide');" >Закрыть</a>
  </div>
</div>






<div class="ui modal moddef">
  
  <div class="header green">
    Добавление учителя-дефектолога
  </div>
  <div class="image content">

    <div class="description ui stackable three column grid">


<div class="row">
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="defname1" id="defname1" value="" placeholder="Фамилия">
 </div>
 </div>
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="defname2" id="defname2" value="" placeholder="Имя">
 </div>
 </div>
  <div class="column">
<div class="ui fluid input">
	<input type="text" name="defname3" id="defname3" value="" placeholder="Отчество">
 </div>
</div>
 </div>

     </div>
  </div>
  <div class="actions finbutton">
  	<a class="ui basic green button" id="savedef" onclick="">Сохранить</a>
    <a class="ui basic red button" onclick="$('.modal').modal('hide');" >Закрыть</a>
  </div>
</div>








<div class="ui modal modsoc">
  
  <div class="header green">
    Добавление социального педагога
  </div>
  <div class="image content">

    <div class="description ui stackable three column grid">


<div class="row">
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="socname1" id="socname1" value="" placeholder="Фамилия">
 </div>
 </div>
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="socname2" id="socname2" value="" placeholder="Имя">
 </div>
 </div>
  <div class="column">
<div class="ui fluid input">
	<input type="text" name="socname3" id="socname3" value="" placeholder="Отчество">
 </div>
</div>
 </div>

     </div>
  </div>
  <div class="actions finbutton">
  	<a class="ui basic green button" id="savesoc" onclick="">Сохранить</a>
    <a class="ui basic red button" onclick="$('.modal').modal('hide');" >Закрыть</a>
  </div>
</div>






<div class="ui modal modoth">
  
  <div class="header green">
    Добавление иного члена комиссии
  </div>
  <div class="image content">

    <div class="description ui stackable three column grid">


<div class="row">
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="othname1" id="othname1" value="" placeholder="Фамилия">
 </div>
 </div>
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="othname2" id="othname2" value="" placeholder="Имя">
 </div>
 </div>
  <div class="column">
<div class="ui fluid input">
	<input type="text" name="othname3" id="othname3" value="" placeholder="Отчество">
 </div>
</div>
 </div>

<div class="row">

<div class="column">
<div class="ui fluid input">
	<input type="text" name="prof" id="prof" value="" placeholder="Профессия">
 </div>
</div>

</div>


     </div>
  </div>
  <div class="actions finbutton">
  	<a class="ui basic green button" id="saveoth" onclick="">Сохранить</a>
    <a class="ui basic red button" onclick="$('.modal').modal('hide');" >Закрыть</a>
  </div>
</div>





<div class="ui modal modedt" id="modedt">
  
  

</div>



<div class="ui modal moddel">
  
  <div class="header green">
    Удаление члена комиссии
  </div>
  <div class="image content">

    <div class="description ui stackable one column grid">


<div class="row">
 <div class="column">
<h3>Подтвердите удаление</h3>
 </div>

     </div>
  </div>
  <div class="actions finbutton">
  	<a class="ui basic green button" id="deluser" onclick="delme()">Удалить</a>
    <a class="ui basic red button" onclick="$('.modal').modal('hide');" >Отмена</a>
  </div>
</div>









<script type="text/javascript">



$( ".addpsy" ).click(function() {

$('.modpsy').modal('show');

});


$( ".addlog" ).click(function() {

$('.modlog').modal('show');

});

$( ".adddef" ).click(function() {

$('.moddef').modal('show');

});

$( ".addsoc" ).click(function() {

$('.modsoc').modal('show');

});

$( ".addoth" ).click(function() {

$('.modoth').modal('show');

});


$( "#savepsy" ).click(function() {

namef = $('#psyname1').val();
namei = $('#psyname2').val();
nameo = $('#psyname3').val();

$.ajax({
    type: "POST",
    data:{"namef":namef, "namei":namei, "nameo":nameo, "act":'1'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		$('#maintablepsy').html(response);
    }

});
$('#psyname1').val("");
$('#psyname2').val("");
$('#psyname3').val("");
$('.modal.modpsy').modal('hide');


});



$( "#savelog" ).click(function() {

namef = $('#logname1').val();
namei = $('#logname2').val();
nameo = $('#logname3').val();

$.ajax({
    type: "POST",
    data:{"namef":namef, "namei":namei, "nameo":nameo, "act":'2'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		$('#maintablelog').html(response);
    }

});
$('#logname1').val("");
$('#logname2').val("");
$('#logname3').val("");
$('.modal.modlog').modal('hide');


});



$( "#savedef" ).click(function() {

namef = $('#defname1').val();
namei = $('#defname2').val();
nameo = $('#defname3').val();

$.ajax({
    type: "POST",
    data:{"namef":namef, "namei":namei, "nameo":nameo, "act":'3'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		$('#maintabledef').html(response);
    }

});
$('#defname1').val("");
$('#defname2').val("");
$('#defname3').val("");
$('.modal.moddef').modal('hide');


});





$( "#savesoc" ).click(function() {

namef = $('#socname1').val();
namei = $('#socname2').val();
nameo = $('#socname3').val();

$.ajax({
    type: "POST",
    data:{"namef":namef, "namei":namei, "nameo":nameo, "act":'4'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		$('#maintablesoc').html(response);
    }

});
$('#socname1').val("");
$('#socname2').val("");
$('#socname3').val("");
$('.modal.modsoc').modal('hide');


});






$( "#saveoth" ).click(function() {

namef = $('#othname1').val();
namei = $('#othname2').val();
nameo = $('#othname3').val();
prof = $('#prof').val();

$.ajax({
    type: "POST",
    data:{"namef":namef, "namei":namei, "nameo":nameo, "prof":prof, "act":'5'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		$('#maintableoth').html(response);
    }

});
$('#othname1').val("");
$('#othname2').val("");
$('#othname3').val("");
$('#prof').val("");
$('.modal.modoth').modal('hide');


});






$( ".vis" ).click(function() {

visid = $(this).attr("data-btn");


$.ajax({
    type: "POST",
    data:{"visid":visid, "act":'6'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		//$('#maintableoth').html(response);
		
    }

});


if ($(this).hasClass("basic")) {
	$(this).removeClass("basic");
} else {
	$(this).addClass("basic");
}


});






$( ".edt" ).click(function() {

edtid = $(this).attr("data-btn");


$.ajax({
    type: "POST",
    data:{"edtid":edtid, "act":'7'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		$('#modedt').html(response);
		$('.modal.modedt').modal('show');
    }

});

		
});


var del;
var cat;


$( ".del" ).click(function() {

del = $(this).attr("data-btn");
cat = $(this).attr("data-cat");

$('.modal.moddel').modal('show');
		
});



$( ".savemain" ).click(function() {

if ($('#hidehead').is(":checked") == true) {
  hidehead = 1;
} else {
  hidehead = 0;
}

if ($('#hidecode').is(":checked") == true) {
  hidecode = 1;
} else {
  hidecode = 0;
}

if ($('#hidesec').is(":checked") == true) {
  hidesec = 1;
} else {
  hidesec = 0;
}

fullname = $('#pmpkname').val();
pinkabbr = $('#pabbr').val();
bossname = $('#bossname').val();
pyear = $('#pyear').val();
pnum = $('#pnum').val();



$.ajax({
    type: "POST",
    data:{"fullname":fullname, "pinkabbr":pinkabbr, "hidehead":hidehead, "hidecode":hidecode, "hidesec":hidesec, "bossname":bossname, "pyear":pyear, "pnum":pnum, "act":'10'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		$('#msg').html(response);
    }

});
		
});




function delme() {


$.ajax({
    type: "POST",
    data:{"delid":del, "cat":cat, "act":'9'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		//$('#modedt').html(response);
		$('.modal').modal('hide');

		if (cat == 1) {
			$('#maintablepsy').html(response);
		}
		if (cat == 2) {
			$('#maintablelog').html(response);
		}
		if (cat == 3) {
			$('#maintabledef').html(response);
		}
		if (cat == 4) {
			$('#maintablesoc').html(response);
		}
		if (cat == 0) {
			$('#maintableoth').html(response);
		}
    }

});

		
};


function editme() {

namef = $('#edtname1').val();
namei = $('#edtname2').val();
nameo = $('#edtname3').val();
cat = $('#cat').val();
edtprof = $('#edtprof').val();
edtid = $('#edtid').val();


$.ajax({
    type: "POST",
    data:{"namef":namef, "namei":namei, "nameo":nameo, "edtprof":edtprof, "edtid":edtid, "cat":cat, "act":'8'}, 
    url: "/lib/admindo.php",
    dataType: "html", 
    success: function(response){
		
		if (cat == 1) {
			$('#maintablepsy').html(response);
		}
		if (cat == 2) {
			$('#maintablelog').html(response);
		}
		if (cat == 3) {
			$('#maintabledef').html(response);
		}
		if (cat == 4) {
			$('#maintablesoc').html(response);
		}
		if (cat == 0) {
			$('#maintableoth').html(response);
		}

    }

});

$('.modal').modal('hide');


};





$('.menu .item')
  .tab()
;
$('.checkbox')
.checkbox()
;
$('.modal')
  .modal()
  .modal('setting', 'closable', false)
;

</script>




  </body>
  </html>