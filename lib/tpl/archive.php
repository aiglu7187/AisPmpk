<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="../../semantic/dist/semantic.min.css">
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="../../semantic/dist/semantic.min.js"></script>
</head>

<body>


<?php

require ('connect.php');

include ('socmenu.php');

echo "<br><br>";

?>


<div class="form">

<div class="ui stackable two column grid container">



<div class="row">
    <div class="column">
      <div class="ui segment field">

<div class="ui fluid labeled input  ">
<div class="ui label">
ФИО ребенка
</div>
<input id="fio" name="fio" type="text" placeholder="Иванов Иван Иванович" onkeyup="searchfio()">

</div>

      </div>

    </div>
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Дата рождения
</div>
<input id="bdate" name="bdate" type="date" placeholder="10.10.2000">
<span class="ui tag label teal age">

</span>
</div>

      </div>
    </div>
  </div>



</div>

</div>


<div class="ui stackable one column grid container">
<div class="row">
    <div class="column">


<table class="ui celled table striped ">
  <thead>
    <tr>

    <th width="125px" height="60px">Дата приёма</th>
    <th width="125px">Номер</th>
    <th>ФИО</span></th>
    <th width="125px">Дата рожд.</th>
    <th width="200px">AООП</th>
    <th>ОО</th>

  </tr></thead>

<tbody id="maintable">

</tbody>

</table>









</div>
</div>
</div>





<script type="text/javascript">

$('#m4').addClass('positive');


fiotimer=1;

function searchfio() {

if (($('#fio').val().length > 4 || $('#fio').val()=='') && fiotimer==1) {


fio = $('#fio').val();

beginsearch();




}
 
}


function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}



function beginsearch() {



//sleep(3000);

bdate = $('#bdate').val();

if (fio === 'undefined') {
  fio = "";
}

if (bdate === 'undefined') {
  bdate = "";
}

if (fiotimer == 1) {

fiotimer = 0;

setTimeout(function(){


$.ajax({
    type: "POST",
    data:{ "fio":fio, "bdate":bdate },
    url: "../arengine.php",
    dataType: "html",
    success: function(response){
        $("#maintable").html('<tr colspan="6" height="500px"><td><div class="ui active inverted dimmer"><div class="ui large text loader">Загрузка</div></td></tr>');
        $("#maintable").html(response);

    }

});


}, 5000);

fiotimer = 1;

}


}





$( "#bdate" ).change(function() {

beginsearch();

});






</script>

</body>
</html>

