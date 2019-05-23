
<?php



$ztype = $_POST['zaktype'];
$atype = $_POST['aoop'];
$dopaoop2 = $_POST['plusaoop'];


$tutvar = 1;

require ('connect.php');

?>

<div class="ui segment">

<div class="field">
      <label>Тьюторское сопровождение:</label>
      <div class="ui selection multiple dropdown fluid">
<input type="hidden" id="tutor" name="tutor" >
  <i class="dropdown icon"></i>
  <div class="default text">Не требуется</div>
  <div class="menu" >


<?php


if ($dopaoop2 <> '') {



if (strlen($dopaoop2)>1) {

$dopmatix2 = explode(",", $dopaoop2);

} else {
  $dopmatix2[0] = $dopaoop2;
}

for ($i=0; $i < count($dopmatix2); $i++) { 

if ($dopmatix2[$i] == 10) {
  $tempaoop = 0;

} else {
$tempaoop = $dopmatix2[$i];
}

$result = mysqli_query($link, "SELECT fb_edulevel FROM lib_tutor WHERE status=1 AND fb_op LIKE '%{$tempaoop}%' ") or die("ошибка в выборке тьютор");
$row = mysqli_fetch_row($result);

if (strlen($row[0]) > 1) {
  $tutvar = 2;
} 



}

if ($atype == 10) {
  $atype = 0;
} 

$result = mysqli_query($link, "SELECT fb_edulevel FROM lib_tutor WHERE status=1 AND fb_op LIKE '%{$atype}%' ") or die("ошибка в выборке тьютор");
$row = mysqli_fetch_row($result);

if (strlen($row[0]) > 1) {
  $tutvar = 2;
} 



if ($tutvar == 2) {

$tempaoop = 9;

if ($atype == 0) { $tempaoop = 0; } 



  $result = mysqli_query($link, "SELECT fb_tutor, name, tipname FROM lib_tutor WHERE status=1 AND fb_op LIKE '%{$tempaoop}%'") or die("ошибка в выборке тьютор");
while ($row = mysqli_fetch_row($result)) {
  if ($row[2]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
  }

}

if (strlen($dopaoop2)>1) {
  if (strripos($dopaoop2, '8')) {  $dopras = 1; }
} else {
  $dopras = 0;
}

if ($atype == 7 && ( $dopras == 1 || $dopaoop2==8)) {
  $result = mysqli_query($link, "SELECT fb_tutor, name, tipname FROM lib_tutor WHERE status=1 AND fb_tutor = 9") or die("ошибка в выборке тьютор");
  $row = mysqli_fetch_row($result);
  if ($row[2]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
  }
} 




} else {


$tempaoop = 1;


  $result = mysqli_query($link, "SELECT fb_tutor, name, tipname FROM lib_tutor WHERE status=1 AND fb_op LIKE '%{$tempaoop}%' ") or die("ошибка в выборке тьютор");
while ($row = mysqli_fetch_row($result)) {
  if ($row[2]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
  }

}


}





} else {



if ($atype == 10) {
  $tempaoop = 0;

} else {
$tempaoop = $atype;

}

$result = mysqli_query($link, "SELECT fb_tutor, name, tipname FROM lib_tutor WHERE status=1 AND fb_op LIKE '%{$tempaoop}%' ") or die("ошибка в выборке тьютор");
while ($row = mysqli_fetch_row($result)) {
  if ($row[2]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
  }

}



}



echo "</div></div></div></div>";

?>





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
