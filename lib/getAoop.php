<?php



$zaknum = $_POST['zaknum'];



require ('connect.php');

switch ($zaknum) {

case 1:
		$result = mysqli_query($link, "SELECT id_op, tipname FROM lib_op WHERE status=1 ") or die("ошибка в выборке АООПов");
		while ($row = mysqli_fetch_row($result)) {
   			echo '<button id="a'.$row[0].'" name="a'.$row[0].'" atype="'.$row[0].'" ztype="1" class="ui button smenu">'.$row[1].'</button>';
		}
		break;


case 3:
		$result = mysqli_query($link, "SELECT id_op, tipname FROM lib_op WHERE status=1 AND id_op <> 10 AND id_op<>11") or die("ошибка в выборке АООПов");
		while ($row = mysqli_fetch_row($result)) {
   			echo '<button id="a'.$row[0].'" name="a'.$row[0].'" atype="'.$row[0].'" ztype="3"  class="ui button smenu">'.$row[1].'</button>';
		}
		break;


case 5:
		$result = mysqli_query($link, "SELECT id_op, tipname FROM lib_op WHERE status=1 AND id_op <> 5 AND id_op <> 7 AND id_op <> 10") or die("ошибка в выборке АООПов");
		while ($row = mysqli_fetch_row($result)) {
   			echo '<button id="a'.$row[0].'" name="a'.$row[0].'" atype="'.$row[0].'" ztype="5" class="ui button smenu">'.$row[1].'</button>';
		}
		break;

case 2:
		$result = mysqli_query($link, "SELECT id_op, tipname FROM lib_op WHERE status=1") or die("ошибка в выборке АООПов");

		while ($row = mysqli_fetch_row($result)) {
		echo '<button id="a'.$row[0].'" name="a'.$row[0].'" atype="'.$row[0].'" ztype="2" class="ui button smenu">'.$row[1].'</button>';
		}
		break;

case 4:
		$result = mysqli_query($link, "SELECT id_op, tipname FROM lib_op WHERE status=1") or die("ошибка в выборке АООПов");

		while ($row = mysqli_fetch_row($result)) {
		echo '<button id="a'.$row[0].'" name="a'.$row[0].'" atype="'.$row[0].'" ztype="4" class="ui button smenu">'.$row[1].'</button>';
		}
		break;
}


?>

 
<script type="text/javascript">
	
	$( ".smenu" ).click(function() {
	$(".smenu").removeClass( "green" );
	$(this).addClass( "green" );


$.ajax({   
        type: "POST",
        data:{"zaktype":$(this).attr('ztype'), "aoop":$(this).attr('atype') 
        <?php 
        if($_POST["proto"]) { 
        	echo ', "proto":'.$_POST["proto"]; 
        } 
        if($_POST["id"]) { 
        	echo ', "id":'.$_POST["id"]; 
        } 
        ?>}, 
        url: "lib/getZak.php",
        dataType: "html",            
        success: function(response){                    
            $("#maintpl").html(response); 
        }

    });










});

</script>