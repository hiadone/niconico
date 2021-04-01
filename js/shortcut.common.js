(function() {
	function async_load(){          
	  var s = document.createElement('script');
	  s.type = 'text/javascript';
	  s.async = true;
	  s.id='hiadone_shortcut';
	  s.src = "/js/type_shortcut_niconicomall0804.js?brd_key=shortcut&post_md=niconicomall&v=0.21";
	  var x = document.getElementsByTagName('script')[0];
	  x.parentNode.insertBefore(s, x);
	}
	window.attachEvent ? window.attachEvent('onload', async_load) : window.addEventListener('load', async_load, false);
})();