<?php

$id = $_REQUEST['id'];
$ztype = $_REQUEST['ztype'];
$aoop =  $_REQUEST['aoop'];

if ($id && $ztype && $aoop) {

?>

<script type="text/javascript">

$( document ).ready(function() {

$( "#z<?php echo $ztype; ?>" ).trigger( "click" );

setTimeout(
  function() 
  {
    $( "#a<?php echo $aoop; ?>" ).trigger( "click" );
  }, 100);


});



</script>



<?php


}

?>