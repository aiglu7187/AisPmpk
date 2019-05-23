
 <div class="column">
    <h4>Направления коррекционной работы:</h4>
      <div class="ui segment">

<div class="field">
      <label>Педагог-психолог:</label>
      <div class="ui selection multiple search  dropdown fluid psy">
          <input type="hidden" id="psywork" name="psywork" >
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu" >

    <?php 
    if ($zaktype == 5) {
      $result = mysqli_query($link, "SELECT fb_workpsy, id_edulevelvar, name, tipname FROM lib_workpsy WHERE status=1 AND id_type_z=$zaktype") or die("ошибка в выборке ");
    } else {
      $result = mysqli_query($link, "SELECT fb_workpsy, id_edulevelvar, name, tipname FROM lib_workpsy WHERE status=1 AND id_op=$aoop AND id_type_z=$zaktype") or die("ошибка в выборке ");
    }
    
    while ($row = mysqli_fetch_row($result)) {
      if ($row[3]) {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
      } else {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
      }

    }
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>