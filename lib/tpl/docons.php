<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="../../semantic/dist/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="../../semantic/dist/semantic.min.js"></script>

<style type="text/css">
  .price {
  color: #eee !important;
}
</style>
</head>

<body>


<?php
require ('../connect.php');

include ('menu.php');

echo "<br><br>";

$editor = 0;

$cons = $_GET['cons'];

if($cons) {

$editor = 1;

$result = mysqli_query($link, "SELECT fb_num, fb_fio, fb_bdate, fb_regionoo, fb_numoo, fb_invovz, fb_spsy, fb_slog, fb_sdef, fb_ssoc, fb_edulevel, fb_date, fb_comtype FROM fullbase WHERE id='{$cons}'") or die("ошибка");
$row = mysqli_fetch_row($result);

$psy = $row[6];
$log = $row[7];
$def = $row[8];
$soc = $row[9];
$edu = $row[10];

$id = $row[0];
}



?>


<div class="form">

<div class="ui stackable two column grid container">

<div class="row">

<div class="column">
      <div class="ui segment">
  <label>Дата проведения консультации:</label>
<div class="ui fluid labeled input">

<div class="ui label">
от
</div>
<input id="zdate" name="zdate" type="date" placeholder="дата заключения" <?php if($editor==1) {echo 'value="'.$row[11].'"'; } ?>>

<a class="ui tag label teal" onclick='$("#zdate").val(currentDate);'>
  Сегодняшнее число
</a>

</div>

      </div>
    </div>


  <div class="column">
 <br>
      <div class="ui segment">

<div class="inline field">

    <div class="ui toggle checkbox">
      <input id="inv" name="inv" type="checkbox" tabindex="0" class="hidden"  <?php if ($editor==1 && $row[5]==1) {echo "checked"; } ?>>
      <label>Наличие инвалидности</label>
    </div>
  </div>

</div>

  </div>



  </div>


<div class="row">
    <div class="column">
      <div class="ui segment field">

<div class="ui fluid labeled input  ">
<div class="ui label">
ФИО ребенка
</div>
<input id="fio" name="fio" class="oldcase" type="text" placeholder="Иванов Иван Иванович" <?php if ($editor==1) {echo "value='".$row[1]."'";} ?>>

</div>

      </div>

    </div>
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Дата рождения
</div>
<input id="bdate" name="bdate" class="oldcase" type="date" placeholder="10.10.2000"  <?php if ($editor==1) {echo "value='".$row[2]."'";} ?>>
<span class="ui tag label teal age">

</span>
</div>

      </div>
    </div>
  </div>




</div>

<div class="ui stackable one column grid container">



<div class="row">



    <div class="column">
<div class="ui segment">

<div class="ui fluid labeled category search oobase ">
<div class="ui label">
Наименование ОО:
</div>
<input id="oonum" name="oonum" type="text" style="width: 100% !important; border-radius: 3px !important" class="prompt" placeholder="Например: ГБОУ СОШ №111" <?php if ($editor==1) {echo "value='".$row[4]."'";} ?>  >

</div>

      </div>
    </div>


<script type="text/javascript">

$( document ).ready(function() {

$('.oobase.search')
  .search({
    source: oocontent,
    showNoResults: false,
    searchFields: ['price', 'title']

  })
;

});

var oocontent = [

<?php


$result9 = mysqli_query($link, "SELECT name, oonum, region FROM src_oo") or die("ошибка в выборке");

while ($row9 = mysqli_fetch_row($result9)) {
    echo "{ title: '".$row9[0]."', price: '".$row9[1]."', description: '".$row9[2]."'  },";
}

?>

];

</script>



  </div>

</div>


<div class="ui stackable two column grid container" >

<div class="row">

  <div class="column">
<div class="field ui segment">
      <label>Уровень образования:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="edulevel" name="edulevel" <?php if ($editor==1) {echo "value='".$edu."'";} ?>>
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu" >
          
    <?php 
    $result3 = mysqli_query($link, "SELECT   fb_edulevel, name FROM lib_edulevel WHERE status=1 AND id_type_z=0") or die("ошибка в выборке ассистента");
    while ($row3 = mysqli_fetch_row($result3)) {
        echo '<div class="item" data-value="'.$row3[0].'" data-text="'.$row3[1].'">'.$row3[1].'</div>';
    }
    ?>            

          </div>
      </div>
  </div>

  </div>

   <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Вид комиссии:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="comtype" name="comtype" value="<?php if($editor==1) {echo $row[12]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu" >
          <div class="item" data-value="0" data-text="Не требуется">Не требуется</div>
    <?php 
    $result3 = mysqli_query($link, "SELECT fb_comtype, name, tipname FROM lib_comtype WHERE status=1") or die("ошибка в выборке вида комиссии");
    while ($row3 = mysqli_fetch_row($result3)) {
              if ($row3[2]) {
                echo '<div class="item" data-value="'.$row3[0].'" data-text="'.$row3[1].'">'.$row3[2].'</div>';
              } else {
                echo '<div class="item" data-value="'.$row3[0].'">'.$row3[1].'</div>';
              }
            
            }
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>



  </div>

</div>




<div class="ui stackable four column grid container" <?php if($editor==1 && $row[11] <> date("Y-m-d")) {echo 'style="display:none"'; } ?>>
<br>
<h4>Члены комиссии:</h4>

  <div class="row">


 <div class="column">

         <div class="field">
<label>Педагог-психолог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden" name="psyname" id="psyname" <?php if ($editor==1) {echo "value='".$psy."'";} ?>> 
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      
<div class="menu">
  <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=1 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>1 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }

    ?>

</div>

    </div>
  </div>
  </div>


<div class="column">

         <div class="field">
<label>Учитель-логопед:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="logname" id="logname" <?php if ($editor==1) {echo "value='".$log."'";} ?>>
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
        <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
<?php 
     $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=2 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>2 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    ?>     

</div>
    </div>
  </div>
  </div>


<div class="column">

         <div class="field">
<label>Учитель-дефектолог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="defname" id="defname" <?php if ($editor==1) {echo "value='".$def."'";} ?>>
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
     $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=3 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>3 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    ?>     

</div>
    </div>
  </div>
  </div>

<div class="column">

         <div class="field">
<label>Социальный педагог:</label>
    <div class="ui fluid  search selection dropdown" >
      <input type="hidden"  name="socname" id="socname" <?php if ($editor==1) {echo "value='".$soc."'";} ?>>
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
<?php 
     $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=4 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>4 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    ?>      

</div>
    </div>
  </div>
  </div>

  </div>

</div>


<div class="ui stackable one column grid container">

  <div class="row">
<div class="column">
<br><br>
<div class="ui buttons ">
  <button id="savenow" class="ui green button"><?php if ($editor==1) { echo "Пересохранить"; } else {echo "Сохранить Консультацию";} ?></button> 
</div>


<a class="ui orange right floated button"  href="/index.php">Отменить и закрыть</a>
<br><br><br><br><br><br>

  </div>
</div>
</div>




<div class="ui modal prot">
  
  <div class="header green">
   Консультация успешно сохранена!
  </div>
  <div class="image content">
    <div class="image">
     </div>
    <div class="description">

     </div>
  </div>
  <div class="actions">


    <?php //echo '<a class="ui blue button" href="lib/tpl/printme.php?id='.$temprow[0].'" target="_blank">Печать Протокола</a>'; ?>
    <a class="ui yellow button" id="protoback" >Редактировать текущую</a>
    <a class="ui green button" href="/lib/tpl/docons.php">Новая Консультация</a>
    <a class="ui orange button" href="/lib/tpl/showlist.php">Закрыть</a>
    


  </div>
</div>




<div class="ui modal bad">
  
  <div class="header green">
    Некоторые поля не заполнены:
  </div>
  <div class="msge">
    
  </div>
  <div class="actions">
    <div class="ui orange button ok">Вернуться к текущей</div>
  </div>
</div>




<input type="hidden" id="zdate" value="<?php echo date("Y-m-d"); ?>">




</div>

<div class="ui bottom fixed menu" id="oldcases" style="display: none; background-color: #90dc81;">

</div>


<script type="text/javascript">

var fullDate = new Date();
var twoDigitMonth = (fullDate.getMonth() > 8)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
var twoDigitDay = (fullDate.getDate() > 9)? (fullDate.getDate()) : '0' + (fullDate.getDate());
var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDay;

<?php

if ($editor <> 1) {
?>

$("#zdate").val(currentDate);

<?php
}
?>


  
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




$( "#savenow" ).click(function() {


if( $('.form').form('is valid')) {



if ($('#inv').is(":checked") == true) {
  inv = 1;
} else {
  inv = 0;
}




<?php 
if ($editor==1) { 

echo 'znum='.$id.';'; 

echo 'blockdata = [znum+";"+$("#fio").val()+";"+$("#bdate").val()+";"+0+";"+$("#oonum").val()+";"+inv+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+$("#edulevel").val()+";"+$("#comtype").val()];';

?>

 $.ajax({   
        type: "POST",
        data:{"blockdata":blockdata, "zdate":$('#zdate').val(), "strite":1 <?php if ($editor==1) { echo ', "notnew":'.$cons; } ?>}, 
        url: "../makecons.php",
        dataType: "html",            
        success: function(response){                    
        $('.prot.modal').modal('show');
        $('#protoback').attr("href", "/lib/tpl/docons.php?cons="+response);
        }

        });

<?php
} else { 

?>

$.ajax({   
    type: "POST",
    data:{}, 
    url: "../getZnum.php",
    dataType: "html",            
    success: function(response){                    
       znum=response;

       blockdata = [znum+";"+$("#fio").val()+";"+$("#bdate").val()+";"+0+";"+$("#oonum").val()+";"+inv+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+$("#edulevel").val()+";"+$("#comtype").val()];

        $.ajax({   
        type: "POST",
        data:{"blockdata":blockdata, "zdate":$('#zdate').val(), "strite":1 <?php if ($editor==1) { echo ', "notnew":'.$cons; } ?>}, 
        url: "../makecons.php",
        dataType: "html",            
        success: function(response){                    
        $('.prot.modal').modal('show');
        $('#protoback').attr("href", "/lib/tpl/docons.php?cons="+response);
        }

        });

    }

});

 
<?php
} 
?>

















$("#savenow").html("Пересохранить");




} else {

msgerror = "";

if ($("#zdate").val() == "" ) {
  $("#zdate").parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Дата Заключения</div></div>";
}

if ($("#fio").val().length < 4 ) {
  $("#fio").parent().parent().addClass("red");
  msgerror += "<div class='item'  style='padding: 5px;'><i class='warning icon'></i><div class='content'>ФИО обучающегося</div></div>";
}

if ($("#bdate").val() == "" ) {
  $("#bdate").parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Дата рождения обучающегося</div></div>";
}

if ($("#edulevel").val() == "" ) {
  $("#edulevel").parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Уровень образования</div></div>";
}

$(".msge").html("<div style='padding: 20px; margin: 10px' class='ui list'>"+msgerror+"</div>");

$('.bad.modal').modal('show');

}


});






$( ".input" ).change(function() {
  $(this).parent().removeClass("red");
});


$( "#fio" ).keydown(function() {
  $(this).parent().removeClass("red");
});

$('#fio').bind('keyup blur',function(){ 
    $(this).val($(this).val().replace(/[^'а-яА-ЯЁё -]/g,'') ); }
);



$('.form')
  .form({
    fields: {
      zdate     : 'empty',
      fio     : 'empty',
      edulevel : 'empty',
      bdate   : 'empty'
    }
  })
;


$('#m4').addClass('positive');


function beginsearchcases() {

$.ajax({   
    type: "POST",
    data:{"checkfio":checkfio, "checkbdate": checkbdate <?php if ($mainedit==1) { echo ', "notnew":'.$mrow[0]; } ?>}, 
    url: "/lib/checkarchive.php",
    dataType: "html",            
    success: function(response){                    
        $("#oldcases").html(response);
    }

});


}


$( ".oldcase" ).change(function() {



setTimeout(function() {

checkfio = $('#fio').val();
checkbdate = $('#bdate').val();

timerset = 0;

if (checkfio != '' && checkbdate != '' && timerset == 0) {

  beginsearchcases();

} else {

  $('#oldcases').hide();

}

timerset = 1;

}, 1000);


});


<?php
if ($editor==1) {
?>
  $('#fio').change();
<?php
}
?>

</script>


<script type="text/javascript" src="/js/age.js"></script>





