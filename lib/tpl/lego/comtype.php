   <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Вид комиссии:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="comtype" name="comtype" value="<?php if($mainedit==1) {echo $mrow[44]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu" >
          <div class="item" data-value="0" data-text="Не требуется">Не требуется</div>
    <?php 
    $result = mysqli_query($link, "SELECT fb_comtype, name, tipname FROM lib_comtype WHERE status=1") or die("ошибка в выборке вида комиссии");
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