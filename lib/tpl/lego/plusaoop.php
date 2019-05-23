<div class="column">
      <div class="ui segment">



<div class="field ui fluid">
    <label>С учетом психофизических особенностей:</label>
    <div class="ui fluid selection dropdown multiple">
      <input type="hidden" id="plusaoop" name="plusaoop" <?php if($mainedit==1 && $mrow[8]<>0) {echo 'value="'.$mrow[8].'"'; } ?>>
      <i class="dropdown icon"></i>
      <div class="default text">Не требуется</div>
      <div class="menu">


        <?php 

        if ($zaktype<>3) {
        $result = mysqli_query($link, "SELECT id_op FROM lib_op WHERE status=1 AND id_op <> 5 AND id_op < 10 AND id_op <> $aoop") or die("ошибка в выборке АООПов");
        } else {
        $result = mysqli_query($link, "SELECT id_op FROM lib_op WHERE status=1 AND id_op <> 5 AND id_op < 9 AND id_op<>7 AND id_op <> $aoop") or die("ошибка в выборке АООПов");  
        }
        $mainmatrix = array();
        $dismatix = array();
        $distemp = array();


        $i = 0;
      while ($row = mysqli_fetch_row($result)) {

        $mainmatrix[$i] = $row[0];
        $i++;

      }

       $result = mysqli_query($link, "SELECT dismenu FROM lib_op WHERE status=1 AND id_op = $aoop") or die("ошибка в выборке АООПов");
       $row = mysqli_fetch_row($result);
      if ($row[0]<>'') { 
            if (stripos($row[0], ',')) {
              $dismatix = explode(",", $row[0]);

            } else {
              array_push($dismatix, $row[0]); 
            }
        } else {
          array_push($dismatix, 0);
        }


        //echo var_dump($dismatix);

      $finmatrix = array_diff($mainmatrix,$dismatix);
      $finmatrix = array_values($finmatrix);
      //echo var_dump($finmatrix);

      for ($i=0; $i < count($finmatrix) ; $i++) { 
        $tempmatrix = $finmatrix[$i];
        //echo $tempmatrix;
        $result = mysqli_query($link, "SELECT id_op, tipname FROM lib_op WHERE status=1 AND id_op = $tempmatrix") or die("ошибка в выборке АООПов 2");
        $row = mysqli_fetch_row($result);
        echo '<div class="item" id="dopaoopplus" name="dopaoopplus" ztype="'.$zaktype.'" aoop="'.$aoop.'" dopaoop="'.$row[0].'" data-value="'.$row[0].'" >'.$row[1].'</div>';
      }

        unset($dismatix);
        unset($mainmatrix);
        unset($distemp);

        ?>

      </div>
    </div>

      </div>
    </div>


  </div>