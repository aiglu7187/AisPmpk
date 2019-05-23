 <div class="column" id="doptutor">
      <div class="ui segment">

<div class="field">
      <label>Тьюторское сопровождение:</label>
      <div class="ui selection multiple dropdown fluid">
          <input type="hidden" id="tutor" name="tutor" <?php if($mainedit==1 && $mrow[24]<>0) {echo 'value="'.$mrow[24].'"'; } ?>>
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu" >

            <?php 

            if ($aoop == 10) {
              $tempaoop = 0;

            } else {
            $tempaoop = $aoop;
            }

if ($zaktype <= 2) {
$templev = " AND fb_tutor != 9";
} else {
$templev = "";
}

            $result = mysqli_query($link, "SELECT fb_tutor, name, tipname FROM lib_tutor WHERE status=1 AND fb_op LIKE '%{$tempaoop}%' $templev") or die("ошибка в выборке тьютор");
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
