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

require ('../connect.php');

include ('menu.php');

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
        <a class="ui basic green button" href="/index.php?proto=<?php echo $row[0]; ?>">Заключение</a>
        <a class="ui basic red button consult" konid="<?php echo $row[0];?>" onclick="rtimer = 1" >Консультация</a>
      </div>
    </div>
  </div>


<?php

}

?>

</div>





<div class="ui modal good">
  
  <div class="header ">
    Заполните необходимые данные:
  </div>
  <div class="image content">
    <div class="image">
     </div>
    <div class="description">

<div class="ui stackable two column grid ">
<br>

 <div class="column">
<div class="field">
      <label>Уровень образования:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="edulevel" name="edulevel" value="0">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu" >
          
    <?php 
    $result = mysqli_query($link, "SELECT   fb_edulevel, name FROM lib_edulevel WHERE status=1 AND id_type_z=0") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
    }
    ?>            

          </div>
      </div>
  </div>

</div>


   <div class="column ">
  
   <div class="ui ">

<div class="field">
      <label>Вид комиссии:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="comtype" name="comtype">
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


<div class="ui stackable two column grid ">
<br>

  <div class="row">



 <div class="column">

         <div class="field">
<label>Педагог-психолог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden" name="psyname" id="psyname">
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
      <input type="hidden"  name="logname" id="logname">
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
      <input type="hidden"  name="defname" id="defname">
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
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="socname" id="socname">
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




     </div>
  </div>
  <div class="actions ">


    <a class="ui blue button savenow">Сохранить</a>
    <a class="ui orange button ok resetTimer">Вернуться </a>

  </div>
</div>


<script type="text/javascript">

var $enf = 0;

$( ".consult" ).click(function() {

konid = $(this).attr("konid");

$('.good.modal').modal('show');

});


$( ".savenow" ).click(function() {


blockdata= [$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+konid+";"+$("#edulevel").val()+";"+$("#comtype").val()];

if ($enf==0) {
$.ajax({   
    type: "POST",
    data:{"blockdata":blockdata }, 
    url: "../makecons.php",
    dataType: "html",            
    success: function(response){                    
        //$('.prot.modal').modal('show');
        $(".savenow").html(response);
        $(".ok").attr("href", "/lib/tpl/showblock.php");
        $(".savenow").addClass("green");
        $(".savenow").removeClass("savenow blue");
        $enf = 1;
    }

});

}

});


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
}, 60000);


$( ".resetTimer" ).click(function() {
  window.location.reload();
});





</script>










</body>
</html>











