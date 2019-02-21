/*
* @description: Create virual background gradient
* @author: hoangtuan
* @bugs:
* @date: 23/01/2018

* @return: string  
*/

;(function($, window, document, undefined) {

	$.fn.Gradient = function(options) {

		var defaults = {
			className: 'test',
			leftColor: '#61CBFA',
			rightColor: '#1A0E8D',
			opacity: '0.6'
		}
		// Convert giá trị được truyền vào
	  	var settings = $.extend(defaults, options);

		this.init = function(){

			var _leftColor 	= $(this).data('left') ? $(this).data('left') : defaults.leftColor;
			var _rightColor = $(this).data('right') ? $(this).data('right') :defaults.rightColor;
			var _opacity 	= $(this).data('opacity') ? $(this).data('opacity') :defaults.opacity;

			console.log('_leftColor',_leftColor);

			$(this).wrapInner('<div class="wrap-gradient"></div>');
			var wrapItem = $(this).find(".wrap-gradient");

			$(this).css({
				'position' : 'relative',
			});

			wrapItem.css({
				'z-index':10,
				'position' : 'relative',
				'width' : '100%',
				'height' : '100%',
			})

			$(this).append('<span class="virtual-gradient"></span>');
			var gradientItem = $(this).find(".virtual-gradient");
			
			gradientItem.css({
				'position'	: 'absolute',
				'top'       : '0px',
				'left'      : '0px',
				'width'     : '100%',
				'height'    : '100%',
				'z-index'   : '5',
				'opacity'	: _opacity,
				'background': _leftColor,
				'background': '-moz-linear-gradient(left, '+_leftColor+' 0%, '+_rightColor+' 100%)',
				'background': '-webkit-gradient(left top, right top, color-stop(0%, '+_leftColor+'), color-stop(100%, '+_rightColor+'))',
				'background': '-webkit-linear-gradient(left, '+_leftColor+' 0%, '+_rightColor+' 100%)',
				'background': '-o-linear-gradient(left, '+_leftColor+' 0%, '+_rightColor+' 100%)',
				'background': '-ms-linear-gradient(left, '+_leftColor+' 0%, '+_rightColor+' 100%)',
				'background': 'linear-gradient(to right, '+_leftColor+' 0%, '+_rightColor+' 100%)',
				'filter': 'progid:DXImageTransform.Microsoft.gradient( startColorstr="'+_leftColor+'", endColorstr="'+_rightColor+'", GradientType=1 )'
			});

			$(".virtual-color").hide();

		}

		return this;

	}



})(window.Zepto || window.jQuery, window, document);