$(document).ready(function(){

	// Hide all panes
	var $panes = $('.Pane');
  	$panes.hide();
  	var $nodecb = $("input[name='nodecb'");
  	$nodecb.attr("disabled",true);


	$("input[name='paneSelector']").click(function(){
		$panes.hide();
		$panes.eq($(this).val()).show();
	});
	$("select[name='headNode']").click(function(){



	});


  });