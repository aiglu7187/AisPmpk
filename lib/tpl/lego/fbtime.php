


 <div class="column">
<div class="ui segment">
         <div class="field">

    <div class="ui fluid selection dropdown">
      <input type="hidden" name="fbtime" id="fbtime" value="<?php if($mainedit==1) {echo $mrow[30]; } ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">


<?php 
    $result = mysqli_query($link, "SELECT fb_time, name FROM lib_time WHERE status=1 AND fb_type_z=2 OR fb_time=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
      
        echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
      
    }
    ?>    

      </div>
    </div>
  </div>
</div>


  </div>

