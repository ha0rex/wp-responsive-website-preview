jQuery(document).ready(function() {
	jQuery(".vc_mdp_outer_wrapper").each(function() {
		var outer_wrapper = jQuery(this),
			wrapper = outer_wrapper.children(".vc_mdp_wrapper"),
			iframe_wrapper = wrapper.children(".iframe_wrapper"),
			iframe = iframe_wrapper.children("iframe"),
			scale = wrapper.attr('data-scale'),
			toolbar_top = wrapper.children('.toolbar_top'),
			time = toolbar_top.children('.time'),
			disable_navigation = wrapper.attr('data-disable-navigation') == 'true' ? true : false;
			
		var getScrollBarWidth = function() {
			var inner = document.createElement('p');
			inner.style.width = "100%";
			inner.style.height = "200px";

			var outer = document.createElement('div');
			outer.style.position = "absolute";
			outer.style.top = "0px";
			outer.style.left = "0px";
			outer.style.visibility = "hidden";
			outer.style.width = "200px";
			outer.style.height = "150px";
			outer.style.overflow = "hidden";
			outer.appendChild (inner);

			document.body.appendChild (outer);
			var w1 = inner.offsetWidth;
			outer.style.overflow = 'scroll';
			var w2 = inner.offsetWidth;
			if (w1 == w2) w2 = outer.clientWidth;

			document.body.removeChild (outer);

			return (w1 - w2);		
		}
		
		var pad = function(n, width, z) {
		  	z = z || '0';
		  	n = n + '';
		  	return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
		}
		
		if(disable_navigation == true) {
			iframe.on('load', function() {
				jQuery(this).contents().find('*').click(function(e) {
					e.preventDefault();
					return false;
				});
			});
		}

		iframe.css({
			'right': -getScrollBarWidth()+'px',
			'width': '+='+getScrollBarWidth()+'px'
		});
		
		wrapper.css('transform', 'scale('+scale+')');
							
		outer_wrapper.css({
			width: wrapper[0].getBoundingClientRect().width,
			height: wrapper[0].getBoundingClientRect().height,
		});	
		
		var updateTime = function() {
			var d = new Date();
			time.html(pad(d.getHours(), 2)+':'+pad(d.getMinutes(), 2));
			setTimeout(function() {
				updateTime();
			}, 10000);
		}
		updateTime();	
	});
});


