
$(document).ready(function() {
		
	// Add preview 
	$('div.primary').before(
		'<div class="preview"> \
			<h2>Preview</h2> \
			<img id="preview" alt="Hover on an icon for a preview " /> \
		</div>'
	);
	$('.preview').hide().fadeIn(1500);
	
	// Add auto-complete silently?
	
	$('form.filter').attr('autocomplete', 'off');
	$('form.filter input.submit').fadeOut();
	
	// All the icons, we'll be using this a lot
	var icons = $('ol.icons li a');
	
	// Add hover  previews (doesn't work on filtered out icons)
	icons.hover(function() {

		if (!$(this).is('.less')) {
			$('img#preview').attr('src', this.href);
		}
		return false;
		
	}, function() {
		// Remove hover afterwards 
		if (!$(this).is('.less')) {
			$('img#preview').attr('src', '');
		}
	});
	
	// Filtering search (with delay)
	var search_timer = false;
	$('#search').keyup(function() {
		
		// Clear timed events if we've have another key press
		if (search_timer) {
			window.clearTimeout(search_timer);
		}

		var filter = this.value;
		search_timer = window.setTimeout(function () {
			// If we match the filter word anywhere then full opacity, otherwise greyed out
			icons.each(function() {
				if (this.title.indexOf(filter) >= 0) {
					$(this).removeClass('less');
				}
				else {
					$(this).addClass('less');
				}

			});
		}, 300);
		return false;
	});
});