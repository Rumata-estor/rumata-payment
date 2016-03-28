function dragScroll() {

	var $scrollChangesReceiver, 
	scrollStepInterval = 16, 
	dragSpeedPollInterval = 100,
	lastTimeSpeedPolled = 0, 
	dragging = false, 
	$cursorStyler, 
	lastMouseDownEvent, 
	$mouseEventsTarget
	
	spd = {
		x : 0,
		y : 0,
		minimal : .05,
		damping : .99,
		accelerator : 2
	}, 
	
	currentScroll = {
		x : 0,
		y : 0
	};

	function dragSpeedPoll() {

		var now = (new Date()).getTime();
		var interval = now - lastTimeSpeedPolled;
		if (interval == 0)
			return;

		var newScroll = {
			x : $scrollChangesReceiver.scrollLeft(),
			y : $scrollChangesReceiver.scrollTop()
		};

		spd.x = (newScroll.x - currentScroll.x) / interval;
		spd.y = (newScroll.y - currentScroll.y) / interval;

		currentScroll = newScroll;

		lastTimeSpeedPolled = (new Date()).getTime();
	}

	function scrollStep() {

		if (!dragging) {

			var speedIsLargeEnough = {
				x : Math.abs(spd.x) > spd.minimal,
				y : Math.abs(spd.y) > spd.minimal
			};

			if (speedIsLargeEnough.x || speedIsLargeEnough.y) {

				currentScroll = {
					x : $scrollChangesReceiver.scrollLeft(),
					y : $scrollChangesReceiver.scrollTop()
				};

				$scrollChangesReceiver.scrollLeft(currentScroll.x + spd.x * spd.accelerator);
				$scrollChangesReceiver.scrollTop(currentScroll.y + spd.y * spd.accelerator);

				spd.x *= spd.damping;
				spd.y *= spd.damping;

			}
		}

	}

	function applyDragScroll(e) {

		var eventDiff = {
			x : mouseDownEvent.screenX - e.screenX,
			y : mouseDownEvent.screenY - e.screenY
		};
		
		$scrollChangesReceiver.scrollLeft(mouseDownScroll.x + eventDiff.x)
		.scrollTop(mouseDownScroll.y + eventDiff.y);
		
	}
	
	setInterval(scrollStep, scrollStepInterval);

	setInterval(function() {

		if (dragging) {
			dragSpeedPoll();
		}
	}, dragSpeedPollInterval);

	mouseDownEvent = undefined, 
	mouseDownScroll = {
		x : 0,
		y : 0
	};

	$mouseEventsTarget = $('body');

	$scrollChangesReceiver = $(document);

	$cursorStyler = $('body');

	$mouseEventsTarget.on('mousedown', function(e) {

		e.preventDefault();

		dragging = true;

		$cursorStyler.addClass('grab');

		mouseDownEvent = e;

		mouseDownScroll.x = $scrollChangesReceiver.scrollLeft();
		mouseDownScroll.y = $scrollChangesReceiver.scrollTop();
		
		
		$(this).on('mouseup', function(e) {

			dragging = false;
	
			$cursorStyler.removeClass('grabbing grab');
			
			applyDragScroll(e);
	
			dragSpeedPoll();
			
			$(this).off('mousemove mouseup');
	
		}).on('mousemove', function(e) {
	
			e.preventDefault();
	
			if (!dragging)
				return;
	
			$cursorStyler.addClass('grabbing');
	
			applyDragScroll(e);
	
		});
	})

}

$(document).on('ready', function() {
	dragScroll();
})