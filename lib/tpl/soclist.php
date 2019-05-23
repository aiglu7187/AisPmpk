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



<div class="ui two column  grid container">

<div class="row relaxed" >

<div class="ui column stacked segment">

<h5 >Прошедшие ЦПМПК сегодня:</h5>

<div class="ui ordered list">

<?php

$today = date("Y-m-d");

 $result = mysqli_query($link, "SELECT fb_fio, creation_date, fb_consult FROM fullbase WHERE fb_status=2 AND fb_date='{$today}'") or die("ошибка в выборке");
      
      while ($row = mysqli_fetch_row($result)) {

        $date = new DateTime($row[1]);

        if($row[2]==1) {
          $reason = "консультация";
        } else {
          $reason = "спец.условия";
        }

        echo '<a class="item">'.$row[0].' <span style="color: grey;">('.$reason.')</span> ';
        echo  $date->format('H:i');
        echo '</a>';


      }

?> 






</div>

</div>


<div class="ui column stacked segment">

<h5 >Отказ в услуге:</h5>

<div class="ui ordered list">

<?php

 $result = mysqli_query($link, "SELECT zc_name, zc_reason, creation_date FROM zcancel WHERE status=1 AND creation_date LIKE '{$today}%'") or die("ошибка в выборке ассистента");
      while ($row = mysqli_fetch_row($result)) {

        $date = new DateTime($row[2]);

        switch ($row[1]) {
          case '1':
            $reason = "без ребёнка";
            break;
          case '2':
            $reason = "без законного представителя";
            break;
          case '3':
            $reason = "без документов";
            break;
          case '4':
            $reason = "самостоятельный отказ";
            break;          
        }
        echo '<a class="item">&nbsp;'.$row[0].' <span style="color: grey;">('.$reason.')</span> ';
        echo  $date->format('H:i');
        echo '</a>';
      }
?>


</div>

</div>

</div>



</div>

<script type="text/javascript">
	

	$('#m1').addClass('positive');



</script>


</body>
</html>
