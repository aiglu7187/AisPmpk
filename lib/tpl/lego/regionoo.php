<?php
/*
   <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Округ ОО:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="regionoo" name="regionoo" value="<?php if($editmode==1) {echo $prow[4]; } ?><?php if($mainedit==1) {echo $mrow[36]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu" >
          <div class="item" data-value="0" data-text="Не посещал">Не посещал</div>
    <?php 
    $result = mysqli_query($link, "SELECT id_region, name FROM lib_regions WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
    }
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>
*/
?>