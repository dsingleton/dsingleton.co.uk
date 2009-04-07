$(document).ready(function() {
	$("div.toread ol li a.markRead").click(function() {
		link = this;
		$.get(this.href, { ajax: "1" }, function(data){
		    if (data == 1) {
				$(link).parent().slideUp();
			}
			else {
				alert('Delete failed');
			}
		});
		return false;
	});
});