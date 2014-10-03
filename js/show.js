$(document).ready(function () {
	$('.show_tr').click(function() {		
		var url = 'showphotos.php?id='+$(this).attr("photos");
		var win = window.open(url, '_blank');
		win.focus();
	});
});