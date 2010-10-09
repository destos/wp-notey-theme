jQuery(document).ready(function($) {
	
	//var msie6 = ( $.browser.msie && $.browser.version == 6 ) ? true : false ;
	
	// All other images in blog TODO make a better selector
	$('section.entry a:has(img:not(.attachment-thumbnail))').fancybox({
		'titleShow'			: true,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'titlePosition'	: 'inside',
		'hideOnContentClick' : true,
		'padding'				: 10,
		'onStart'				: function(selectedArray, selectedIndex, selectedOpts){
			
			var $this = $(selectedArray);
			
			var title = '';
			
			// check for image caption
			title = $this.siblings('.wp-caption-text').text();
			if( title ){
				selectedOpts.title = title;
			}else{
				// update with image title.
				selectedOpts.title = $this.children('img').attr('alt');
			}
		}
	});	

	/*
	// styling grid underlay.
	$('body > header').click(function(){
		$('body').toggleClass('grid');
	})
	*/
	
	// --------------------------------------------------------
	// Tipsy
	//
	
	var tipsy_options = {
		fade: false,
		title: 'data-tip',
		fallback: "couldn't get tip text",
		html: true,
		//gravity: $.fn.tipsy.autoWE
		trigger: 'hover'
	};
		
	// apply tipsy to all items with the data tip attribute
	$('[data-tip]').tipsy( tipsy_options );
	
});

(function($){

	$.fn.tipsy.elementOptions = function(ele, options) {
   
	  return $.extend({}, options, {
			gravity: $(ele).attr('data-tip-grav') || $.fn.tipsy.autoWE
		});
		
	};
	
})(jQuery);

// usage: log('inside coolFunc',this,arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console){
    console.log( Array.prototype.slice.call(arguments) );
  }
};

// catch all document.write() calls
(function(doc){
  var write = doc.write;
  doc.write = function(q){ 
    log('document.write(): ',arguments); 
    if (/docwriteregexwhitelist/.test(q)) write.apply(doc,arguments);  
  };
})(document);