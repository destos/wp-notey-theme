jQuery(document).ready(function($) {
	
	var msie6 = ( $.browser.msie && $.browser.version == 6 ) ? true : false ;
	
	// All other images in blog TODO make a better selector
	$('article section.entry a:has(img:not(.attachment-thumbnail))').fancybox({
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
	
	// top bar
/*
	$('body > header > section').topbar({
		extra: 'test',
		debug: true,
		collapsefn: function( obj, tb ){
			tb.debug('collapsing done', obj );
		},
		expandfn: function( obj, tb ){
			tb.debug('expand done', obj );
		}
	});
*/
	
	$('body > header').click(function(){
		$('body').toggleClass('grid');
	})
	
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
			
		var is_input = $(ele).is('input');
		
		console.log(is_input);
		
		var binder   = options.live ? 'live' : 'bind',
        eventIn  = !is_input ? 'mouseenter' : 'focus',
        eventOut = !is_input ? 'mouseleave' : 'blur';
        
    //$(ele)[binder](eventIn, $.fn.tipsy.enter)[binder](eventOut, $.fn.tipsy.leave);
    
		//var new_options =
	  return $.extend({}, options, {
			gravity: $(ele).attr('data-tip-grav') || $.fn.tipsy.autoWE
			//trigger: is_input ? 'focus' : 'hover'
		});
		
	/*
		var binder   = new_options.live ? 'live' : 'bind',
	      eventIn  = new_options.trigger == 'hover' ? 'mouseenter' : 'focus',
	      eventOut = new_options.trigger == 'hover' ? 'mouseleave' : 'blur';
	  ele[binder](eventIn, enter)[binder](eventOut, leave);
	*/
		
		//console.log(new_options);
		
		//return new_options;
	};
	
})(jQuery);