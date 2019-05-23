<!DOCTYPE html>
<html lang="ru">
    <head>
      <title></title>
<link rel="stylesheet" type="text/css" href="../../semantic/dist/semantic.min.css">
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="../../semantic/dist/semantic.min.js"></script>

<style type="text/css">
  
.price {
  color: #eee !important;
}


</style>
</head>

<body>


<?php

require ('../connect.php');

//require ('protobridge.php');



if ($_REQUEST['id']) {
  $id = $_REQUEST['id'];
  $mainedit = 1;
  $presult = mysqli_query($link, "SELECT * FROM giabase WHERE id=$id LIMIT 1") or die("ошибка в выборе GIA");
  $mrow = mysqli_fetch_row($presult);
} else {
  $mainedit = 0;
}

include ('menu.php');

?>



<br><br>

<div class="ui form container">


<div class="ui stackable two column grid ">


<div class="row">

 <div class="column">
      <div class="ui segment">
  <label>Дата проведения обследования:</label>
<div class="ui fluid labeled input">

<div class="ui label">
от
</div>
<input id="zdate" name="zdate" type="date" placeholder="дата заключения" value="<?php if($mainedit==1) {echo $mrow[2]; } ?>">

<a class="ui tag label teal" onclick='$("#zdate").val(currentDate);'>
  Сегодняшнее число
</a>

</div>

      </div>
    </div>


    <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Место проведения обследования:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="place" name="place" value="<?php if($mainedit==1) {echo $mrow[3]; } else { echo '1'; } ?>">
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

   

  </div>





<div class="row">

    <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Форма проведения обследования:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="giaform" name="giaform" value="<?php if($mainedit==1) {echo $mrow[4]; } else { echo '1'; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu" >
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name FROM lib_gia_form WHERE status=1") or die("ошибка в выборке ассистента");
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

<div class="ui fluid labeled input">
<div class="ui label">
ФИО законного представителя
</div>
<input id="parfio" name="parfio" type="text"  placeholder="Пустое, если совершеннолетний" value="<?php if($mainedit==1) {echo $mrow[5]; }  ?>">

</div>

      </div>

    </div>

   

  </div>




<div class="row">
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
ФИО обучающегося
</div>
<input id="fio" name="fio" type="text"  placeholder="Иванов Иван Иванович" value="<?php if($mainedit==1) {echo $mrow[6]; } ?>">

</div>

      </div>

    </div>
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Дата рождения
</div>
<input id="bdate" name="bdate" type="date"   placeholder="10.10.2000" value="<?php if($mainedit==1) {echo $mrow[7]; } ?>">

<span class="ui tag label teal age">

</span>

</div>

      </div>
    </div>
  </div>

<div class="row">
<div class="column" >

<div class="ui buttons inline field segment" style="width: 100%">
  <button class="ui button disabled" style="width: 5px !important; padding-left: 0; padding-right: 0; color: #000 !important">Пол: </button>
  <button id="bpolm" class="ui button bpol positive">Мужской</button>
 
  <button id="bpolf" class="ui button bpol">Женский</button>
</div>

<script type="text/javascript">
  
$( ".bpol" ).click(function() {
  
  $('.bpol').removeClass("positive");
  $(this).addClass("positive");

});

<?php 

if($editmode==1 && $prow[48]==1) {echo "$('.bpol').removeClass('positive'); $('#bpolf').addClass('positive');"; }

if($mainedit==1 && $mrow[48]==1) {echo "$('.bpol').removeClass('positive'); $('#bpolf').addClass('positive');"; } ?>


</script>

</div>



<div class="column">
  <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Адрес проживания:
</div>
<input id="childadress" name="childadress" type="text"  placeholder="Например: ул. Ленина, 15" value="<?php if($mainedit==1 && $mrow[8]<>'0') {echo $mrow[8]; } ?>">

</div>

      </div>

    </div>





</div>



<div class="row">
<div class="column">
<div class="ui segment">

<div class="field">
<label>Инициатор обращения</label>
<div class="ui fluid selection dropdown">
<input type="hidden" id="initd" name="initd" <?php if($mainedit==1 && $mrow[50]<>0) {echo 'value="'.$mrow[50].'"'; } ?>>
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


<div class="column">
<div class="ui segment">

<div class="field">
<label>Состав / статус семьи</label>
<div class="ui fluid selection dropdown multiple">
<input type="hidden" id="family" name="family" <?php if($mainedit==1 && $mrow[49]<>0) {echo 'value="'.$mrow[49].'"'; } ?>>
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


  </div>

  </div>

<div class="ui stackable one column grid ">


 <div class="column">
      <div class="ui segment">

<div class="field">
      <label>Перечень документов, предоставленных на ЦПМПК:</label>
      <div class="ui selection multiple  dropdown fluid">
          <input type="hidden" id="giadocs" name="giadocs" value="<?php if($mainedit==1 && $mrow[9]<>'0') {echo $mrow[9]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu" >

    <?php 
    
    $result = mysqli_query($link, "SELECT id, name FROM lib_gia_docs WHERE status=1") or die("ошибка в выборке ");
    while ($row = mysqli_fetch_row($result)) {  
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
    }
    
    ?>            

          </div>
      </div>
  </div>

</div>

  </div>





</div>





<h4>Сведения о медицине:</h4>


<div class="ui stackable two column grid ">




<div class="row">
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Справка МСЭ, номер:
</div>
<input id="msenum" name="msenum" type="text" onchange="changeReason()"  placeholder="Например: 012345678" value="<?php if($mainedit==1 && $mrow[10]<>'0') {echo $mrow[10]; }  ?>">

</div>

      </div>

    </div>


 <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">

<div class="ui label">
Срок действия МСЭ:
</div>
<input id="msedate" name="msedate" type="date" value="<?php 

if($mainedit==1 && ($mrow[11]<>'1000-01-01')) 
  {
    echo $mrow[11]; 
  } ?>" >


<a class="ui tag label teal" id="mseun" onclick='mseswitch()'>
  Бессрочно
</a>

</div>

      </div>
    </div>


</div>





<div class="row">
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Номер медицинского заключения:
</div>
<input id="vknum" name="vknum" type="text"  placeholder="Например: 012345678" value="<?php if($mainedit==1 && $mrow[12]<>'0') {echo $mrow[12]; }  ?>">

</div>

      </div>

    </div>
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
Врачебная комиссия от:
</div>
<input id="vkdate" name="vkdate" type="date"  value="<?php if($mainedit==1 && $mrow[13]<>'1000-01-01') {echo $mrow[13]; } ?>">


</div>

      </div>
    </div>
  </div>

</div>

<div class="ui stackable one column grid ">

<div class="row">
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled category search medbase">
<div class="ui label">
Кем выдано медицинское заключение:
</div>
<input id="medname" name="medname" type="text" class="prompt"  placeholder="Например: ГБУЗ ДГКБ № 123" value='<?php if($mainedit==1 && $mrow[14]<>'0') {echo $mrow[14]; } ?>'>

</div>

      </div>

    </div>


<?php 
/*


    <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Код заболевания:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="giacode" name="giacode" value="<?php if($mainedit==1 && $mrow[15]<>'0') {echo $mrow[15]; }  ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name, tipname FROM lib_gia_code WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2]) {
          echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
        } else {
          echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
        }
    }
    
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>

*/

?>


  </div>

</div>

<div class="ui stackable two column grid ">

  <h4>Сведения об образовании:</h4>


<div class="row">




    <div class="column">
<div class="ui segment">

<div class="ui fluid labeled category search oobase input">
<div class="ui label">
Наименование ОО:
</div>
<input id="ooname" name="ooname" type="text" class="prompt" placeholder="Например: ГБОУ Школа № 123" value='<?php if($mainedit==1 && $mrow[16]<>'0') {echo $mrow[16]; } ?>'>

</div>


      </div>

    </div>

    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label">
ФИО ответственного специалиста от ОО:
</div>
<input id="oospec" name="oospec" type="text"  placeholder="Иванова Ирина Игоревна" value="<?php if($mainedit==1 && $mrow[18]<>'0') {echo $mrow[18]; } ?>">

</div>

      </div>

    </div>

</div>

</div>




<div class="ui stackable two column grid ">

<div class="row">

    <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Должность ответственного в ОО:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="ooprof" name="ooprof" value="<?php if($mainedit==1 && $mrow[19]<>'0') {echo $mrow[19]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name FROM lib_gia_ooprof WHERE status=1") or die("ошибка в выборке ассистента");
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

<div class="ui fluid labeled input">
<div class="ui label">
Контактный телефон специалиста ОО:
</div>
<input id="ootel" name="ootel" type="text"  value="<?php if($mainedit==1 && $mrow[20]<>'0') {echo $mrow[20]; }  ?>">

</div>

      </div>

    </div>


</div>






<div class="row">



  <div class="column ">

 <div class="ui segment">

<div class="field">
    <label>Класс:</label>
    <div class="ui selection dropdown fluid">
        <input type="hidden" id="childclass" name="childclass" value="<?php if($mainedit==1 && $mrow[21]<>'0') {echo $mrow[21]; }  ?>">
        <i class="dropdown icon"></i>
        <div class="default text">Выберите из списка</div>
        <div class="menu">
  <?php 
  
  $result = mysqli_query($link, "SELECT id, name, tipname FROM lib_gia_class WHERE status=1") or die("ошибка в выборке ассистента");
  while ($row = mysqli_fetch_row($result)) {
      if ($row[2]) {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
      } else {
        echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
      }
  }
  
  ?>            

        </div>
    </div>
</div>

</div>

</div>


  <div class="column ">

 <div class="ui segment">

<div class="field">
    <label>Программа обучения:</label>
    <div class="ui selection dropdown fluid">
        <input type="hidden" id="giaaoop" name="giaaoop" onchange="changeReason()" value="<?php if($mainedit==1 && $mrow[22]<>'0') {echo $mrow[22]; }  ?>">
        <i class="dropdown icon"></i>
        <div class="default text">Выберите из списка</div>
        <div class="menu">
  <?php 
  
  $result = mysqli_query($link, "SELECT id_op, gia FROM lib_op WHERE gia <>''") or die("ошибка в выборке ассистента");
  while ($row = mysqli_fetch_row($result)) {
      echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
  }
  
  ?>            

        </div>
    </div>
</div>

</div>

</div>


</div>









<div class="row">



  <div class="column ">

 <div class="ui segment">

<div class="field">
    <label>Форма обучения:</label>
    <div class="ui selection dropdown fluid">
        <input type="hidden" id="eduform" name="eduform" value="<?php if($mainedit==1 && $mrow[23]<>'0') {echo $mrow[23]; } ?>">
        <i class="dropdown icon"></i>
        <div class="default text">Выберите из списка</div>
        <div class="menu">
  <?php 
  
  $result = mysqli_query($link, "SELECT id, name, tipname FROM lib_gia_eduform WHERE status=1") or die("ошибка в выборке ассистента");
  while ($row = mysqli_fetch_row($result)) {
      if ($row[2]) {
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
      } else {
        echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
      }
  }
  
  ?>            

        </div>
    </div>
</div>

</div>

</div>


  <div class="column ">

 <div class="ui segment">

<div class="field">
    <label>Организация обучения:</label>
    <div class="ui selection dropdown fluid">
        <input type="hidden" id="eduorg" name="eduorg" onchange="changeReason()" value="<?php if($mainedit==1 && $mrow[24]<>'0') {echo $mrow[24]; } ?>">
        <i class="dropdown icon"></i>
        <div class="default text">Выберите из списка</div>
        <div class="menu">
  <?php 
  
  $result = mysqli_query($link, "SELECT id, name FROM lib_gia_eduorg WHERE status=1") or die("ошибка в выборке ");
  while ($row = mysqli_fetch_row($result)) {
      echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
  }
  
  ?>            

        </div>
    </div>
</div>

</div>

</div>


</div>



</div>





<div class="ui stackable one column grid " >


<div class="row" id="greason" <?php if($mrow[46]=='' || $mrow[46]=='0') {echo 'style="display: none"'; } ?>>
    <div class="column">
      <div class="ui segment">

<div class="ui fluid labeled input">
<div class="ui label" id="lreason">
Предыдущее Заключение ПМПК/путёвка-направление:
</div>
<input id="giareason" name="giareason" type="text"  placeholder="Например: Заключение (Ц)ПМПК № 1111 от 01.01.2010" value='<?php if($mainedit==1 && ($mrow[46]<>'' || $mrow[46]<>'0')) {echo $mrow[46]; } ?>'>

</div>

      </div>

    </div>

</div>


<div class="row">
     <div class="column ">

 <div class="ui segment">

<div class="field">
    <label>Реализация с применением:</label>
    <div class="ui fluid selection dropdown multiple">
        <input type="hidden" id="edurel" name="edurel" value="<?php if($mainedit==1 && $mrow[25]<>'0') {echo $mrow[25]; } ?>">
        <i class="dropdown icon"></i>
        <div class="default text">Выберите из списка</div>
        <div class="menu">
  <?php 
  
  $result = mysqli_query($link, "SELECT id, name FROM lib_gia_edurel WHERE status=1") or die("ошибка в выборке ассистента");
  while ($row = mysqli_fetch_row($result)) {
      echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
  }
  
  ?>            

        </div>
    </div>
</div>

</div>

</div>

</div>


<h4>Специальные условия ГИА:</h4>

<div class="row">

    <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Создание специальных условий при проведении:</label>
      <div id="spcond" class="ui fluid selection dropdown multiple">
          <input type="hidden" id="giaspec" name="giaspec" value="<?php if($mainedit==1 && $mrow[26]<>'0') {echo $mrow[26]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка, если нуждается в создании спец.условий</div>
          <div class="menu">
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name FROM lib_gia_spec WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        echo '<div class="item" id="spec'.$row[0].'" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[1].'</div>';
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

 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Русский язык в форме ГВЭ (для инвалидов и/или ОВЗ (АООП)):</label>
      <div class="ui fluid selection dropdown multiple">
          <input type="hidden" id="litrus" name="litrus" value="<?php if($mainedit==1 && $mrow[27]<>'0') {echo $mrow[27]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name, tipname FROM lib_gia_liter WHERE status=1 AND subject=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2]) {
          echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
        } else {
          echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
        }
    }
    
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>




 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Математика в форме ГВЭ (для инвалидов и/или ОВЗ (АООП)):</label>
      <div class="ui fluid selection dropdown multiple">
          <input type="hidden" id="litmat" name="litmat" value="<?php if($mainedit==1 && $mrow[28]<>'0') {echo $mrow[28]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name, tipname FROM lib_gia_liter WHERE status=1 AND subject=2") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2]) {
          echo '<div class="item" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
        } else {
          echo '<div class="item" data-value="'.$row[0].'">'.$row[1].'</div>';
        }
    }
    
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>

</div>


</div>









<div class="ui stackable one column grid ">


<div class="row">

 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Оформление КИМ:</label>
      <div class="ui fluid selection dropdown multiple">
          <input type="hidden" id="kim" name="kim" value="<?php if($mainedit==1 && $mrow[29]<>'0') {echo $mrow[29]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name, tipname, aoop FROM lib_gia_kim WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2]) {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
        } else {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'">'.$row[1].'</div>';
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

 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Рабочее место:</label>
      <div class="ui fluid selection dropdown multiple">
          <input type="hidden" id="workplace" name="workplace" value="<?php if($mainedit==1 && $mrow[30]<>'0') {echo $mrow[30]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    $result = mysqli_query($link, "SELECT id, name, tipname, aoop FROM lib_gia_workplace WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2]) {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
        } else {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'">'.$row[1].'</div>';
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

 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Ассистент:</label>
      <div class="ui fluid selection dropdown multiple">
          <input type="hidden" id="assist" name="assist" value="<?php if($mainedit==1 && $mrow[31]<>'0') {echo $mrow[31]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    $result = mysqli_query($link, "SELECT id, name, tipname, aoop FROM lib_gia_assist WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2]) {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
        } else {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'">'.$row[1].'</div>';
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

 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Оформление работы:</label>
      <div class="ui fluid selection dropdown multiple">
          <input type="hidden" id="typogr" name="typogr" value="<?php if($mainedit==1 && $mrow[32]<>'0') {echo $mrow[32]; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    $result = mysqli_query($link, "SELECT id, name, tipname, aoop FROM lib_gia_typogr WHERE status=1") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2]) {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'" data-text="'.$row[1].'">'.$row[2].'</div>';
        } else {
          echo '<div class="item greenlight" data-style="'.$row[3].'" data-value="'.$row[0].'">'.$row[1].'</div>';
        }
    }
    ?>            

          </div>
      </div>
  </div>

  </div>

  </div>

</div>


</div>




<div class="ui stackable three column grid ">


<div class="row">

 <div class="column ">
  
   <div class="ui segment">

<div class="field">
      <label>Тип ППЭ:</label>
      <div class="ui selection dropdown fluid">
          <input type="hidden" id="ppe" name="ppe" value="<?php if($mainedit==1) {echo $mrow[33]; } else { echo '1'; } ?>">
          <i class="dropdown icon"></i>
          <div class="default text">Выберите из списка</div>
          <div class="menu">
    <?php 
    
    $result = mysqli_query($link, "SELECT id, name FROM lib_gia_ppe WHERE status=1") or die("ошибка в выборке ассистента");
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
  <br>
      <div class="ui segment">

<div class="inline field">
 
    <div class="ui toggle checkbox ">
      <input id="dolg" name="dolg" type="checkbox" tabindex="0" class="hidden" <?php if($mainedit==1 && $mrow[34]==1) {echo "checked"; } ?> > 
      <label>Неполный пакет документов (долги)</label>
    </div>
  </div>

</div>

  </div>


 <div class="column">
  <br>
      <div class="ui segment">

<div class="inline field">
 
    <div class="ui toggle checkbox ">
      <input id="score" name="score" type="checkbox" tabindex="0" class="hidden" <?php if($mainedit==1 && $mrow[47]==1) {echo "checked"; } ?> > 
      <label>Мин.баллы по итоговому собеседованию (только для ГИА-9)</label>
    </div>
  </div>

</div>

  </div>


</div>




</div>




<div class="ui stackable four column grid " <?php if($mainedit==1 && $mrow[2] <> date("Y-m-d")) {echo 'style="display:none"'; } ?>>
<br>
<h4>Члены комиссии:</h4>

  <div class="row">


 <div class="column">

         <div class="field">
<label>Педагоги-психологи:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden" name="psyname1" id="psyname1" value="<?php if($mainedit==1) {echo $mrow[36]; } ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      
<div class="menu">
  <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=1 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>1 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }

    ?>

</div>

    </div>
  </div>


  <div class="field">
<label>&nbsp;</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden" name="psyname2" id="psyname2" value="<?php if($mainedit==1) {echo $mrow[37]; } ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      
<div class="menu">
  <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=1 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>1 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }

    ?>

</div>

    </div>
  </div>


  </div>


<div class="column">

         <div class="field">
<label>Учитель-логопед:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="logname" id="logname" value="<?php if($mainedit==1) {echo $mrow[38]; } ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
        <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
     $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=2 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>2 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    ?>     

</div>
    </div>
  </div>
  </div>


<div class="column">

         <div class="field">
<label>Учитель-дефектолог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="defname" id="defname" value="<?php if($mainedit==1) {echo $mrow[39]; } ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
     $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=3 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>3 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    ?>     

</div>
    </div>
  </div>
  </div>

<div class="column">

         <div class="field">
<label>Социальный педагог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="socname" id="socname" value="<?php if($mainedit==1) {echo $mrow[40]; } ?>">
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
     $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=4 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>4 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    ?>     

</div>
    </div>
  </div>
  </div>

  </div>
  </div>




<div class="ui bottom fixed menu" id="oldcases" style="display: none; background-color: #90dc81;">

</div>





<div class="ui stackable one column grid ">



  <div class="row">
<div class="column">
<br><br>
<div class="ui buttons ">
  <button id="savenow" onclick="$(this).removeAttr('id')" class="ui green button"><?php if($mainedit==1) {echo 'Пересохранить'; } else {echo 'Сохранить';} ?></button>
</div>

<a class="ui orange right floated button" href="/lib/tpl/showlist.php">Отменить и закрыть</a>
<br><br><br><br><br><br>

  </div>
</div>
</div>


</div>




<script type="text/javascript">


$( document ).ready(function() {

<?php if($mainedit==1) {
?>
  if($('#childclass').val() > 5) {
    $('#spec1').show();
  } else {
    $('#spec1').hide();
  }

  if($('#childclass').val() < 4) {
    $('#spec3').show();
  } else {
    $('#spec3').hide();
  }
<?php
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

$('.modal')
  .modal()
  .modal('setting', 'closable', false)
;

$('.medbase.search')
  .search({
    source: content,
    showNoResults: false,
  })
;

$('.oobase.search')
  .search({
    source: oocontent,
    showNoResults: false,
    searchFields: ['price', 'title']

  })
;

});



var fullDate = new Date();
var twoDigitMonth = (fullDate.getMonth() > 8)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
var twoDigitDay = (fullDate.getDate() > 9)? (fullDate.getDate()) : '0' + (fullDate.getDate());
var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDay;

<?php
if ($mainedit <> 1) {
?>
$("#zdate").val(currentDate);
<?php
}
?>

mseunlim = 0;

function mseswitch() {


if (mseunlim == 0) {
  $('#mseun').removeClass('teal');
  $('#mseun').addClass('orange');
  $('#msedate').attr("type","text");
  $('#msedate').val("Бессрочно");
  $('#msedate').attr("disabled", "disabled");
  mseunlim = 1;
} else {
  $('#mseun').removeClass('orange');
  $('#mseun').addClass('teal');
  $('#msedate').val("");
  $('#msedate').attr("type","date");
  $('#msedate').removeAttr("disabled");
  mseunlim = 0;
}



}



function changeReason() {


if ($('#giaaoop').val() != '11') {
  $('#greason').show();
  $('#lreason').html('Предыдущее Заключение ПМПК/путёвка-направление:');
  $('#giareason').attr('placeholder',"Например: Заключение (Ц)ПМПК № 1111 от 01.01.2010");
} else {
  


  switch ($('#eduorg').val()) {
    case '2':
    $('#greason').show();
    $('#lreason').html('Медицинское заключение об обучении на дому:');
    $('#giareason').attr('placeholder',"Введите номер, дату, кем выдано: № 1111 от 01.01.2010 выдано ГБУЗ КГП №3");
    break;

    case '3':
    $('#greason').show();
    $('#lreason').html('Медицинское заключение об обуч. в мед.организации:');
    $('#giareason').attr('placeholder',"Введите номер, дату, кем выдано: № 1111 от 01.01.2010 выдано ГБУЗ КГП №3");
    break;
  }

}

if ($('#msenum').val() != '') {
  $('#giareason').val('');
  $('#greason').hide();
}



}




 <?php 

 if ($mrow[11]=='3000-01-01') { echo 'mseswitch();'; } 

if ($editmode==1 || $mainedit==1) {
?>
  $('#fio').change();
  changeReason();
<?php
}
?>

msedatefin = "0";


$( "#savenow" ).click(function() {


if ($('#bpolf').hasClass("positive") == true) {
  pol = 1;
} else {
  pol = 0;
}


if( $('.form').form('is valid')) {

if ($('#dolg').is(":checked") == true) {
  dolg = 1;
} else {
  dolg = 0;
}

if ($('#score').is(":checked") == true) {
  score = 1;
} else {
  score = 0;
}

if (mseunlim == 1) {
msedatefin = "3000-01-01";
} else {
msedatefin =  $("#msedate").val();
}


<?php

if ($mainedit==1) {

?>

znum='<?php echo $mrow[1]; ?>';


fulldata = [$("#zdate").val()+";"+$("#place").val()+";"+$("#giaform").val()+";"+$("#parfio").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+$("#childadress").val()+";"+$("#giadocs").val()+";"+$("#msenum").val()+";"+msedatefin+";"+$("#vknum").val()+";"+$("#vkdate").val()+";"+$("#medname").val()+";"+0+";"+$("#ooname").val()+";"+0+";"+$("#oospec").val()+";"+$("#ooprof").val()+";"+$("#ootel").val()+";"+$("#childclass").val()+";"+$("#giaaoop").val()+";"+$("#eduform").val()+";"+$("#eduorg").val()+";"+$("#edurel").val()+";"+$("#giaspec").val()+";"+$("#litrus").val()+";"+$("#litmat").val()+";"+$("#kim").val()+";"+$("#workplace").val()+";"+$("#assist").val()+";"+$("#typogr").val()+";"+$("#ppe").val()+";"+dolg+";"+$("#psyname1").val()+";"+$("#psyname2").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+pol+";"+$("#family").val()+";"+$("#initd").val()];

$.ajax({   
    type: "POST",
    data:{"fulldata":fulldata, "znum": znum, "giareason": $('#giareason').val(), "score": score, "notnew":'<?php echo $mrow[0]; ?>' },
    url: "../makegia.php",
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
    url: "/lib/getZnum.php",
    dataType: "html",            
    success: function(response){                    
       znum=response;


fulldata = [$("#zdate").val()+";"+$("#place").val()+";"+$("#giaform").val()+";"+$("#parfio").val()+";"+$("#fio").val()+";"+$("#bdate").val()+";"+$("#childadress").val()+";"+$("#giadocs").val()+";"+$("#msenum").val()+";"+msedatefin+";"+$("#vknum").val()+";"+$("#vkdate").val()+";"+$("#medname").val()+";"+$("#giacode").val()+";"+$("#ooname").val()+";"+0+";"+$("#oospec").val()+";"+$("#ooprof").val()+";"+$("#ootel").val()+";"+$("#childclass").val()+";"+$("#giaaoop").val()+";"+$("#eduform").val()+";"+$("#eduorg").val()+";"+$("#edurel").val()+";"+$("#giaspec").val()+";"+$("#litrus").val()+";"+$("#litmat").val()+";"+$("#kim").val()+";"+$("#workplace").val()+";"+$("#assist").val()+";"+$("#typogr").val()+";"+$("#ppe").val()+";"+dolg+";"+$("#psyname1").val()+";"+$("#psyname2").val()+";"+$("#logname").val()+";"+$("#defname").val()+";"+$("#socname").val()+";"+pol+";"+$("#family").val()+";"+$("#initd").val()];


$.ajax({   
    type: "POST",
    data:{"fulldata":fulldata, "znum": znum, "giareason": $('#giareason').val(), "score": score },
    url: "../makegia.php",
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



$('#m6').addClass('positive');




$('.form')
  .form({
    fields: {
      fio     : 'empty',
      bdate   : 'empty',
      zdate : 'empty'
    }
  })
;


$( ".input" ).change(function() {
  $(this).parent().removeClass("red");
});


$( "#fio" ).keydown(function() {
  $(this).parent().removeClass("red");
});

$('#fio').bind('keyup blur',function(){ 
    $(this).val($(this).val().replace(/[^'а-яА-ЯЁё -]/g,'') ); }
);






$( "#childclass" ).change(function() {

  if($(this).val() > 5) {
    $('#spec1').show();
    $('#giaspec').val('');
    $('#spcond').dropdown('clear');
  } else {
    $('#spec1').hide();
    $('#giaspec').val('');
    $('#spcond').dropdown('clear');
  }

  if($(this).val() < 4) {
    $('#spec3').show();
    $('#giaspec').val('');
    $('#spcond').dropdown('clear');
  } else {
    $('#spec3').hide();
    $('#giaspec').val('');
    $('#spcond').dropdown('clear');
  }

  $(this).parent().removeClass("red");
});


greentriger = 0;


$( "#giaaoop" ).change(function() {

greentriger = $(this).val();

if (greentriger==11) {
  greentriger = 0;
}


$('.greenlight').each(function() {

str = $(this).attr('data-style');

if (str.indexOf(greentriger) >= 0) {
        $(this).css('color', 'green');
    } else {
        $(this).css('color', 'black');
    }

});

});



</script>





<div class="ui modal good">
  
  <div class="header green">
    Заключение успешно сохранено!
  </div>
  <div class="image content">
    <div class="image">
     </div>
    <div class="description">
     </div>
  </div>
  <div class="actions finbutton">

  </div>
</div>







<div class="ui modal bad">
  
  <div class="header green">
    Некоторые поля не заполнены:
  </div>
  <div class="msge">
    
  </div>
  <div class="actions">
    <div class="ui orange button ok">Вернуться к редактированию</div>
  </div>
</div>

<script type="text/javascript" src="/js/age.js"></script>

<script type="text/javascript">
  
var content = [

<?php


$result = mysqli_query($link, "SELECT name FROM src_medorg") or die("ошибка в выборке");

while ($row = mysqli_fetch_row($result)) {
    echo "{ title: '".$row[0]."' },";
}

?>

];



var oocontent = [

<?php


$result = mysqli_query($link, "SELECT name, oonum, region FROM src_oo") or die("ошибка в выборке");

while ($row = mysqli_fetch_row($result)) {
    echo "{ title: '".$row[0]."', price: '".$row[1]."', description: '".$row[2]."'  },";
}

?>

];


</script>