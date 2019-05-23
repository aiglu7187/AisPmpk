   <div class="column">
      <div class="ui segment">

<div class="field">
      <label>Уровень образования:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" name="edulevel" id="edulevel" <?php if($mainedit==1 && $mrow[9]<>0) {echo 'value="'.$mrow[9].'"'; } ?>>
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">


<?php 
    if ($aoop > 8 && $aoop <> 11) { 
      $tempquery = "AND fb_edulevel=5";
      echo "<script>$('#edulevel').val(5);</script>";
    } else {
      $tempquery = "";
    }

    $result = mysqli_query($link, "SELECT fb_edulevel, name, tipname FROM lib_edulevel WHERE status=1 AND id_type_z=$zaktype $tempquery") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
      if ($row[2]) {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
      } else {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
      }

    }
    ?>   
          </div>

  </div>

</div>

  </div>
</div>