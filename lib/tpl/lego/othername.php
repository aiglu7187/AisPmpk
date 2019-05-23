<div class="column">

<div class="ui fluid multiple search selection dropdown">
<input type="hidden" name="othersign" id="othersign" <?php if($mainedit==1) {echo 'value="'.$mrow[55].'"'; } ?> >
<i class="dropdown icon"></i>
<div class="default text">Выберите одного или нескольких членов комиссии</div>
<div class="menu">

<?php 
$result = mysqli_query($link, "SELECT second_name, first_name, third_name, other_prof, id_users FROM users WHERE role=10 AND profession=0 ORDER BY second_name") or die("ошибка в выборке");
while ($row = mysqli_fetch_row($result)) {

echo '<div class="item" data-value="'.$row[4].'" data-text="'.$row[0].' '.$row[1].' '.$row[2].'"><img class="ui mini avatar image" src="/img/user.png">('.$row[3].') '.$row[0].' '.$row[1].' '.$row[2].'</div>';

}

?>

</div>
</div>

</div> 