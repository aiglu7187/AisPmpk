

<div class="column">
<div class="ui segment">

<div class="ui fluid labeled category search oobase ">
<div class="ui label">
Наименование ОО:
</div>
<input id="oonum" name="oonum" type="text" style="width: 100% !important; border-radius: 3px !important" class="prompt" placeholder="Например: ГБОУ СОШ №111" value='<?php if($editmode==1) {echo $prow[5]; } ?><?php if($mainedit==1) {echo $mrow[37]; } ?>'>

</div>

      </div>
    </div>


<script type="text/javascript">
  
var oocontent = [

<?php


$result9 = mysqli_query($link, "SELECT name, oonum, region FROM src_oo") or die("ошибка в выборке");

while ($row9 = mysqli_fetch_row($result9)) {
    echo "{ title: '".$row9[0]."', price: '".$row9[1]."', description: '".$row9[2]."'  },";
}

?>

];

</script>

