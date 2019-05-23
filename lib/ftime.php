

<?php



$ztype = $_POST['zaktype'];
$atype = $_POST['aoop'];
$edulevelvar = $_POST['fgosvar'];

require ('connect.php');


    if ($atype == 9) {
      
?>

<div class="column">
<div class="ui segment">
         <div class="field">

    <div class="ui fluid selection dropdown">
      <input type="hidden" name="fbtime" id="fbtime">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">


<?php 

    $result = mysqli_query($link, "SELECT fb_time, name FROM lib_time WHERE status=1 AND fb_edulevelvar=$edulevelvar AND fb_type_z=3 AND fgos=9") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {

        echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';

    }
    ?>    

      </div>
    </div>
  </div>
</div>


 </div>


<?php

} else {

?>

<div class="column">
<div class="ui segment">
         <div class="field">

    <div class="ui fluid selection dropdown">
      <input type="hidden" name="fbtime"  id="fbtime">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">


<?php 

    if ($edulevelvar < 3) {
      $templevel = "OR fb_time=1";
    } else {
      $templevel = "";
    }
    $result = mysqli_query($link, "SELECT fb_time, name, fgos FROM lib_time WHERE status=1 AND fb_edulevelvar=$edulevelvar AND fb_type_z=3 $templevel") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2] == 0 || $row[2] == $atype) {
        echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
        }
    }
    ?>    

      </div>
    </div>
  </div>
</div>


 </div>


<?php

}

?>


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
  </script>