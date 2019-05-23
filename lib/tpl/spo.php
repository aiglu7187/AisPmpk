<?php

//require ('connect.php');
require ('protobridge.php');
?>


<br><br>

<div class="form">


<div class="ui stackable two column grid ">


<div class="row">

<?php require('lego/zdate.php'); ?>

<?php require('lego/inv.php'); ?>  

</div>


<div class="row">

<?php require('lego/fio.php'); ?>  

<?php require('lego/bdate.php'); ?>  

  </div>



</div>

<div class="ui stackable one column grid ">

<div class="row">

<?php require('lego/oonum.php'); ?>   

</div>
</div>

<div class="ui stackable two column grid ">


<div class="row">

<div class="column">
      <div class="ui segment">
  <label>Выбранная программа:</label>
<div class="ui fluid labeled">
<b>
<?php
$result = mysqli_query($link, "SELECT spname FROM lib_op WHERE status=1 AND id_op = $aoop") or die("ошибка в выборке АООПов");
$row = mysqli_fetch_row($result);
echo $row[0];
?>

</b>

</div>

      </div>
    </div>

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

        $result = mysqli_query($link, "SELECT id_op FROM lib_op WHERE status=1 AND id_op <> 5 AND id_op <> 7 AND id_op < 9 AND id_op <> $aoop") or die("ошибка в выборке АООПов");

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


</div>








<div class="row">
  
<?php require('lego/stech.php'); ?>  
 

 <div class="column">
      <div class="ui segment">

<div class="field">
      <label>Безбарьерная архитектурная среда:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="block" name="block" <?php if($mainedit==1) {echo 'value="'.$mrow[21].'"'; } else { echo "value='0'";} ?> >
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
              <div class="item" data-value="0">не требуется</div>
              <div class="item" data-value="1">требуется</div>
          </div>
      </div>
  </div>

</div>

  </div>


  </div>

</div>







<div class="ui stackable one column grid " id="doppsy">
  <div class="row">


<?php require('lego/psywork.php'); ?> 

  </div>

  <div class="row" style="display:none">


<?php require('lego/logwork.php'); ?> 



  </div>

  <div class="row" <?php if ($aoop == 9) { echo "style='display:none'"; } ?>>


<?php require('lego/defwork.php'); ?> 



  </div>

  <div class="row">


<?php require('lego/socwork.php'); ?> 



  </div>
  </div>




<div class="ui stackable two column grid ">

<div class="row">

<?php require('lego/rdoop.php'); ?> 

<?php require('lego/dolg.php'); ?> 


  </div>

</div>




<div class="ui stackable two column grid " >

<div class="row">

<?php require('lego/comtype.php'); ?> 

<?php require('lego/roadmap.php'); ?> 

</div>

</div>




<div class="ui stackable four column grid " <?php if($mainedit==1 && $mrow[3] <> date("Y-m-d")) {echo 'style="display:none"'; } ?>>
<br>
<h4>Члены комиссии:</h4>

  <div class="row">

<?php require('lego/psyname.php'); ?> 
 
<?php require('lego/logname.php'); ?> 

<?php require('lego/defname.php'); ?> 

<?php require('lego/socname.php'); ?> 


</div>
</div>

<div class="ui stackable one column grid " <?php if($mainedit==1 && $mrow[3] <> date("Y-m-d")) {echo 'style="display:none"'; } ?>>
<br>
<h4>Иные члены комиссии:</h4>

<div class="row">

<?php require('lego/othername.php'); ?> 


</div>
</div>


<div class="ui stackable one column grid ">

<div class="row">

<?php require('lego/savenow.php'); ?> 

</div>

</div>





<div class="ui bottom fixed menu" id="oldcases" style="display: none; background-color: #90dc81;">

</div>

</div>



<script type="text/javascript" src="/js/commonz.js"></script>



<script type="text/javascript">
  

<?php
if ($mainedit <> 1) {
?>
$("#zdate").val(currentDate);
<?php
}
?>

$( "#savenow" ).click(function() {

if( $('.form').form('is valid')) {

if ($('#inv').is(":checked") == true) {
  inv = 1;
} else {
  inv = 0;
}

if ($('#rdoop').is(":checked") == true) {
  rdoop = 1;
} else {
  rdoop = 0;
}


if ($('#dolg').is(":checked") == true) {
  dolg = 1;
} else {
  dolg = 0;
}





if ($('#deviant').is(":checked") == true) {
  deviant = 1;
} else {
  deviant = 0;
}


if ($('#bil').is(":checked") == true) {
  bil = 1;
} else {
  bil = 0;
}

if ($('#bpolf').hasClass("positive") == true) {
  pol = 1;
} else {
  pol = 0;
}

<?php

if ($editmode==1) {

echo 'znum='.$prow[1];
?>


fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+15+";"+0+";"+0+";"+0+";"+1+";"+0+";"+1+";"+1+";"+1+";"+$("#stech").val()+";"+1+";"+$("#block").val()+";"+1+";"+0+";"+0+";"+$("#psywork").val()+";"+0+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+0+";"+0+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


$.ajax({   
    type: "POST",
    data:{"fulldata":fulldata, "znum":znum },
    url: "lib/makecrud.php",
    dataType: "html",            
    success: function(response){                    
        $('.good.modal').modal('show');
        $(".finbutton").html(response);
    }

});

<?php 

} elseif ($mainedit==1) {

?>


fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+15+";"+0+";"+0+";"+0+";"+1+";"+0+";"+1+";"+1+";"+1+";"+$("#stech").val()+";"+1+";"+$("#block").val()+";"+1+";"+0+";"+0+";"+$("#psywork").val()+";"+0+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+0+";"+0+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


$.ajax({   
    type: "POST",
    data:{"fulldata":fulldata, <?php echo '"notnew":'.$mrow[0]; echo ', "znum":'.$mrow[2]; ?> },
    url: "lib/makecrud.php",
    dataType: "html",            
    success: function(response){                    
        $('.good.modal').modal('show');
        $(".finbutton").html(response);
    }

});


<?php 

} else {

?>


$.ajax({   
    type: "POST",
    data:{}, 
    url: "lib/getZnum.php",
    dataType: "html",            
    success: function(response){                    
       znum=response;

       fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+15+";"+0+";"+0+";"+0+";"+1+";"+0+";"+1+";"+1+";"+1+";"+$("#stech").val()+";"+1+";"+$("#block").val()+";"+1+";"+0+";"+0+";"+$("#psywork").val()+";"+0+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+0+";"+0+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


        $.ajax({   
        type: "POST",
        data:{"fulldata":fulldata, "znum": znum },
        url: "lib/makecrud.php",
        dataType: "html",            
        success: function(response){                    
        $('.good.modal').modal('show');
        $(".finbutton").html(response);
        }

        });

    }

});

<?php

}

?>



} else {

msgerror = "";

if ($("#zdate").val() == "" ) {
  $("#zdate").parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Дата Заключения</div></div>";
}

if ($("#fio").val().length < 4 ) {
  $("#fio").parent().parent().addClass("red");
  msgerror += "<div class='item'  style='padding: 5px;'><i class='warning icon'></i><div class='content'>ФИО обучающегося</div></div>";
}

if ($("#bdate").val() == "" ) {
  $("#bdate").parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Дата рождения обучающегося</div></div>";
}

$(".msge").html("<div style='padding: 20px; margin: 10px' class='ui list'>"+msgerror+"</div>");

$('.bad.modal').modal('show');

}

});




$( "#bdate" ).change(function() {
  $(this).parent().removeClass("red");
});

$( "#zdate" ).change(function() {
  $(this).parent().removeClass("red");
});


$( "#fio" ).keydown(function() {
  $(this).parent().removeClass("red");
});

$('#fio').bind('keyup blur',function(){ 
    $(this).val($(this).val().replace(/[^'а-яА-ЯЁё -]/g,'') ); }
);



<?php

if ($mainedit==1) {



if ($mrow[25]) {
  echo "addpsy='".$mrow[25]."';";
} else {
  echo "addpsy=0;";
}

if ($mrow[26]) {
  echo "addlog='".$mrow[26]."';";
} else {
  echo "addlog=0;";
}

if ($mrow[27]) {
  echo "adddef='".$mrow[27]."';";
} else {
  echo "adddef=0;";
}

if ($mrow[28]) {
  echo "addsoc='".$mrow[28]."';";
} else {
  echo "addsoc=0;";
}


?>


timerset = 0;


$( document ).ready(function() {

$.ajax({   
    type: "POST",
    data:{"zaktype":<?php echo $zaktype; ?>, "aoop":<?php echo $aoop; ?>, "editable":1, "addpsy":addpsy, "addlog":addlog, "adddef":adddef, "addsoc":addsoc }, 
    url: "lib/dopaoop.php",
    dataType: "html",            
    success: function(response){                    
        $("#doppsy").html(response);

    }

});

});


<?php

}


if ($editmode==1 || $mainedit==1) {
?>
  $('#fio').change();
<?php
}

?>


$('.form')
  .form({
    fields: {
      fio     : 'empty',
      bdate   : 'empty',
      zdate : 'empty'
    }
  })
;

function beginsearchcases() {

$.ajax({   
    type: "POST",
    data:{"checkfio":checkfio, "checkbdate": checkbdate <?php if ($mainedit==1) { echo ', "notnew":'.$mrow[0]; } ?>}, 
    url: "lib/checkarchive.php",
    dataType: "html",            
    success: function(response){                    
        $("#oldcases").html(response);
    }

});


}

</script>

<script type="text/javascript" src="/js/age.js"></script>
