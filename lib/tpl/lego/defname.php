
<div class="column">

         <div class="field">
<label>Учитель-дефектолог:</label>
    <div class="ui fluid  search selection dropdown">
      <input type="hidden"  name="defname" id="defname" <?php if($mainedit==1) {echo 'value="'.$mrow[34].'"'; } ?>>
      <i class="dropdown icon"></i>
      <div class="default text">Выберите из списка</div>
      <div class="menu">
      <div class="item" data-value="0" data-text="Нет"><img class="ui mini avatar image" src="/img/user.png">Нет</div>
 <?php 
     $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession=3 and role=10 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" style="color: green !important" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    $result = mysqli_query($link, "SELECT id_users, first_name, second_name, third_name FROM users WHERE acc_status=1 AND profession<>3 and role=10 ORDER BY second_name") or die("ошибка в выборке ассистента");
    while ($row = mysqli_fetch_row($result)) {
        $sfio = $row[2].' '.mb_substr($row[1],0,1,"UTF-8").'. '.mb_substr($row[3],0,1,"UTF-8").'.';
        echo '<div class="item" data-value="'.$row[0].'" data-text="'.$sfio.'"><img class="ui mini avatar image" src="/img/user.png">'.$sfio.'</div>';
    }
    ?>     

</div>
    </div>
  </div>
  </div>