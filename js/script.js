$(document).ready(function(){

	// Hide all panes
	var div = $('<div/>').append($('.ui.three.wide.column.nodeConfig').clone()).html();
	$('.ui.three.wide.column.nodeConfig').remove();
	var $panes = $('.Pane');
	$panes.hide();
	//$(".loginForm").hide();
	var previous;

	$("input[name='fetchNode']").click(function(){

	});

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

		$("select[name='head[]']").click(function(){

			previous = this.value;

		}).change(function(){


			$("select[name='head[]'] option[value="+previous+"]").removeAttr("disabled","disabled");
			$("input[type=checkbox][value="+previous+"]")
						.attr("disabled",false);

			if($(this).val() !== "0"){
				//$('option:selected').attr("disabled","disabled");
				var se = $(this).val();
				//$("select option:not(:selected)").removeAttr("disabled","disabled");
				$("select[name='head[]'] option[value="+se+"]").attr("disabled","disabled");
				$("input[type=checkbox][value="+se+"]")
						.attr("disabled",true);
			}
		});

		$("input[name='nodecb[]']").change(function(){
		if(this.checked){
			$("input[type=checkbox][value="+$(this).val()+"]")
			.not(this)
			.attr("disabled",true);
		}else{
			$("input[type=checkbox][value="+$(this).val()+"]")
			.not(this)
			.attr("disabled",false);

		}
	});

	});
	function studentLogin(){

	}

	function adminLogin(){
		$(".loginForm").hide();
		alert("yoyooyoyoyo");
	}


});

