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
	
	$('body > header').click(function(){
		$('body').toggleClass('grid');
	})
	
});

// --------------------------------------------------------
// Top Menu handler
//
// TODO: when scrolling up and menu is open push up menu as its probably not needed.

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
	
	/*
	Has to be able to set the height via a attached click event on any object.
	handle binding to menu items and their coresponding revealed div, handle navigating revealed area.
	
	*/
	$.extend( tb, debug_obj, {
		
		options: {
			debug: true,
			speed: 500,
			easing: 'swing',
			expandfn: function(){},
			collapsefn: function(){}
		},
		
		//debug : function(s){}, // empty debug method
		
		init: function() {
		
			//tb.debug(data);
			tb.debug('Starting Top Bar stuff');
		
			//target = $(this);

			//$( tb.options.s ).hover( tb.expand, tb.collapse );
			//tb.moveto( 900 );
			
			/*
$('body').click(function(e){
				//$(this)
				
				tb.moveto( e.pageY );
			});
*/
			
		},
		
		expand: function(){
		
			tb.debug('expanding');
			
			//tb.debug(tb.options.speed);
			
			$( tb.options.s, tb.options.c ).stop().animate({ 'height' : 540 }, tb.options.speed, tb.options.easing )
			.parent().stop().animate({ backgroundPosition : 'center 125px' }, tb.options.speed, tb.options.easing,
				function(){
					if( $.isFunction(tb.options.expandfn) ){
						tb.options.expandfn(this, tb);
					}
				}
			);
			//.css("background-position", "50% " + offset + "px");
		},
		
		collapse: function(){
			tb.debug('collapsing');
			$( tb.options.s, tb.options.c ).stop().animate({ 'height' : 60 }, tb.options.speed, tb.options.easing )
			.parent().stop().animate({ backgroundPosition : 'center 0px' }, tb.options.speed, tb.options.easing,
				function(){
					if( $.isFunction(tb.options.collapsefn) ){
						tb.options.collapsefn(this, tb);
					}
				}
			);
		},
		
		moveto: function( h, callback ){
				
			if (h < 60 || typeof h !== 'number' )
				h = 60;
				
			tb.debug('moving to '+ h+'px');
			
			// DUN WERK! FIX THIS shiz
			var point = 140;
			var max_diff = 104;
			
			bgh = ( h < point )? Math.round((h*max_diff)/point-45) : h - max_diff;
			
			tb.debug('bg moving to '+ bgh+'px');
			/*
if( h > 140 ){
				bgh = 35;
			}else{
				bgh = (35*60)/h;
			}
*/
			
			$( tb.options.s, tb.options.c ).stop().animate({ 'height' : h }, tb.options.speed, tb.options.easing );
			/*
.parent().stop().animate({ backgroundPosition : 'center '+bgh+'px' }, tb.options.speed, tb.options.easing,
				function(){
					if( $.isFunction( callback ) ){
					 callback(this, tb);
					}
				}
			);
*/

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
