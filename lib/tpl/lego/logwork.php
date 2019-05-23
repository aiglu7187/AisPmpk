 <div class="column">
      <div class="ui segment">

<div class="field">
      <label>Учитель-логопед:</label>
      <div class="ui selection multiple search  dropdown fluid">
          <input type="hidden"  id="logwork" name="logwork" >
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu">

    <?php 

   
    $result = mysqli_query($link, "SELECT fb_worklog, id_edulevelvar, name, tipname FROM lib_worklog WHERE status=1 AND id_op=$aoop AND id_type_z=$zaktype") or die("ошибка в выборке ассистента");
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