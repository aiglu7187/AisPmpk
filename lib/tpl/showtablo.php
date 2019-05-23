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

$today = date("Y-m-"); 

$result = mysqli_query($link, "SELECT id_proto, pr_num, pr_fio, creation_date, pr_dolg FROM proto WHERE status=1 AND creation_date LIKE '%".$today."%'") or die("ошибка");

?>




<div class="ui stackable column grid container">


<div class="ui cards ">

<?php

while ($row = mysqli_fetch_row($result)) {

?>

  <div class="card">
    <div class="content">
    <?php 
    if ($row[4] == 1) {
    ?>
     <span class="right floated mini ui image">Долги</span>
    <?php } ?>
      <div class="header">
        № <?php echo $row[1]; ?>
      </div>
      <div class="meta">
        <?php 
        $d = new DateTime($row[3]);

        echo $d->format('d.m.Y').'&nbsp&nbsp&nbsp&nbsp';
        echo $d->format('H:i');
         ?>
      </div>
      <div class="description">
        <b><?php echo $row[2]; ?></b>
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
        <a class="ui basic green button" href="/lib/tpl/proto.php?proto=<?php echo $row[0]; ?>">Изменить</a>
        <div class="ui basic red button consult" onclick="takeid(<?php echo $row[0]; ?>); rtimer=1">Удалить</div>
      </div>
    </div>
  </div>


<?php

}

?>

</div>


</div>


<div class="ui modal good">
  
  <div class="header ">
    Причина удаления:
  </div>
  <div class="image content">
    <div class="image">
     </div>
  </div>
    <div class="description">


<div class="ui stackable four column grid ">
<br>

  <div class="row" id="reasons">


 <div class="column">

<button class="teal ui button labeled icon" style=" margin-right: 5px; margin-left: 5px; width: 94%; height: 100%;" onclick="bzcancel(1)">
  <i class="child icon"></i>
  Без ребёнка
</button>
  </div>

   <div class="column">

<button class="teal ui button labeled icon" style=" margin-right: 5px; margin-left: 5px; width: 94%; height: 100%;" onclick="bzcancel(2)">
  <i class="users icon"></i>
  Без законного представителя
</button>
  </div>

   <div class="column">

<button class="teal ui button labeled icon" style=" margin-right: 5px; margin-left: 5px; width: 94%; height: 100%;" onclick="bzcancel(3)">
  <i class="file text outline icon"></i>
  Без документов
</button>
  </div>

   <div class="column">

<button class="teal ui button labeled icon" style=" margin-right: 5px; margin-left: 5px; width: 94%; height: 100%;" onclick="bzcancel(4)">
  <i class="frown icon"></i>
  Самостоятельный отказ
</button>


  </div>
  </div>

  <div class="row" id="reasonsdone" style="display: none">

<h3 style="position: relative; left: 100px"> Отказ успешно сохранен!</h3>

  </div>


     </div>
     <br><br><br>
  </div>
  <div class="actions ">

    <a class="ui orange button ok resetTimer" id="cback">Вернуться </a>

  </div>
</div>


<script type="text/javascript">

$( ".consult" ).click(function() {

konid = $(this).attr("konid");

$('.good.modal').modal('show');

});


function takeid(j) {
  jid = j;
}


function bzcancel(d) {

$.ajax({   
type: "POST",
data:{"jid":jid, "reason":d}, 
url: "../makezcancel.php",
dataType: "html",            
success: function(response){                    
 $("#reasons" ).hide();
 $("#reasonsdone").show();
 $("#cback").attr("href", "/lib/tpl/showtablo.php");

}

});


}


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


$('#m2').addClass('positive');



var rtimer=0;

setTimeout(function(){
   if (rtimer == 0) {
   window.location.reload();
   }
}, 300000);


$( ".resetTimer" ).click(function() {
  window.location.reload();
});


</script>










</body>
</html>











