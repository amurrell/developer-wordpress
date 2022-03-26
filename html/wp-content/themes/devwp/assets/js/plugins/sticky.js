app.sticky = {
	init: function (sticky) {
		
		if (sticky.data('sticky-initialized')) {
			return;
		}

		sticky.data('sticky-initialized', true);

		var _this = this;
		var targetSelector = sticky.attr('data-target-selector');
		var target = $(targetSelector);
		var toggleClasses = sticky.attr('data-toggle-classes');

		target.waypoint(function (direction) {

			if (direction === 'down') {
				sticky.toggleClass(toggleClasses);
			} else {
				sticky.toggleClass(toggleClasses);
			}

			
		}, {
			offset: function() {
				return _this.getOffset(sticky);
			}
    });
	},
	getOffset: function(sticky) {
		var targetSelector = sticky.attr('data-target-selector');
		var target = $(targetSelector);
		var percent = sticky.attr('data-percent') && sticky.attr('data-percent').length 
			? parseInt(sticky.attr('data-percent')) / 100
			: 65 / 100;
		var offset = -1 * percent * target[0].clientHeight; // when 65% of the container reference is above the viewport
		return offset;
	}
};
