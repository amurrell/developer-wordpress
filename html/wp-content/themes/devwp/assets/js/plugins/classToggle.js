app.classToggle = {
	init: function (toggles) {
		$(toggles).each(function() {
			var $this = $(this),
			target = $this.data('target'),
			className = $this.data('class');

			$this.on('click', function(e) {
				let elem = this;
				let type = target.substring(0,1);
			    let targetElem = '';
			    let activeClass = elem.id ? elem.id + '--active' :  elem.classList.item(0) + '--active';

			    switch(type) {
			      case '#':
			        targetElem = document.getElementById(target.substring(1));
			        console.log(targetElem)
			        break;
			      case '.':
			        targetElem = elem.querySelector(target);
			        break;
			      case 'n':
			        targetElem = elem.nextSibling;
			        break;
			    }

			    elem.classList.toggle(activeClass);
			    targetElem.classList.toggle(className);
			});


		});
	}
};
