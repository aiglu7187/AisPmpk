<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="../../semantic/dist/semantic.min.css">
<script src="/js/jquery.min.js"></script>
<script src="../../semantic/dist/semantic.min.js"></script>

<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />

<script src="/js/modernizr.custom.63321.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<script src="/js/jquery.pagination.js"></script>


<style type="text/css">

.notactive {
	background-color: #cbd3e6;
}

.popup {
  color: #FF0000;
}
	
</style>

</head>

<body>




<?php

require ('../connect.php');

include ('menu.php');

if ($_GET['s']) {
$_SESSION['ter'] = $_GET['s'];
}


echo "<br><br>";






?>



<div class="ui stackable one column grid container">


<div class="row">

<div class="column">


<table class="ui celled table striped ">
  <thead>
    <tr>

    <th width="125px" height="60px"><span id="sf1"><a data-content="Поиск по дате приёма" style="cursor: pointer;" class="tipstatus " onclick="makesearch(1)">Дата приёма</a></span></th>
    <th width="125px"><span id="sf2"><a data-content="Поиск по номеру документа" style="cursor: pointer;" class="tipstatus" onclick="makesearch(2)">Номер</a></span></th>
    <th><span id="sf3"><a data-content="Поиск по ФИО или части имени" style="cursor: pointer;" class="tipstatus" onclick="makesearch(3)">ФИО</a></span></th>
    <th width="125px"><span id="sf4"><a data-content="Поиск по дате рождения" style="cursor: pointer;" class="tipstatus" onclick="makesearch(4)">Дата рожд.</a></span></th>
    <th width="300px">

      <a class="browse item " style="cursor: pointer;" >
    Статус
      </a>



<div class="ui fluid popup bottom left transition hidden" style="width: 800px" >
    <div class="ui four column relaxed divided grid">
      <div class="column">
        <h4 class="ui header">Наименование услуги</h4>
        <div class="ui link list ">
          <a class="item ui checkbox" id="ui1"><input type="checkbox"  id="fc0" class="filtercheck"> <label>Заключение</label></a>
          <a class="item ui checkbox" id="ui2"><input type="checkbox"  id="fc1" class="filtercheck"> <label>Консультация</label></a>
          <a class="item ui checkbox" id="ui29"><input type="checkbox"  id="fc28" class="filtercheck"> <label>ГИА</label></a>
        <h4 class="ui header">Инвалидность/ОВЗ</h4>
          <a class="item ui checkbox" id="ui3"><input type="checkbox"  id="fc2" class="filtercheck"> <label>Инвалид</label></a>
          <a class="item ui checkbox" id="ui4"><input type="checkbox"  id="fc3" class="filtercheck"> <label>ОВЗ</label></a>
          <a class="item ui checkbox" id="ui5"><input type="checkbox"  id="fc4" class="filtercheck"> <label>Норма</label></a>
        </div>
      </div>
      <div class="column">
        <h4 class="ui header">Программа<br>(АООП/ООП)</h4>
        <div class="ui link list">
          <a class="item ui checkbox" id="ui6"><input type="checkbox"  id="fc5" class="filtercheck aoopcheck"> <label>Глухие</label></a>
          <a class="item ui checkbox" id="ui7"><input type="checkbox"  id="fc6" class="filtercheck aoopcheck"> <label>Слабослышащие</label></a>
          <a class="item ui checkbox" id="ui8"><input type="checkbox"  id="fc7" class="filtercheck aoopcheck"> <label>Слепые</label></a>
          <a class="item ui checkbox" id="ui9"><input type="checkbox"  id="fc8" class="filtercheck aoopcheck"> <label>Слабовидящие</label></a>
          <a class="item ui checkbox" id="ui10"><input type="checkbox"  id="fc9" class="filtercheck aoopcheck"> <label>ТНР</label></a>
          <a class="item ui checkbox" id="ui11"><input type="checkbox"  id="fc10" class="filtercheck aoopcheck"> <label>НОДА</label></a>
          <a class="item ui checkbox" id="ui12"><input type="checkbox"  id="fc11" class="filtercheck aoopcheck"> <label>ЗПР</label></a>
          <a class="item ui checkbox" id="ui13"><input type="checkbox"  id="fc12" class="filtercheck aoopcheck"> <label>РАС</label></a>
          <a class="item ui checkbox" id="ui14"><input type="checkbox"  id="fc13" class="filtercheck aoopcheck"> <label>УО</label></a>
          <a class="item ui checkbox" id="ui15"><input type="checkbox"  id="fc14" class="filtercheck aoopcheck"> <label>СД</label></a>
          <a class="item ui checkbox" id="ui16"><input type="checkbox"  id="fc15" class="filtercheck aoopcheck"> <label>ООП</label></a>
        </div>
      </div>
      <div class="column">
        <h4 class="ui header">Уровень образования</h4>
        <div class="ui link list">
          <a class="item ui checkbox" id="ui17"><input type="checkbox"  id="fc16" class="filtercheck"> <label>Ранняя помощь</label></a>
          <a class="item ui checkbox" id="ui18"><input type="checkbox"  id="fc17" class="filtercheck"> <label>Дошкольный</label></a>
          <a class="item ui checkbox" id="ui19"><input type="checkbox"  id="fc18" class="filtercheck"> <label>НОО</label></a>
          <a class="item ui checkbox" id="ui20"><input type="checkbox"  id="fc19" class="filtercheck"> <label>ООО</label></a>
          <a class="item ui checkbox" id="ui21"><input type="checkbox"  id="fc20" class="filtercheck"> <label>СОО</label></a>
          <a class="item ui checkbox" id="ui22"><input type="checkbox"  id="fc21" class="filtercheck"> <label>Общий</label></a>
          <a class="item ui checkbox" id="ui23"><input type="checkbox"  id="fc22" class="filtercheck"> <label>СПО</label></a>
        </div>
        <h4 class="ui header">Место проведения</h4>
        <div class="ui link list">
          <a class="item ui checkbox" id="ui30"><input type="checkbox"  id="fc29" class="filtercheck"> <label>Выезд в ОО</label></a>
          <a class="item ui checkbox" id="ui31"><input type="checkbox"  id="fc30" class="filtercheck"> <label>На дому</label></a>
        </div>
      </div>
      <div class="column">
        <h4 class="ui header">Дополнительно<br>&nbsp;</h4>
        <div class="ui link list">
          <a class="item ui checkbox" id="ui24"><input type="checkbox" id="fc23" class="filtercheck"> <label>Дообследование</label></a>
          <a class="item ui checkbox" id="ui25"><input type="checkbox" id="fc24" class="filtercheck"> <label>Наличие долгов</label></a>
          <h4 class="ui header">Готовность</h4>
          <a class="item ui checkbox" id="ui26"><input type="checkbox" id="fc25" class="filtercheck"> <label>Ожидающие</label></a>
          <a class="item ui checkbox" id="ui27"><input type="checkbox" id="fc26" class="filtercheck"> <label>Готовые</label></a>
          <a class="item ui checkbox" id="ui28"><input type="checkbox" id="fc27" class="filtercheck"> <label>Завершенные</label></a>
          <br><br>
          <a class="ui button orange fluid filterclear">Сброс</a>
        </div>
      </div>
    </div>
  </div>


    </th>
    <th>
      
&nbsp;



    </th>

  </tr></thead>

<tbody id="maintable">

<tr colspan="6" height="500px"><td><div class="ui active inverted dimmer"><div class="ui large text loader">Загрузка</div></td></tr>

</tbody>

</table>



</div>
</div>





<div class="ui modal showtime">
  <div class="actions">
    <div style="position: relative !important; float: left !important; left: 20px !important;">&nbsp;<h2>Карта обучающегося</h2></div>
    <div class="ui orange button ok floated left">X</div>
  </div>
  <div class="msg">
    
  </div>

</div>



<div class="ui modal showmegia">
  <div class="actions">
    <div style="position: relative !important; float: left !important; left: 20px !important;">&nbsp;<h2>Карта обучающегося</h2></div>
    <div class="ui orange button ok floated left">X</div>
  </div>
  <div class="msggia">
    
  </div>

</div>



<div class="ui modal changecode">
  <div class="actions">
    <div style="position: relative !important; float: left !important; left: 20px !important;">&nbsp;<h2>Изменение кода программы</h2></div>
    <div class="ui orange button ok floated left">Х</div>
  </div>
  <div class="msgcode" style="padding: 20px">



       Подсказка<br><br>
      <div class="ui ">

<div class="ui fluid labeled input">
<div class="ui label">
Введите новый код программы:
</div>
<input id="codech" name="codech" type="text" maxlength="3" placeholder="Только цифры, например: 4.2" value="">
<button class="ui button green" onclick="chcode();">Внести изменение</button>


</div>

<br><br>
&nbsp;

  </div>

</div>
</div>


<div class="ui modal chtypemod">
  <div class="header ">
    Подтвердите действие
  </div>

  <div class="chtmsg" style="padding-left: 30px">
    
  </div>
  <div class="actions chtconfirm">
    
  </div>
</div>


<div class="ui modal choutmod">
  <div class="header ">
    Выберите место проведения обследования
  </div>



    <div class="ui stackable six column grid">

<div class="row">
<div class="column">
<a class="ui button fluid outbtn" onclick="choutdo(0)" id="out0">
  Долгоруковская
</a>
</div>
<div class="column">
<a class="ui button fluid outbtn" onclick="choutdo(1)" id="out1">
  Выезд в ОО
</a>
</div>
<div class="column">
<a class="ui button fluid outbtn" onclick="choutdo(2)" id="out2">
  Выезд на дом
</a>
</div>
<div class="column">
<a class="ui button fluid outbtn" onclick="choutdo(3)" id="out3">
  Зеленоград
</a>
</div>
<div class="column">
<a class="ui button fluid outbtn" onclick="choutdo(4)" id="out4">
  Бехтерева
</a>
</div>
<div class="column">
<a class="ui button fluid outbtn" onclick="choutdo(5)" id="out5">
  Шаболовка
</a>
</div>

</div>

</div>

  <div class="actions">
    <a class='ui orange button ok'>Отмена</a>
  </div>
</div>



<div class="ui modal printsings">
  <div class="header ">
    Выберите членов комиссии (на печать)
  </div>

  <div class="prntmsg">
    
  </div>
  <div class="actions "> 
    
    <a class="ui green button prntconfirm" target="_blank" >Печать бланка Заключения</a>
    <a class="ui pink button prntconfirm2" target="_blank" >Печать бланка для выдачи</a>
    <a class="ui orange button ok ">Закрыть</a>

  </div>
</div>




<div class="ui modal printsingsgia">
  <div class="header ">
    Выберите членов комиссии (на печать)
  </div>

  <div class="prntmsggia">
    
  </div>
  <div class="actions "> 
    
    <a class="ui green button prntconfirm" target="_blank" >Печать Протокола и Заключения</a>
    <a class="ui orange button ok ">Закрыть</a>

  </div>
</div>




















</div>





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



$( document ).ready(function() {

$.ajax({
    type: "POST",
    data:{  }, 
    url: "../listengine.php",
    dataType: "html",            
    success: function(response){
        $("#maintable").html(response);
    }

});

});



function chtype(j,k) {

if (k==1) {
	chtypemsg = "<br><h3>Вы действительно хотите изменить <b>Заключение</b> на <b>Консультацию</b>?</h3><br>";
} else {
	chtypemsg = "<br><h3>Вы действительно хотите изменить <b>Консультацию</b> на <b>Заключение</b>?</h3><br>";
}

$(".chtmsg").html("<div>"+chtypemsg+"</div>");

$(".chtconfirm").html("<a class='ui green button ok' onclick='changetype("+j+","+k+");'>Да</a><a class='ui orange button ok'>Отмена</a>");

$('.modal.chtypemod').modal('show');

}


function chout(r,n) {

rid = r;
$('.outbtn').removeClass('green');

$('#out'+n).addClass('green');


$('.modal.choutmod').modal('show');

}



function choutdo(q) {

$.ajax({
    type: "POST",
    data:{"id":rid, "chout":q }, 
    url: "/lib/changeout.php",
    dataType: "html",            
    success: function(response){
        $('.modal.choutmod').modal('hide');
        $('#oc'+rid).attr('style','color:orange');

    }

});


}



function chcode() {

codeval = $("#codech").val();

$.ajax({
    type: "POST",
    data:{"id":chcodenum, "codeval":codeval }, 
    url: "/lib/changecode.php",
    dataType: "html",            
    success: function(response){
        $(".msgcode").html("<div style='padding: 20px; margin: 10px' class=''>"+response+"</div>");
    }

});


}



function changetype(o,p) {

if (p==1) {
  chtext = "Конс";
  newclass = "cons";
  oldclass = "zakl";
  d = 0;
} else {
  chtext = "Закл";
  newclass = "zakl";
  oldclass = "cons";
  d = 1;
}

$.ajax({
    type: "POST",
    data:{ "chtid": o, "chval": p }, 
    url: "/lib/changetype.php",
    dataType: "html",            
    success: function(response){
        $("#tc"+o).parent().addClass('yellow');
        $("#tc"+o).text(chtext);
        $("#tc"+o).removeClass(oldclass);
        $("#tc"+o).addClass(newclass);
        $("#tc"+o).parent().attr('onclick', 'chtype(81,'+d+')');
    }

});

}



function makesearch(n) {

switch (n) {

  case 1:
    $("#sf1").html('<div class="mini ui icon input"><input id="sq1" onkeyup="searchdate()" style="width: 100px" type="text" placeholder=""><i onclick="clearsearch(1); pdate=null;  beginsearch()" class=" circular link close icon"></i></div>');
  break;

  case 2:
    $("#sf2").html('<div class="mini ui icon input"><input id="sq2"  onkeyup="searchznum()" style="width: 100px" type="text" placeholder=""><i onclick="clearsearch(2); znum=null;  beginsearch()" class=" circular link close icon"></i></div>');
  break;

  case 3:
    $("#sf3").html('<div class="mini ui icon input"><input id="sq3" onkeyup="searchfio()" type="text" placeholder=""><i onclick="clearsearch(3); fio=null;  beginsearch()" class=" circular link close icon"></i></div>');
  break;

  case 4:
    $("#sf4").html('<div class="mini ui icon input"><input id="sq4"  onkeyup="searchbdate()" style="width: 100px" type="text" placeholder=""><i onclick="clearsearch(4); bdate=null;  beginsearch()" class=" circular link close icon"></i></div>');
  break;

}


}



function clearsearch(g) {

switch (g) {

  case 1:
    $("#sf1").html('<a style="cursor: pointer;" class="tipstatus" onclick="makesearch(1)">Дата приёма</a>');
  break;

  case 2:
    $("#sf2").html('<a style="cursor: pointer;" class="tipstatus" onclick="makesearch(2)">Номер</a>');
  break;

   case 3:
    $("#sf3").html('<a style="cursor: pointer;" class="tipstatus" onclick="makesearch(3)">ФИО</a></span>');
  break;

  case 4:
    $("#sf4").html('<a style="cursor: pointer;" class="tipstatus" onclick="makesearch(4)">Дата рожд.</a>');
  break;

}


}


pdate = null;
znum = null;
fio = null;
bdate = null;

var checkstat = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];


function beginsearch(m) {



if (pdate === 'undefined') {
  pdate = null;
}

if (znum === 'undefined') {
  znum = null;
}

if (fio === 'undefined') {
  fio = null;
}

if (bdate === 'undefined') {
  bdate = null;
}


$.ajax({
    type: "POST",
    data:{ "page":m, "pdate":pdate, "znum":znum, "fio":fio, "bdate":bdate, "checkstat":checkstat }, 
    url: "../listengine.php",
    dataType: "html",            
    success: function(response){
        $("#maintable").html('<tr colspan="6" height="500px"><td><div class="ui active inverted dimmer"><div class="ui large text loader">Загрузка</div></td></tr>');
        $("#maintable").html(response);
    }

});



}




pdtimer=1;

function searchdate() {

if (($('#sq1').val().length > 2 || $('#sq1').val()=='') && pdtimer==1) {

pdtimer=0;

setTimeout(function() {

pdate = $('#sq1').val();
beginsearch();
pdtimer=1;

}, 2000);

}
 
}




zntimer=1;

function searchznum() {

if (($('#sq2').val().length > 2 || $('#sq2').val()=='') && zntimer==1) {

zntimer=0;

setTimeout(function() {

znum = $('#sq2').val();
beginsearch();
zntimer=1;

}, 2000);

}
 
}




fiotimer=1;

function searchfio() {

if (($('#sq3').val().length > 2 || $('#sq3').val()=='') && fiotimer==1) {

fiotimer=0;

setTimeout(function() {

fio = $('#sq3').val();
beginsearch();
fiotimer=1;

}, 2000);

}
 
}





bdtimer=1;

function searchbdate() {

if (($('#sq4').val().length > 2 || $('#sq4').val()=='') && bdtimer==1) {

bdtimer=0;

setTimeout(function() {

bdate = $('#sq4').val();
beginsearch();
bdtimer=1;

}, 2000);

}
 
}




$('.browse')
  .popup({
    on: 'click',
    setFluidWidth: false,

    position   : 'bottom center',
    delay: {
      show: 300,
      hide: 1000
    }
  })
;






$( ".filtercheck" ).change(function() {

  checkid = $(this).attr("id");
  checkid = checkid.substr(2);
  checkmas = parseInt(checkid);

if ($('#ui2').hasClass( "checked" ) && !$('#ui1').hasClass( "checked" ) ) {

  $('.aoopcheck').parent().addClass("disabled");

  $('.aoopcheck').parent().checkbox("refresh");

  for ($i=5;$i<16;$i++) {
    checkstat[$i] = 0;
  }

} else {
  $('.aoopcheck').parent().removeClass("disabled");
  for ($i=6;$i<17;$i++) {
    if($('#ui'+$i).hasClass( "checked" )) {
    checkstat[$i-1] = 1;
    } else {
    checkstat[$i-1] = 0;
    }
  }
}

if($(this).parent().hasClass( "checked" )) {
  checkstat[checkmas] = 1;
} else {
  checkstat[checkmas] = 0;
}


beginsearch();


});



$(".filterclear").click(function() {

$('.checkbox').checkbox("set unchecked");


});



























$('#m1').addClass('positive');




</script>










</body>
</html>