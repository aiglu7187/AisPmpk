
<?php

$editable = $_POST['editable'];

$addpsy = $_POST['addpsy'];
$addlog = $_POST['addlog'];
$adddef = $_POST['adddef'];
$addsoc = $_POST['addsoc'];


$ztype = $_POST['zaktype'];
$atype = $_POST['aoop'];
$dopaoop = $_POST['plusaoop'];
$edulevel = $_POST['edulevel'];
$fgosvar = $_POST['fgosvar'];

if ($dopaoop) {
$dopmatix = explode(",", $dopaoop);
} else {
	unset($dopmatix);
}

if ($dopmatix) {
  if (array_search('9',$dopmatix)) {
    $tempuo = 1;
  } else {
    $tempuo = 0;
  }
}

if ($ztype=='5') {
  $atype = 0;
}


if($edulevel) {

  if (($atype == 9 || $atype == 10) && $dopaoop) {
    $educond = "AND id_edulevel <> 4";
  } elseif ($dopaoop == 9 || $tempuo == 1) {
    $educond = "AND id_edulevel <> 4";
  } else {
     $educond = "AND id_edulevel=".$edulevel;
  }
  

} else {
  $educond = "";
}

if($fgosvar) {
  $fgosvar = "AND id_edulevelvar=".$fgosvar;
} else {
  $fgosvar = "";
}

require ('connect.php');


?>

<div class="row">


 <div class="column">
    <h4>Направления коррекционной работы:</h4>
      <div class="ui segment">

<div class="field">
      <label>Педагог-психолог:</label>
      <div class="ui selection multiple search  dropdown fluid">
          <input type="hidden" id="psywork" name="psywork" <?php if($editable==1 && $addpsy<>0) {echo 'value="'.$addpsy.'"'; } ?>>
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu">


<?php		

if ($addpsy<>0 && $editable==1) {

$oldpsy = " IN (".$addpsy.") ";

$result = mysqli_query($link, "SELECT fb_workpsy, id_edulevelvar, name, tipname FROM lib_workpsy WHERE fb_workpsy $oldpsy") or die("ошибка в выборке ");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

}



$result = mysqli_query($link, "SELECT fb_workpsy, id_edulevelvar, name, tipname FROM lib_workpsy WHERE status=1 AND id_op=$atype AND id_type_z=$ztype $educond $fgosvar") or die("ошибка в выборке пси");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

if($dopmatix) {

for ($i=0; $i < count($dopmatix); $i++) { 


$result = mysqli_query($link, "SELECT fb_workpsy, id_edulevelvar, name, tipname FROM lib_workpsy WHERE status=1 AND id_op=$dopmatix[$i] AND id_type_z=$ztype $educond $fgosvar") or die("ошибка в выборке пси-доп");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div style="color:#a333c8!important" class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div style="color:#a333c8!important" class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

}

}

?>

</div>
      </div>
  </div>

</div>

  </div>



  </div>

  <div class="row" id="logo">


 <div class="column">
      <div class="ui segment">

<div class="field">
      <label>Учитель-логопед:</label>
      <div class="ui selection multiple search  dropdown fluid">
          <input type="hidden"  id="logwork" name="logwork"  <?php if($editable==1 && $addlog<>0) {echo 'value="'.$addlog.'"'; } ?>>
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu">

<?php

if ($addlog<>0 && $editable==1) {

$oldlog = " IN (".$addlog.") ";

$result = mysqli_query($link, "SELECT fb_worklog, id_edulevelvar, name, tipname FROM lib_worklog WHERE fb_worklog $oldlog") or die("ошибка в выборке ");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

}

		
$result = mysqli_query($link, "SELECT fb_worklog, id_edulevelvar, name, tipname FROM lib_worklog WHERE status=1 AND id_op=$atype AND id_type_z=$ztype $educond  $fgosvar") or die("ошибка в выборке");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

if($dopmatix) {

	for ($i=0; $i < count($dopmatix); $i++) { 
	
$result = mysqli_query($link, "SELECT fb_worklog, id_edulevelvar, name, tipname FROM lib_worklog WHERE status=1 AND id_op=$dopmatix[$i] AND id_type_z=$ztype $educond  $fgosvar") or die("ошибка в выборке");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div style="color:#a333c8!important" class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div style="color:#a333c8!important" class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}
}
}


?>

</div>
      </div>
  </div>

</div>

  </div>



  </div>

  <div class="row" id="def">


 <div class="column">
      <div class="ui segment">

<div class="field">
      <label>Учитель-дефектолог:</label>
      <div class="ui selection multiple search  dropdown fluid">
          <input type="hidden"  id="defwork" name="defwork"    <?php if($editable==1 && $adddef<>0) {echo 'value="'.$adddef.'"'; } ?> >
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu">


<?php


if ($adddef<>0 && $editable==1) {

$olddef = " IN (".$adddef.") ";

$result = mysqli_query($link, "SELECT fb_workdef, id_edulevelvar, name, tipname FROM lib_workdef WHERE fb_workdef $olddef") or die("ошибка в выборке ");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

}
				
$result = mysqli_query($link, "SELECT fb_workdef, id_edulevelvar, name, tipname FROM lib_workdef WHERE status=1 AND id_op=$atype AND id_type_z=$ztype $educond  $fgosvar") or die("ошибка в выборке");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

if($dopmatix) {

	for ($i=0; $i < count($dopmatix); $i++) { 
	
$result = mysqli_query($link, "SELECT fb_workdef, id_edulevelvar, name, tipname FROM lib_workdef WHERE status=1 AND id_op=$dopmatix[$i] AND id_type_z=$ztype $educond  $fgosvar") or die("ошибка в выборке");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div style="color:#a333c8!important" class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div style="color:#a333c8!important" class="item" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}
}
}


?>


 </div>
      </div>
  </div>

</div>

  </div>



  </div>

  <div class="row">


 <div class="column">
      <div class="ui segment">

<div class="field">
      <label>Социальный педагог:</label>
      <div class="ui selection multiple search  dropdown fluid">
          <input type="hidden"  id="socwork" name="socwork"   <?php if($editable==1 && $addsoc<>0) {echo 'value="'.$addsoc.'"'; } ?> >
          <i class="dropdown icon"></i>
          <div class="default text">Не требуется</div>
          <div class="menu">



<?php



if ($addsoc<>0 && $editable==1) {

$oldsoc = " IN (".$addsoc.") ";

$result = mysqli_query($link, "SELECT fb_worksoc, id_edulevelvar, name, tipname FROM lib_worksoc WHERE fb_worksoc $oldsoc") or die("ошибка в выборке ");
while ($row = mysqli_fetch_row($result)) {
  if ($row[3]) {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[3].'</div>';
  } else {
    echo '<div class="item" style="color:#006633!important" data-value="'.$row[0].'" data-text="'.$row[2].'">'.$row[2].'</div>';
  }

}

}

						
$result = mysqli_query($link, "SELECT fb_worksoc, id_edulevelvar, name, tipname FROM lib_worksoc WHERE status=1 AND id_type_z=$ztype") or die("ошибка в выборке");
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



  </div>


  <script type="text/javascript">


$checkaoop = <?php echo $atype; ?>;

if ($checkaoop < 3) {
  $("#logo").hide();
} else {
  $("#logo").show();
}

if ($checkaoop == 11) {
  $("#def").hide();
} else {
  $("#def").show();
}


<?php 

if ($dopaoop == 1)  {
  echo '$("#logo").hide();';
}  elseif ($dopmatix) {
  if (array_search('1',$dopmatix)) {
    echo '$("#logo").hide();';
  }
}

?>

  
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
