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
	
});