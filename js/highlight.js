/* 
HIGHLIGHT KEYWORDS BEGIN
*/



// yeah, browser sniffing sucks, but there are browser-specific quirks to handle that are not a matter of feature detection
var ua = window.navigator.userAgent.toLowerCase();
var isIE = !!ua.match(/msie|trident\/7|edge/);
var isWinPhone = ua.indexOf('windows phone') !== -1;
var isIOS = !isWinPhone && !!ua.match(/ipad|iphone|ipod/);



$('#keywords-textarea').on({
    "input": function (){
      updateKeywords();
    }
  });

function updateKeywords(){
  $('.textarea-wrap').each(function (){

    var $highlights = $(this).find('.highlights');
    var $textarea = $(this).find('textarea');
    handleInput($textarea,$highlights);

  })

}


function highlightIni(){
	$('.textarea-wrap').each(function(){    
		var $container = $(this);
		var $backdrop = $(this).find('.backdrop');
		var $highlights = $(this).find('.highlights');
		var $textarea = $(this).find('textarea');
		bindEvents($textarea,$backdrop,$highlights);
		handleInput($textarea,$highlights);
	});
}





function applyHighlights(text) {
	keywords = getKeyWords();

	for (var i = 0, len = keywords.length; i < len; i++) {

    if(keywords[i] != 'undefined'){

      var re = new RegExp(keywords[i],"gi");
      text = text.replace(re, '<mark>'+ keywords[i] +'</mark>');

    }
	}

  if (isIE) {
    // IE wraps whitespace differently in a div vs textarea, this fixes it
    text = text.replace(/ /g, ' <wbr>');
  }
  return text;
}

function handleInput($textarea,$highlights) {

  var text = $textarea.val();
  var highlightedText = applyHighlights(text);
  $highlights.html(highlightedText);

}

function handleScroll($textarea,$backdrop,$highlights) {

 // console.log('text-area '+$textarea.scrollTop());
  //console.log('backdrop '+ $backdrop.scrollTop());

  var scrollTop = $textarea.scrollTop();
  $backdrop.scrollTop(scrollTop);

  var scrollLeft = $textarea.scrollLeft();
  $backdrop.scrollLeft(scrollLeft);  

}

function fixIOS($highlights) {
  // iOS adds 3px of (unremovable) padding to the left and right of a textarea, so adjust highlights div to match
  $highlights.css({
    'padding-left': '+=3px',
    'padding-right': '+=3px'
  });
}

function bindEvents($textarea,$backdrop,$highlights) {
  $textarea.on({
    "input": function (){
    	handleInput($textarea,$highlights);
    },
    'scroll': function (){
		handleScroll($textarea,$backdrop,$highlights);
    }
  });
}

if (isIOS) {
  fixIOS();
}


$('.input-wrap textarea').keypress(function(event) {
    // Check the keyCode and if the user pressed Enter (code = 13) 
    // disable it
    if (event.keyCode == 13) {
        event.preventDefault();
    }
});



