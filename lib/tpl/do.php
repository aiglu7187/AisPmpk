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

<?php require('lego/aoop.php'); ?> 

<?php require('lego/plusaoop.php'); ?> 


</div>



<div class="row">
  
<?php require('lego/assist.php'); ?>  

<?php require('lego/stech.php'); ?>  
 
 </div>

</div>


<div class="ui stackable one column grid" >

<div class="row">
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



<div class="ui stackable one column grid">

<h4>Cроки проведения повторного обследования обучающихся:</h4>
  <div class="row">

<?php require('lego/fbtime.php'); ?> 

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

  
$.ajax({   
        type: "POST",
        data:{"zaktype":<?php echo $zaktype; ?>, "aoop":<?php echo $aoop; ?>, "plusaoop":$("#plusaoop").val() }, 
        url: "lib/dopaoop.php",
        dataType: "html",            
        success: function(response){                    
            $("#doppsy").html(response);
        }

    });

});



$checkaoop = <?php echo $aoop; ?>;


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
      tutor     : 'empty',
      fbtime : 'empty',
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

fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+6+";"+1+";"+0+";"+1+";"+0+";"+$("#assist").val()+";"+1+";"+0+";"+1+";"+$("#stech").val()+";"+0+";"+0+";"+0+";"+1+";"+$("#tutor").val()+";"+$("#psywork").val()+";"+$("#logwork").val()+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+inv+";"+$("#fbtime").val()+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


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


fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+6+";"+1+";"+0+";"+1+";"+0+";"+$("#assist").val()+";"+1+";"+0+";"+1+";"+$("#stech").val()+";"+0+";"+0+";"+0+";"+1+";"+$("#tutor").val()+";"+$("#psywork").val()+";"+$("#logwork").val()+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+inv+";"+$("#fbtime").val()+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


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

       fulldata = [<?php echo $zaktype; ?>+";"+$("#zdate").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+inv+";"+<?php echo $aoop; ?>+";"+$("#plusaoop").val()+";"+6+";"+1+";"+0+";"+1+";"+0+";"+$("#assist").val()+";"+1+";"+0+";"+1+";"+$("#stech").val()+";"+0+";"+0+";"+0+";"+1+";"+$("#tutor").val()+";"+$("#psywork").val()+";"+$("#logwork").val()+";"+$("#defwork").val()+";"+$("#socwork").val()+";"+inv+";"+$("#fbtime").val()+";"+$("#psyname").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+"0"+";"+0+";"+$("#oonum").val()+";"+rdoop+";"+dolg+";"+$("#comtype").val()+";"+$("#roadmap").val()+";"+pol+";"+deviant+";"+bil+";"+$("#place").val()+";"+$("#family").val()+";"+$("#initd").val()+";"+$("#othersign").val()];


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


if ($("#fbtime").val() == "" ) {
  $("#fbtime").parent().parent().parent().addClass("red");
  msgerror += "<div class='item' style='padding: 5px;''><i class='warning icon'></i><div class='content'>Cроки проведения повторного обследования обучающихся</div></div>";
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

$('.form')
  .form({
    fields: {
      fio     : 'empty',
      bdate   : 'empty',
      tutor     : 'empty',
      fbtime : 'empty',
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
