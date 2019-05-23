<div class="column">

         <div class="field ui segment">
<label>Наличие инвалидности<?php if($mrow[6]==1 || $prow[6]==1) {echo "<span style='color:red; font-weight: 900'> (уточните инвалидность!)</span>";} ?>:</label>
    <div class="ui fluid selection dropdown">
      <input type="hidden" name="rec" id="rec"  value="<?php if($mainedit==1) {echo $mrow[6]; } ?>" >
      <i class="dropdown icon"></i>
      <div class="default text">Нет</div>
      <div class="menu">
        <div class="item" data-value="0" data-text="Нет">
    
          Нет
        </div>


<?php 
    $result = mysqli_query($link, "SELECT fb_otherspec, stype FROM lib_otherspec WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
    }
    ?>    

      </div>
    </div>
  </div>
  </div>