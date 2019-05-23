<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="../../semantic/dist/semantic.min.css">
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="../../semantic/dist/semantic.min.js"></script>
<style type="text/css">
  .price {
  color: #eee !important;
}
</style>
</head>

<body>


<?php



require ('connect.php');

include ('socmenu.php');

echo "<br><br>";

$editor = 0;

$proto = $_GET['proto'];

if($proto) {

$editor = 1;

$result = mysqli_query($link, "SELECT pr_num, pr_fio, pr_bdate, pr_regionoo, pr_numoo, pr_inv, pr_dolg FROM proto WHERE id_proto='{$proto}'") or die("ошибка");
$row = mysqli_fetch_row($result);

}



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
<input id="fio" class="oldcase" name="fio" type="text" placeholder="Иванов Иван Иванович" <?php if ($editor==1) {echo "value='".$row[1]."'";} ?> onchange="someChange()">

</div>

      </div>

    </div>
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Дата рождения
</div>
<input id="bdate" name="bdate" class="oldcase" type="date" placeholder="10.10.2000"  <?php if ($editor==1) {echo "value='".$row[2]."'";} ?> onchange="someChange()">

</div>

      </div>
    </div>
  </div>




<div class="row">



  <div class="column">

      <div class="ui segment">

<div class="inline field">
 
    <div class="ui toggle checkbox">
      <input id="inv" name="inv" type="checkbox" tabindex="0" class="hidden"  <?php if ($editor==1 && $row[5]==1) {echo "checked"; } ?> onchange="someChange()">
      <label>Наличие инвалидности</label>
    </div>
  </div>

</div>

  </div>



 <div class="column">

      <div class="ui segment">

<div class="inline field">
 
    <div class="ui toggle checkbox ">
      <input id="dolg" name="dolg" type="checkbox" tabindex="0" class="hidden" <?php if ($editor==1 && $row[6]==1) {echo "checked"; } ?> onchange="someChange()"> 
      <label>Неполный пакет документов (долги)</label>
    </div>
  </div>

</div>

  </div>


  </div>



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






 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Округ ОО:</label>
      <div class="ui selection dropdown search fluid">
          <input type="hidden" id="regionoo" name="regionoo" value="<?php if ($editor==1) {echo $row[3];} else {echo '0';} ?>" onchange="someChange()">
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu">
          <div class="item" data-value="0" data-text="Не посещал">Не посещал</div>
    <?php 
    $result2 = mysqli_query($link, "SELECT id_region, name FROM lib_regions WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row2 = mysqli_fetch_row($result2)) {
        echo '<div class="item" data-value="'.$row2[0].'" data-text="'.$row2[1].'">'.$row2[1].'</div>';
    }
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>





<div class="ui stackable one column grid container" >

  <div class="row">
<div class="column">
<br><br>
<div class="ui buttons ">
  <button id="savenow" class="ui green button"><?php if ($editor==1) { echo "Пересохранить"; } else {echo "Сохранить и сформировать Протокол";} ?></button> 
</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <div class="ui floating labeled icon dropdown button " id="zcancel" <?php if($editor==1) {echo "style='display:none'";} ?>>
    <span id="zcfin"></span>
  <span class="text">Отказ в приёме</span>
  <div class="menu">
    <div class="header">
      <i class="tags icon"></i>
      Выбрать причину отказа:
    </div>
    <div class="divider"></div>
    <div class="item" value="1">
       <i class="child icon "></i>
      Без ребёнка
    </div>
    <div class="item" value="2">
      <i class="users icon "></i>
      Без законного представителя
    </div>
    <div class="item" value="3">
      <i class="file text outline icon "></i>
      Без документов
    </div>
    <div class="item" value="4">
      <i class="frown icon "></i>
      Самостоятельный отказ
    </div>
  </div>
</div>

<a id="prntpr" class="ui grey button" href="/lib/tpl/printproto.php?id=<?php echo $proto; ?>" <?php if($editor==0) {echo "style='display:none'";} ?> target="_blank">Печать Протокола</a><a class="ui orange right floated button" href="/lib/tpl/proto.php">Новый Протокол</a>
<br><br><br><br><br><br>

  </div>
</div>
</div>









</div>

<div class="ui bottom fixed menu" id="oldcases" style="display: none; background-color: #90dc81;">
</div>


<div class="ui modal prot">
  
  <div class="header green">
    Протокол успешно создан!
  </div>
  <div class="image content">
    <div class="image">
     </div>
    <div class="description">

     </div>
  </div>
  <div class="actions">

    <a class="ui blue button" id="protonum"  target="_blank">Печать Протокола</a>
    <a class="ui green button" href="/lib/tpl/proto.php">Новый Протокол</a>
    <a class="ui orange button" id="protoback" >Вернуться к текущему</a>


  </div>
</div>




<div class="ui modal bad">
  
  <div class="header green">
    Некоторые поля не заполнены:
  </div>
  <div class="msge">
    
  </div>
  <div class="actions">
    <div class="ui orange button ok">Вернуться к редактированию</div>
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


function beginsearchcases() {

$.ajax({   
    type: "POST",
    data:{"checkfio":checkfio, "checkbdate": checkbdate <?php // if ($mainedit==1) { echo ', "notnew":'.$mrow[0]; } ?>}, 
    url: "../checkarchive.php",
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







znum = 0;


$('#zcancel')
  .dropdown({
    
    onChange: function(value, text, $selectedItem) {



      if( $('.form').form('is valid')) {

      zcr = $selectedItem.attr("value");
      cblockdata= [$("#fio").val()+";"+$("#bdate").val()+";"+zcr];

      


      $.ajax({   
    type: "POST",
    data:{"cblockdata":cblockdata}, 
    url: "../makezcancel.php",
    dataType: "html",            
    success: function(response){                    
       $( "#savenow" ).hide();
       $("#zcancel").addClass("green");
       $("#zcfin").html("Отказ успешно сохранен!");
       $("#zcancel").addClass("disabled");
    }

    });

    } else {

$('#zcancel')
  .dropdown('restore default text')
;


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



$(".msge").html("<div style='padding: 20px; margin: 10px' class='ui list'>"+msgerror+"</div>");

$('.bad.modal').modal('show');

}


    }
  });



$( "#savenow" ).click(function() {

$('#zcancel').hide();

if( $('.form').form('is valid')) {



if ($('#inv').is(":checked") == true) {
  inv = 1;
} else {
  inv = 0;
}


if ($('#dolg').is(":checked") == true) {
  dolg = 1;
} else {
  dolg = 0;
}

<?php 
if ($editor==1) { 

echo 'znum='.$row[0].';'; 

echo 'blockdata= [znum+";"+$("#fio").val()+";"+$("#bdate").val()+";"+$("#regionoo").val()+";"+$("#oonum").val()+";"+inv+";"+dolg];';

?>

$.ajax({   
    type: "POST",
    data:{"blockdata":blockdata <?php if ($editor==1) { echo ', "notnew":'.$proto; } ?>}, 
    url: "../makeblock.php",
    dataType: "html",            
    success: function(response){                    
        $('.prot.modal').modal('show');
        $('#protonum').attr("href", "/lib/tpl/printproto.php?id="+response);
        $('#prntpr').attr("href", "/lib/tpl/printproto.php?id="+response);
        $('#protoback').attr("href", "/lib/tpl/proto.php?proto="+response);
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

       blockdata= [znum+";"+$("#fio").val()+";"+$("#bdate").val()+";"+$("#regionoo").val()+";"+$("#oonum").val()+";"+inv+";"+dolg];

          $.ajax({   
          type: "POST",
          data:{"blockdata":blockdata <?php if ($editor==1) { echo ', "notnew":'.$proto; } ?>}, 
          url: "../makeblock.php",
          dataType: "html",            
          success: function(response){                    
          $('.prot.modal').modal('show');
          $('#protonum').attr("href", "/lib/tpl/printproto.php?id="+response);
          $('#prntpr').attr("href", "/lib/tpl/printproto.php?id="+response);
          $('#protoback').attr("href", "/lib/tpl/proto.php?proto="+response);
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



$(".msge").html("<div style='padding: 20px; margin: 10px' class='ui list'>"+msgerror+"</div>");

$('.bad.modal').modal('show');

}


});






$( ".input" ).change(function() {
  $(this).parent().removeClass("red");

});

function someChange() {
  $("#prntpr").hide();
}


$( "#fio" ).keydown(function() {
  $(this).parent().removeClass("red");
});

$('#fio').bind('keyup blur',function(){ 
    $(this).val($(this).val().replace(/[^'а-яА-ЯЁё -]/g,'') ); }
);



$('.form')
  .form({
    fields: {
      fio     : 'empty',
      bdate   : 'empty'
    }
  })
;


$('#m3').addClass('positive');



</script>










