 <?php


$zaktype = $_POST['zaktype'];
$aoop = $_POST['aoop'];
$proto = $_POST['proto'];
$id = $_POST['id'];


require ('connect.php');



switch ($zaktype) {

case 1:
	if ($aoop==11) {
		include('tpl/earlyoop.php');
	} else {
	include('tpl/early.php');
	}

	break;

case 2:
		if ($aoop==11) {
			include('tpl/dooop.php');
		} else {
		include('tpl/do.php');
	}
	break;
case 3:
		include('tpl/fgos.php');
	break;
case 4:

if ($aoop==11) {
			include('tpl/soshoop.php');
		} else {
		include('tpl/sosh.php');
	}

		
	break;
case 5:
	if ($aoop==11) {
		include('tpl/spooop.php');
	} else {
		include('tpl/spo.php');
	}
	break;

	default:
		
	break;
}

?>