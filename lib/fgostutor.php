

<?php



$ztype = $_POST['zaktype'];
$atype = $_POST['aoop'];
$fgosvar = $_POST['fgosvar'];

require ('connect.php');


?>

<input type="hidden" id="tutor" name="tutor" >
  <i class="dropdown icon"></i>
  <div class="default text">Не требуется</div>
  <div class="menu" id="doptutor">

<?php 

$result = mysqli_query($link, "SELECT fb_tutor, name, tipname FROM lib_tutor WHERE status=1 AND fb_edulevel LIKE '%{$fgosvar}%' ") or die("ошибка в выборке тьютор");
while ($row = mysqli_fetch_row($result)) {
  if ($row[2]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
  }
}
?>

  </div>


  <script type="text/javascript">
  	
$('.checkbox')
.checkbox()
;

$('.radio.checkbox')
  .checkbox()
;

$('.dropdown')
  .dropdown()
; 
  </script>