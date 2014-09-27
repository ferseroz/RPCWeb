$(document).ready(function(){

	// Hide all panes
	var $panes = $('.Pane');
  	$panes.hide();

	$("input[name='paneSelector']").click(function(){
		$panes.hide();
		$panes.eq($(this).val()).show();
	});
  });