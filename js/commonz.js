$( document ).ready(function() {

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



$( ".oldcase" ).change(function() {



setTimeout(function() {

checkfio = $('#fio').val();
checkbdate = $('#bdate').val();

timerset = 0;

if (checkfio != '' && checkbdate != '' && timerset == 0) {

  beginsearchcases();

} else {

  $('#oldcases').hide();

}

timerset = 1;

}, 1000);


});






