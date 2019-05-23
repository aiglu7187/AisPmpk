<div class="column">
      <div class="ui segment">

<div class="field">
      <label>Предоставление услуг ассистента (помощника):</label>
      <div class="ui fluid selection dropdown multiple">
          <input type="hidden" id="assist" name="assist" <?php if($mainedit==1 && $mrow[15]<>0) {echo 'value="'.$mrow[15].'"'; } ?>>
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu">

            <?php 
            $result = mysqli_query($link, "SELECT fb_assist, name, tipname FROM lib_assist WHERE status=1") or die("ошибка в выборке ассистента");
            while ($row = mysqli_fetch_row($result)) {
              if ($row[2]) {
                echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
              } else {
                echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
              }
            
            }
            ?>

          </div>
      </div>
  </div>

</div>

  </div>