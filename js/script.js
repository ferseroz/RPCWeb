$(document).ready(function(){

	// Hide all panes
	var div = $('<div/>').append($('.ui.three.wide.column.nodeConfig').clone()).html();
	$('.ui.three.wide.column.nodeConfig').remove();
	var $panes = $('.Pane');
	$panes.hide();
	var $nodecb = $("input[name='nodecb'");
	$nodecb.attr("disabled",true);
	var previous;



	$("input[name='paneSelector']").click(function(){
		$panes.hide();
		$panes.eq($(this).val()).show();
	});


	$("select[name='numberHead']").change(function(){
		$('.ui.three.wide.column.nodeConfig').remove();
		var i = 0;
		while(i < $(this).val()){
			$(".ui.stackable.grid.nodeConfig").append(div);
			i++;
		}

		$("select[name='nodeHead']").click(function(){

			previous = this.value;
				
		}).change(function(){


			$("select[name='nodeHead'] option[value="+previous+"]").removeAttr("disabled","disabled");
			if($(this).val() !== "0"){
				//$('option:selected').attr("disabled","disabled");
				var se = $(this).val();
				//$("select option:not(:selected)").removeAttr("disabled","disabled");
				$("select[name='nodeHead'] option[value="+se+"]").attr("disabled","disabled");
				
			}
		});

	});



});

