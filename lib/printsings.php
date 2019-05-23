<?php



$getid = $_REQUEST["id"];

require ('connect.php');

if(!$getid) {
	die("Ошибка анкеты!");
}


$result2 = mysqli_query($link, "SELECT fb_spsy, fb_slog, fb_sdef, fb_ssoc FROM fullbase WHERE id=$getid LIMIT 1") or die("ошибка в выборке из Заключения");

$row2 = mysqli_fetch_row($result2);


?>


<div class="ui stackable two column grid ">
<br>

  <div class="row">



 <div class="column">

         <div class="field">
<label>Педагог-психолог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden" name="psyname" id="psyname" value="<?php echo $row2[0]; ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      
<div class="menu">
	<div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1  ORDER BY second_name") or die("ошибка в выборке ассистента");
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
      <input type="hidden"  name="logname" id="logname"  value="<?php echo $row2[1]; ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      	<div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1  ORDER BY second_name") or die("ошибка в выборке ассистента");
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
<label><br><br>Учитель-дефектолог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="defname" id="defname"  value="<?php echo $row2[2]; ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      	<div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1  ORDER BY second_name") or die("ошибка в выборке ассистента");
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
<label><br><br>Социальный педагог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="socname" id="socname"  value="<?php echo $row2[3]; ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1  ORDER BY second_name") or die("ошибка в выборке ассистента");
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

<script type="text/javascript">
	
$('.dropdown')
.dropdown()
; 

spsy = 0;
slog = 0;
sdef = 0;
ssoc = 0;

$('.prntconfirm').attr("href", '/lib/tpl/printme.php?id=<?php echo $getid; ?>');
$('.prntconfirm2').attr("href", '/lib/tpl/printme.php?id=<?php echo $getid."&pinkblank=1"; ?>');

$( ".dropdown" ).change(function() {

spsy = $('#psyname').val();
slog = $('#logname').val();
sdef = $('#defname').val();
ssoc = $('#socname').val();

goadress = '/lib/tpl/printme.php?id='+chid+'&spsy='+spsy+'&slog='+slog+'&sdef='+sdef+'&ssoc='+ssoc;

$('.prntconfirm').attr("href", goadress);
$('.prntconfirm2').attr("href", goadress+"&pinkblank=1");

});

</script>