<div class="column">
<div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Дата рождения
</div>
<input id="bdate" name="bdate" type="date"  class="oldcase" placeholder="10.10.2000" value="<?php if($editmode==1) {echo $prow[3]; } ?><?php if($mainedit==1) {echo $mrow[5]; } ?>">

<span class="ui tag label teal age">

</span>

</div>

</div>
</div>



</div>




<div class="row three column">


<div class="column" >

<div class="ui buttons inline field segment" style="width: 100%">
  <button id="bpolm" class="ui button bpol positive">Мужской</button>
  <div class="or" data-text="пол"></div>
  <button id="bpolf" class="ui button bpol">Женский</button>
</div>

<script type="text/javascript">
	
$( ".bpol" ).click(function() {
 	
 	$('.bpol').removeClass("positive");
	$(this).addClass("positive");

});

<?php 

if($editmode==1 && $prow[49]==1) {echo "$('.bpol').removeClass('positive'); $('#bpolf').addClass('positive');"; }

if($mainedit==1 && $mrow[49]==1) {echo "$('.bpol').removeClass('positive'); $('#bpolf').addClass('positive');"; } ?>


</script>

</div>


<div class="column">

<div class="inline field ui segment" style="height: 65px">

<div class="ui toggle checkbox ">
<input id="deviant" name="deviant" type="checkbox" tabindex="0" class="hidden" <?php if($editmode==1 && $prow[50]==1) {echo "checked"; } ?><?php if($mainedit==1 && $mrow[50]>0) {echo "checked"; } ?> > 
<label>Девиантное поведение</label>
</div>

</div>

</div>


<div class="column">
<div class="inline field ui segment" style="height: 65px">

<div class="ui toggle checkbox ">
<input id="bil" name="bil" type="checkbox" tabindex="0" class="hidden" <?php if($editmode==1 && $prow[51]==1) {echo "checked"; } ?><?php if($mainedit==1 && $mrow[51]>0) {echo "checked"; } ?> > 
<label>Билингвизм</label>
</div>
</div>

</div>





<div class="column ">

<div class="ui segment">

<div class="field">
<label>Место проведения обследования:</label>
<div class="ui selection dropdown fluid">
<input type="hidden" id="place" name="place" value="<?php if($mainedit==1) {echo $mrow[52]; } else { echo '1'; } ?>">
<i class="dropdown icon"></i>
<div class="default text">Выберите из списка</div>
<div class="menu" >
<?php 

$result = mysqli_query($link, "SELECT id, name FROM lib_gia_place WHERE status=1") or die("ошибка в выборке ");
while ($row = mysqli_fetch_row($result)) {
echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
}

?>            

</div>
</div>
</div>

</div>

</div>


<div class="column">
<div class="ui segment">

<div class="field">
<label>Состав / статус семьи</label>
<div class="ui fluid selection dropdown multiple">
<input type="hidden" id="family" name="family" <?php if($mainedit==1 && $mrow[53]<>0) {echo 'value="'.$mrow[53].'"'; } ?>>
<i class="dropdown icon"></i>
<div class="default text">Не требуется</div>
<div class="menu">

<?php 
$result = mysqli_query($link, "SELECT id_family, name FROM lib_family WHERE status=1") or die("ошибка в выборке ассистента");
while ($row = mysqli_fetch_row($result)) {

echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
}
?>

</div>
</div>
</div>

</div>

</div>



<div class="column">
<div class="ui segment">

<div class="field">
<label>Инициатор обращения</label>
<div class="ui fluid selection dropdown">
<input type="hidden" id="initd" name="initd" <?php if($mainedit==1 && $mrow[54]<>0) {echo 'value="'.$mrow[54].'"'; } ?>>
<i class="dropdown icon"></i>
<div class="default text">Не требуется</div>
<div class="menu">

<?php 
$result = mysqli_query($link, "SELECT id_init, name FROM lib_init WHERE status=1") or die("ошибка в выборке ассистента");
while ($row = mysqli_fetch_row($result)) {

echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
}
?>

</div>
</div>
</div>

</div>

</div>