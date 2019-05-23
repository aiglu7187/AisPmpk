function declOfNum(number, titles) {
  cases = [2, 0, 1, 1, 1, 2];  
  return number+" "+titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}

function birthDateToAge(b, n) {
  var x = new Date(n), z = new Date(b), b = new Date(b), n = new Date(n);
  x.setFullYear(n.getFullYear() - b.getFullYear(), n.getMonth() - b.getMonth(), n.getDate() - b.getDate());
  z.setFullYear(b.getFullYear() + x.getFullYear(), b.getMonth() + x.getMonth() + 1);
  if (z.getTime() == n.getTime()) {
    if (x.getMonth() == 11) {
      return [x.getFullYear() + 1, 0, 0];
    } else {
      return [x.getFullYear(), x.getMonth() + 1, 0];
    }
  } else {
    return [x.getFullYear(), x.getMonth(), x.getDate()];
  }
}



$( "#bdate" ).change(function() {

var birth = birthDateToAge($("#bdate").val(), $("#zdate").val());

$(".age").html( declOfNum(birth[0], ['г.', 'г.', 'л.']) + " " + declOfNum(birth[1], ['мес.', 'мес.', 'мес.']) ); 

});

$( "#zdate" ).change(function() {

var birth = birthDateToAge($("#bdate").val(), $("#zdate").val());

$(".age").html( declOfNum(birth[0], ['г.', 'г.', 'л.']) + " " + declOfNum(birth[1], ['мес.', 'мес.', 'мес.']) ); 

});


$( document ).ready(function() {
    if ($("#bdate").val()) {
      var birth = birthDateToAge($("#bdate").val(), $("#zdate").val());

      $(".age").html( declOfNum(birth[0], ['г.', 'г.', 'л.']) + " " + declOfNum(birth[1], ['мес.', 'мес.', 'мес.']) ); 
    }
});