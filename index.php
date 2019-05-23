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


</style>

</head>

<body>


<?php
require ('lib/connect.php');

require ('lib/editmode.php');

include ('lib/tpl/menu.php');




echo "<br><br>";

?>


<!-- Меню -->


<div class="ui stackable one column grid container">

<div class="five ui buttons">

<?php

$result = mysqli_query($link, "SELECT id_type_z, name FROM lib_type_z WHERE status=1") or die("ошибка в выборке меню");

while ($row = mysqli_fetch_row($result)) {
    echo '<button id="z'.$row[0].'" name="z'.$row[0].'" ind="'.$row[0].'" class="ui blue button mmenu" >'.$row[1].'</button>';
}
?>

</div>


<div id="submenu" class="eleven ui buttons">

</div>

</div>


<div id="maintpl" class="ui stackable container">


</div>




<!-- КОНЕЦ Меню -->



<div class="ui modal good">
  
  <div class="header green">
    Заключение успешно сохранено!
  </div>
  <div class="image content">
    <div class="image">
     </div>
    <div class="description">
     </div>
  </div>
  <div class="actions finbutton">

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



$( ".mmenu" ).click(function() {
  $(".mmenu").removeClass( "green" ).addClass( "blue" );
  $(this).removeClass( "blue" ).addClass( "green" );


$.ajax({   
        type: "POST",
        data:{"zaknum":$(this).attr('ind')<?php  
        $ttemp = $_GET['proto'];
        if($ttemp<>'') { 
          echo ', "proto":'.$ttemp; 
        } 
        $idtemp = $_GET['id'];
        if($idtemp<>'') { 
          echo ', "id":'.$idtemp; 
        } 

        ?> }, 
        url: "lib/getAoop.php",
        dataType: "html",            
        success: function(response){                    
            $("#submenu").html(response); 
        }

    });


});


$('#m3').addClass('positive');


</script>




  </body>
  </html>