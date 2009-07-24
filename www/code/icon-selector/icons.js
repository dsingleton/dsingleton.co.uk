
$(document).ready(function() {
	
	// Add Form
	$('div.primary').after(
		'<div class="secondary"> \
		    <form action="" class="filter" autocomplete="off"> \
			    <h2><label for="search">Filter</label></h2> \
			    <input type="text" class="text" name="search" id="search" /> \
		    </form> \
		</div>'
	);
	
	// Add preview 
	$('div.secondary').after(
		'<div class="tertiary preview"> \
			<h2>Preview</h2> \
			<img id="preview" alt="Hover on icon " /> \
		</div>'
	);
	$('.preview').hide().fadeIn(1500);
	

	$('.filter').hide().fadeIn(1500);
	
	// All the icons, we'll be using this a lot
	var icons = $('ol.icons li a');
	
	// Add hover  previews (doesn't work on filtered out icons)
	icons.hover(function() {

		if ($(this).css('opacity') > .5) {
			$('img#preview').attr('src', this.href);
		}
		return false;
		
	}, function() {
		// Remove hover afterwards 
		if ($(this).css('opacity') > .5) {
			$('img#preview').removeAttr('src');
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
			// If we match the filter word anywhere then full opacity, 
			// otherwise greyed out
			icons.each(function() {
				var opacity = (this.title.indexOf(filter) >= 0) ? 1 : 0.1;
				$(this).css('opacity', opacity);
			});
		}, 300);
		return false;
	});
});