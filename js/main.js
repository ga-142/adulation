
$(document).ready(function(){
   $('.max-30').each(function(){
      maxChar($(this).attr('id'),30);

   });
   $('.max-80').each(function(){
      maxChar($(this).attr('id'),80);

   });
   $('.max-15').each(function(){
      maxChar($(this).attr('id'),15);

   });
});



function maxChar(id,max){
   var text = $("label[for="+id+"]").html();
   var new_text = text.split('(')[0];
   var remaining = max - $('#'+id).val().length;
   $("label[for="+id+"]").html(new_text+" ("+remaining+" Chars)");
   if(remaining < 0){
       $("label[for="+id+"]").addClass('limit');
   }else{
       $("label[for="+id+"]").removeClass('limit');
   }
}
$(document).on('keyup', '.max-30', function() {
   maxChar($(this).attr('id'),30);
});
$(document).on('keyup', '.max-80', function() {
   maxChar($(this).attr('id'),80);
});
$(document).on('keyup', '.max-15', function() {
   maxChar($(this).attr('id'),15);
});

function addItem(item_class, max_char){

  var lineNum = $('.' + item_class).length;
  var thisLine = lineNum + 1;


  $( "#" + item_class + "-wrap" ).append( "<div class=\"input-wrap\"><label class=\""+ item_class +"-label\" for=\""+ item_class + "-" + thisLine + "\">Version " + thisLine + "</label><div class=\"textarea-wrap\" >              <div class=\"backdrop\"><div class=\"highlights\"></div></div>  <textarea id=\""+ item_class +"-" + thisLine + "\" class=\"max-"+ max_char + " "+ item_class +"\" rows=\"1\"  name='"+ item_class+"[]'></textarea></div><button type=\"button\"  id=\""+ item_class +"-" + thisLine + "-remove-button\" class=\"remove\" onclick=\"removeItem('"+ item_class +"','"+ item_class +"-" + thisLine + "');\" >- Remove -</button></div>" );


  $('.max-30').each(function(){
        maxChar($(this).attr('id'),30);
    });
    $('.max-80').each(function(){
        maxChar($(this).attr('id'),80);
    });
  highlightIni();
}
function removeItem(item_class,item_id) {
  var to_remove = $('#' + item_id );
  var tr_id = item_id; 
  var this_id = item_class + '-remove-button';


  to_remove.parents('.input-wrap').remove();

/*
  $('label[for="' + tr_id + '"]' ).unwrap();
  $('label[for="' + tr_id + '"]' ).remove();
  to_remove.unwrap()
  to_remove.remove();
  $('#' + tr_id + '-remove-button' ).remove();
*/

  var items = $('.' + item_class).length;
  if(items <= 2){
    $('#' + this_id).remove();
  }
  
  var thisLine = 1; 
  $('.' + item_class).each(function(){
      var id = $(this).attr('id');
        var new_id = item_class + "-" + thisLine;
        $('label[for="' + id + '"]' ).attr('for',new_id).html("Version "+thisLine);
        $('#'+id+'-remove-button').attr('id',new_id+"-remove-button").attr('onclick',"removeItem('"+ item_class +"','"+ new_id + "')");
        $(this).attr('id',new_id);
      thisLine++;
  });
  
    $('.max-30').each(function(){
        maxChar($(this).attr('id'),30);
    });
    $('.max-80').each(function(){
        maxChar($(this).attr('id'),80);
    });
}


$( "#add-first_headlines" ).click(function() {
  addItem('first_headlines',30);
});
$( "#add-second_headlines" ).click(function() {
  addItem('second_headlines',30);
});
$( "#add-descs" ).click(function() {
  addItem('descs',80);
});
$( document ).ready(function() {

    $('.max-30').each(function(){
        maxChar($(this).attr('id'),30);
    });
    $('.max-80').each(function(){
        maxChar($(this).attr('id'),80);
    });

    highlightIni();
});
 
function getKeyWords(){
  var keywords = new Array();
  console.log(typeof keywords );
  var get_keywords = $('#keywords textarea').val().split('\n');
  
  for(var i = 0;i < get_keywords.length;i++){
    if(get_keywords[i].length > 2){
      keywords.push($.trim(get_keywords[i]));
    }
  }
  $return =  keywords;
  return  $return;
}


$('#main-form').submit(function () {
  appendKeywords($(this));
});

$('#scrape-page').submit(function () {
  appendKeywords($(this));
});

function appendKeywords($form){
    var keywords = getKeyWords();   
    for (var i = 0, len = keywords.length; i < len; i++) {
      var input = $('<input />');
      input.attr('type', 'hidden');
      input.attr('name', 'keywords[]');
      input.attr('value', keywords[i]);
      input.appendTo($form);

    }
  return true;
}