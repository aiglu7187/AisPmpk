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
$result = mysqli_query($link, "SELECT sname FROM lib_op WHERE status=1 AND id_op = $aoop") or die("ошибка в выборке АООПов");
$row = mysqli_fetch_row($result);
echo $row[0];
?>

</b>

</div>

</div>
</div>

<?php require('lego/plusaoop.php'); ?> 


</div>




<div class="row">

<?php require('lego/edulevel.php'); ?>  


<?php require('lego/stech.php'); ?>  
 

  </div>



<div class="row">

<?php require('lego/assist.php'); ?>  

<?php require('lego/doptutor.php'); ?>  
 

  </div>



</div>






<div class="ui stackable one column grid " id="doppsy">
  <div class="row">


<?php require('lego/psywork.php'); ?> 

  </div>

  <div class="row">


<?php require('lego/logwork.php'); ?> 



  </div>

  <div class="row">


<?php require('lego/defwork.php'); ?> 



  </div>

  <div class="row">


<?php require('lego/socwork.php'); ?> 



  </div>
  </div>



<div class="ui stackable one column grid" id="rtime">

<h4>Cроки проведения повторного обследования обучающихся:</h4>

  <div class="row">


 <div class="column">
<div class="ui segment">
         <div class="field">

    <div class="ui fluid selection dropdown">
      <input type="hidden" name="fbtime" id="fbtime" value="<?php if($mainedit==1) {echo $mrow[30]; } ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">


<?php 
    $result = mysqli_query($link, "SELECT fb_time, name FROM lib_time WHERE status=1 AND fb_type_z=4 OR fb_time=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
      
        echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
      
    }
    ?>    

      </div>
    </div>
  </div>
</div>


  </div>


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

$checkaoop = <?php echo $aoop; ?>;


$( "#plusaoop" ).change(function() {

  $.ajax({   
        type: "POST",
        data:{"zaktype":<?php echo $zaktype; ?>, "aoop":<?php echo $aoop; ?>, "plusaoop":$("#plusaoop").val() }, 
        url: "lib/doptutor.php",
        dataType: "html",            
        success: function(response){                    
            $("#doptutor").html(response);
        }

    });



if ($("#plusaoop").val().indexOf('9')+1) {
  $("#rtime").hide();
  $tempedu = 1;
  $('#edulevel').val(5);
} else {
  if ($tempaoop == 0) {
    $tempedu = 0;
  $("#rtime").show();
  }
}
  
$.ajax({   
        type: "POST",
        data:{"zaktype":<?php echo $zaktype; ?>, "aoop":<?php echo $aoop; ?>, "plusaoop":$("#plusaoop").val(), "edulevel":$("#edulevel").val() }, 
        url: "lib/dopaoop.php",
        dataType: "html",            
        success: function(response){                    
            $("#doppsy").html(response);
        }

    });

});

$( "#edulevel" ).change(function() {
  
$.ajax({   
        type: "POST",
        data:{"zaktype":<?php echo $zaktype; ?>, "aoop":<?php echo $aoop; ?>, "plusaoop":$("#plusaoop").val(), "edulevel":$("#edulevel").val() }, 
        url: "lib/dopaoop.php",
        dataType: "html",            
        success: function(response){                    
            $("#doppsy").html(response);
        }

    });

});



$aoop =  <?php echo $aoop; ?>;

if ($aoop == 9 || $aoop == 10) {
  $("#rtime").hide();
  $tempaoop = 1;
  $tempedu = 1;
  $('#edulevel').val(5);

} else {
  $("#rtime").show();
  $tempaoop = 0;
  $tempedu = 0;
}


$( "#edulevel" ).change(function() {

if ($("#edulevel").val() == 5) {
  $("#rtime").hide();
  $tempaoop = 1;
  $tempedu = 1;
} else {
  if ($tempaoop == 0 && $tempedu == 0) {
  $("#rtime").show();
  }
}


});


if ($checkaoop < 3) {
  $("#logo").hide();
} else {
  $("#logo").show();
}






$( "#savenow" ).click(function() {

$('.form')
  .form({
    fields: {
      fio     : 'empty',
      bdate   : 'empty',
      psywork : 'empty',
      tutor     : 'empty',
      edulevel   : 'empty',
      zdate : 'empty'
    }
  })
;



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


if ($tempaoop == 1 || $tempedu == 1) {
  fbtemptime = "10";
} else {
  fbtemptime = $("#fbtime").val();
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

fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+$("#edulevel").val()+";"+1+";"+0+";"+1+";"+1+";"+$("#assist").val()+";"+1+";"+1+";"+1+";"+$("#stech").val()+";"+0+";"+0+";"+0+";"+1+";"+$("#tutor").val()+";"+$("#psywork").val()+";"+$("#logwork").val()+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+inv+";"+fbtemptime+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


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


fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+$("#edulevel").val()+";"+1+";"+0+";"+1+";"+1+";"+$("#assist").val()+";"+1+";"+1+";"+1+";"+$("#stech").val()+";"+0+";"+0+";"+0+";"+1+";"+$("#tutor").val()+";"+$("#psywork").val()+";"+$("#logwork").val()+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+inv+";"+fbtemptime+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


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

       fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+$("#edulevel").val()+";"+1+";"+0+";"+1+";"+1+";"+$("#assist").val()+";"+1+";"+1+";"+1+";"+$("#stech").val()+";"+0+";"+0+";"+0+";"+1+";"+$("#tutor").val()+";"+$("#psywork").val()+";"+$("#logwork").val()+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+inv+";"+fbtemptime+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


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


if ($("#tutor").val() == "" ) {
  $("#tutor").parent().parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Тьюторское сопровождение</div></div>";
}

if ($("#edulevel").val() == "" ) {
  $("#edulevel").parent().parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Уровень образования</div></div>";
}


if ($("#psywork").val() == "" ) {
  $("#psywork").parent().parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Направления работы специалистов</div></div>";
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
    data:{"zaktype":<?php echo $zaktype; ?>, "aoop":<?php echo $aoop; ?>, "plusaoop":$("#plusaoop").val(), "editable":1, "addpsy":addpsy, "addlog":addlog, "adddef":adddef, "addsoc":addsoc }, 
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