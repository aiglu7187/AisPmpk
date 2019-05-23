<?php


require ('connect.php');


$act = $_POST['act'];

$namef = trim($_POST['namef']);
$namei = trim($_POST['namei']);
$nameo = trim($_POST['nameo']);

$prof = trim($_POST['prof']);
$edtprof = trim($_POST['edtprof']);
$visid = $_POST['visid'];
$edtid = $_POST['edtid'];
$cat = $_POST['cat'];
$delid = $_POST['delid'];

$hidehead = $_POST['hidehead'];
$hidecode = $_POST['hidecode'];
$hidesec = $_POST['hidesec'];
$fullname = $_POST['fullname'];
$pinkabbr = $_POST['pinkabbr'];
$bossname = $_POST['bossname'];
$pyear = $_POST['pyear'];
$pnum = $_POST['pnum'];




switch ($act) {
 	
 	case '1':

$login = translit($namef);

mysqli_query($link, "INSERT INTO users (login,first_name,second_name,third_name,profession) VALUES ('$login','$namei','$namef','$nameo','1')") OR die("NIEN!");

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role FROM users WHERE profession=1 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="1"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}


	break;
 	


 	case '2':

$login = translit($namef);

mysqli_query($link, "INSERT INTO users (login,first_name,second_name,third_name,profession) VALUES ('$login','$namei','$namef','$nameo','2')") OR die("NIEN!");

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=2 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="2"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}


	break;


 	case '3':

$login = translit($namef);

mysqli_query($link, "INSERT INTO users (login,first_name,second_name,third_name,profession) VALUES ('$login','$namei','$namef','$nameo','3')") OR die("NIEN!");

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=3 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="3"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}


	break;



 	case '4':

$login = translit($namef);

mysqli_query($link, "INSERT INTO users (login,first_name,second_name,third_name,profession) VALUES ('$login','$namei','$namef','$nameo','4')") OR die("NIEN!");

$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=4 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="4"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}


	break;

 	case '5':

$login = translit($namef);

mysqli_query($link, "INSERT INTO users (login,first_name,second_name,third_name,profession,other_prof) VALUES ('$login','$namei','$namef','$nameo','0','$prof')") OR die("NIEN!");



$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, other_prof, role FROM users WHERE profession=0 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[5]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td>'.$row[4].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="0"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}


	break;


case '6':

$result = mysqli_query($link, "SELECT role FROM users WHERE id_users='$visid' LIMIT 1") or die("ошибка в выборке");

$row = mysqli_fetch_row($result);

if ($row[0] == 10) {
	mysqli_query($link, "UPDATE users SET role='20' WHERE id_users='$visid' LIMIT 1");
} else {
	mysqli_query($link, "UPDATE users SET role='10' WHERE id_users='$visid' LIMIT 1");
}


break;


case '7':

$result = mysqli_query($link, "SELECT first_name, second_name, third_name, profession, other_prof, id_users FROM users WHERE id_users='$edtid' LIMIT 1") or die("ошибка в выборке");
$row = mysqli_fetch_row($result);

?>


<div class="header green">
    Редактирование члена комиссии
  </div>
  <div class="image content">

    <div class="description ui stackable three column grid">


<div class="row">
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="edtname1" id="edtname1" value="<?php echo $row[1]; ?>" placeholder="Фамилия">
 </div>
 </div>
 <div class="column">
<div class="ui fluid input">
	<input type="text" name="edtname2" id="edtname2" value="<?php echo $row[0]; ?>" placeholder="Имя">
 </div>
 </div>
  <div class="column">
<div class="ui fluid input">
	<input type="text" name="edtname3" id="edtname3" value="<?php echo $row[2]; ?>" placeholder="Отчество">
 </div>
</div>
 </div>

<?php

if ($row[3] == 0) {
?>

<div class="row">

<div class="column">
<div class="ui fluid input">
	<input type="text" name="edtprof" id="edtprof" value="<?php echo $row[4]; ?>" placeholder="Профессия">
 </div>
</div>

</div>

<?php
}
?>

<input type="hidden" name="cat" id="cat" value="<?php echo $row[3]; ?>">
<input type="hidden" name="edtid" id="edtid" value="<?php echo $row[5]; ?>">
     </div>
  </div>
  <div class="actions finbutton">
  	<a class="ui basic green button" id="saveedt" onclick="editme()">Сохранить</a>
    <a class="ui basic red button" onclick="$('.modal').modal('hide');" >Закрыть</a>

  </div>


<?php
break;





case '8':


mysqli_query($link, "UPDATE users SET first_name='$namei', second_name='$namef', third_name='$nameo', other_prof='$edtprof' WHERE id_users='$edtid' LIMIT 1");


switch ($cat) {

case '0':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, other_prof, role FROM users WHERE profession=0 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[5]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td>'.$row[4].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="0"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '1':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role FROM users WHERE profession=1 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="1"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '2':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=2 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="2"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '3':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=3 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="3"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '4':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=4 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="4"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}

break;

}



break;









case '9':

mysqli_query($link, "DELETE FROM users WHERE id_users='$delid' LIMIT 1");

switch ($cat) {

case '0':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, other_prof, role FROM users WHERE profession=0 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[5]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td>'.$row[4].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="0"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '1':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role FROM users WHERE profession=1 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="1"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '2':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=2 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="2"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '3':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=3 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="3"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}
break;


case '4':
$result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name, role  FROM users WHERE profession=4 ORDER BY second_name") or die("ошибка в выборке ФИО");
while ($row = mysqli_fetch_row($result)) {
if ($row[4]==20) {
	$role = " basic ";
} else {
	$role = "";
}
echo '<tr><td>'.$row[2].' '.$row[1].' '.$row[3].'</td>';
echo '<td><button id="edit'.$row[0].'" data-btn="'.$row[0].'" class="ui orange button edt" style="padding-right:10px;margin:3px"><i class="icon edit"></i></button><button class="ui blue button vis '.$role.'" id="vision'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon low vision"></i></button><button class="ui red button del" data-cat="4"  id="del'.$row[0].'" data-btn="'.$row[0].'" style="padding-right:10px;margin:3px"><i class="icon trash alternate outline"></i></button></td></tr>';
}

break;

}



break;



case '10':

mysqli_query($link, "UPDATE conf SET fullname='$fullname', pinkabbr='$pinkabbr', hidehead='$hidehead', hidecode='$hidecode', hidesec='$hidesec' LIMIT 1") or die("ошибка в введенных данных");

$pieces = explode(" ", $bossname);
$sfio = $pieces[0].' '.mb_substr($pieces[1],0,1,"UTF-8").'. '.mb_substr($pieces[2],0,1,"UTF-8").'.';
mysqli_query($link, "UPDATE lib_sboss SET fullname='$bossname', name='$sfio' LIMIT 1") or die("ошибка в введенных данных ФИО руководителя");

mysqli_query($link, "UPDATE znumber SET zdate='$pyear', zcnumber='$pnum' LIMIT 1") or die("ошибка в введенных данных (год, № заключения)");
mysqli_query($link, "UPDATE pnumber SET pdate='$pyear' LIMIT 1") or die("ошибка в введенных данных (год, № заключения)");

echo "Настройки успешно сохранены";


break;



default:

die();

break;

 }




 function translit($s) {
  $s = (string) $s; // преобразуем в строковое значение
  $s = strip_tags($s); // убираем HTML-теги
  $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
  $s = trim($s); // убираем пробелы в начале и конце строки
  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
  $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
  $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
  return $s; // возвращаем результат
}