<div class="column">
      <div class="ui segment">
  <label>Выбранная программа:</label>
<div class="ui fluid labeled">
<b>
<?php
$result = mysqli_query($link, "SELECT dname FROM lib_op WHERE status=1 AND id_op = $aoop") or die("ошибка в выборке АООПов");
$row = mysqli_fetch_row($result);
echo $row[0];
?>

</b>

</div>

</div>
</div>