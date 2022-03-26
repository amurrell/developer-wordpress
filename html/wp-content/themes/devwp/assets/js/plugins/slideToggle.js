app.slideToggle = {
	init: function (toggles) {
		$(toggles).each(function() {
			var $this = $(this),
			$target = $($this.data('target'))
			activeClass = $this.data('active');

			$this.on('click', function() {
				$this.toggleClass(activeClass);
				$target.stop().slideToggle();
			});
		});



		// $('body').waypoint(function (direction) {
		// 	if (direction === 'down' ) {
		// 		scrollFunction();
		// 	}
		// }, {
		// 	offset: '-100px'
		// });
	}
};
