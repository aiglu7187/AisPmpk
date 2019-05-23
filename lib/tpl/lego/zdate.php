<div class="column">
      <div class="ui segment">
  <label>Дата проведения обследования:</label>
<div class="ui fluid labeled input">

<div class="ui label">
от
</div>
<input id="zdate" name="zdate" type="date" placeholder="дата заключения" <?php if($mainedit==1) {echo 'value="'.$mrow[3].'"'; } ?>>

<a class="ui tag label teal" onclick='$("#zdate").val(currentDate);'>
  Сегодняшнее число
</a>

</div>

      </div>
    </div>