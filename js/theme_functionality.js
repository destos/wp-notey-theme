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
				selectedOpts.title = $this.children('img').attr('title');
			}
		}
	});
	
	// top bar
	$('body > header > section').topbar( { extra: 'test', debug: true } );
	
});

// --------------------------------------------------------
// Top Menu handler
//

(function( $, tb ) {
	
	//
	// Debug Obj I made from stealing things
	//
	var debug_obj = {
		debug: function(s) {
			if ($.fn.topbar.options.debug)
				debug_obj.log(s);
		},
		log: function(){
			if (window.console && window.console.log)
				window.console.log('[topbar] ' + Array.prototype.join.call(arguments,' '));
		}
	};
	
	tb = $.fn.topbar = function( options ) {
		$.extend( true, tb.options, { s: this.selector, c: this.context }, options );
		return this.each( tb.init );
	};
	
	//
	// Main topbar functionality
	//
	$.extend( tb, debug_obj, {
		
		options: {
			debug: true
		},
		
		init: function( ) {
			//tb.debug(data);
			tb.debug('Starting Top Bar stuff');
			//console.log( test );
			
			target = $(this);
			//
			$( tb.options.s ).hover( tb.expand, tb.collapse );
		},
		
		expand: function(){
			tb.debug('expanding');
			$( tb.options.s, tb.options.c ).stop().animate({ 'height' : 140 })
			.parent().stop().animate({ backgroundPosition : '0 35px' });
			//.css("background-position", "50% " + offset + "px");
		},
		
		collapse: function(){
			tb.debug('collapsing');
			$( tb.options.s, tb.options.c ).stop().animate({ 'height' : 60 })
			.parent().stop().animate({ backgroundPosition : '0 0px' });
		}
		
	});
	
})(jQuery);

// --------------------------------------------------------
// Background position animator
//

/**
 * @author Alexander Farkas
 * v. 1.21
 */

(function($) {
	if(!document.defaultView || !document.defaultView.getComputedStyle){ // IE6-IE8
		var oldCurCSS = jQuery.curCSS;
		jQuery.curCSS = function(elem, name, force){
			if(name === 'background-position'){
				name = 'backgroundPosition';
			}
			if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){
				return oldCurCSS.apply(this, arguments);
			}
			var style = elem.style;
			if ( !force && style && style[ name ] ){
				return style[ name ];
			}
			return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force);
		};
	}
	
	var oldAnim = $.fn.animate;
	$.fn.animate = function(prop){
		if('background-position' in prop){
			prop.backgroundPosition = prop['background-position'];
			delete prop['background-position'];
		}
		if('backgroundPosition' in prop){
			prop.backgroundPosition = '('+ prop.backgroundPosition;
		}
		return oldAnim.apply(this, arguments);
	};
	
	function toArray(strg){
		strg = strg.replace(/left|top/g,'0px');
		strg = strg.replace(/right|bottom/g,'100%');
		strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2");
		var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
		return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]];
	}
	
	$.fx.step. backgroundPosition = function(fx) {
		if (!fx.bgPosReady) {
			var start = $.curCSS(fx.elem,'backgroundPosition');
			
			if(!start){//FF2 no inline-style fallback
				start = '0px 0px';
			}
			
			start = toArray(start);
			
			fx.start = [start[0],start[2]];
			
			var end = toArray(fx.options.curAnim.backgroundPosition);
			fx.end = [end[0],end[2]];
			
			fx.unit = [end[1],end[3]];
			fx.bgPosReady = true;
		}
		//return;
		var nowPosX = [];
		nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
		nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];           
		fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1];

	};
})(jQuery);
