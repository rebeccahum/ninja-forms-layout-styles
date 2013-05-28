jQuery(document).ready(function($) {

	$("#advanced_css").live("change", function(){
		if( this.checked ){
			$("tr.advanced").removeClass("hidden");
		}else{
			$("tr.advanced").addClass("hidden");
		}
	});

	$(".color-picker").wpColorPicker();
	
	$("#field_type").change(function(){
		var field_type = $("#field_type").val();
		reloadWithQueryStringVars({"field_type": field_type});
	});	

	//Field Styling Thickbox Controls
	$(".field-styling").live("click", function(event){
		var field_id = this.id.replace("styling_", "");
		$("#ninja_forms_field_styling").prop("innerHTML", "");
		$("#loading_style").show();
		$.post( ajaxurl, { field_id: field_id, action:"ninja_forms_style_field_styling"}, function(response){
			$("#loading_style").hide();
			$("#ninja_forms_field_styling").append(response);
			$(".color-picker").wpColorPicker();
			$(".hndle").dblclick(function(event){
				$(this).prevAll(".item-controls:first").find("a").click();
			});
		});
	});

	$(".save-field-styling").click(function(){
		var data = $("#ninja_forms_field_styling").find(":input").serializeFullArray();
		$("#loading_style").show();
		$.post( ajaxurl, { data: data, action:"ninja_forms_style_field_styling_save"}, function(response){
			tb_remove();
			$("#ninja_forms_field_styling").prop("innerHTML", '');
			$("#loading_style").hide();
		});		
	});

	$(".cancel-field-styling").click(function(){
		tb_remove();
		$("#ninja_forms_field_styling").prop("innerHTML", "");
	});	

	//Form Styling Thickbox Controls
	$(".cancel-form-styling").click(function(){
		tb_remove();
	});	

	$(".save-form-styling").click(function(){
		var data = $("#ninja_forms_form_style_inputs").find(":input").serializeFullArray();
		$("#loading_style").show();

		$.post( ajaxurl, { data: data, action:"ninja_forms_style_form_styling_save"}, function(response){
			tb_remove();
			$("#loading_style").hide();
		});
	});

	$( ".ninja-forms-style-sortable" ).sortable({
		items: "li:not(.ui-state-disabled)",
		tolerance: "intersect",
		cursor: "move",
		placeholder: "ninja-forms-style-placeholder",
		forcePlaceholderSize: true,
		opacity: 0.4,
		handle: ".style-handle",

		connectWith: ".ninja-forms-style-sortable",
	  start: function(e,ui){
            ui.placeholder.height(ui.item.height());
            ui.placeholder.width(ui.item.width());
        }
	});

	$( ".ninja-forms-style-sortable" ).disableSelection();

	$( "#ninja_forms_admin").submit(function(){
		if( $("#mp_form").val() == "1" ){
			$(".field-order").each(function(){
				var page = this.id.replace("order_", "");
				ninja_forms_style_mp_update_field_pos(page);
			});
		}else{
			ninja_forms_style_update_field_pos();
		}
		//return false;
	});

	$(".ninja-forms-style-expand").live("click", function(event){
		if( $("#mp_form").val() == "1" ){
			var page = $("#mp_page").val();
			var cols = $("#cols_" + page).val();
		}else{
			var cols = $("#cols").val();
		}

		var id = $(this).parent().prop("id").replace("_li", "_colspan");
		var span = $(this).parent().attr("rel");
		cols = parseInt(cols);
		span = parseInt(span);

		if( span == cols ){
			var new_span = 1;
		}else{
			var new_span = span + 1;
		}

		$(this).parent().removeClass("span-" + span);
		$(this).parent().addClass("span-" + new_span)
		$(this).parent().attr("rel", new_span);
		$("#" + id).val(new_span);
		//ninja_forms_style_update_field_pos();
	});

	$("#cols").change(function(){
		var current_cols = $(".ninja-forms-style-sortable").attr("rel");
		var new_cols = this.value;
		new_cols = parseInt(new_cols);
		$(".ninja-forms-style-sortable").removeClass("cols-" + current_cols );
		$(".ninja-forms-style-sortable").addClass("cols-" + new_cols );
		$(".ninja-forms-style-sortable").attr("rel", new_cols );

		$(".ninja-forms-style-sortable li").each(function(){
			if( $(this).attr("rel") > new_cols ){
				var current_span = $(this).attr("rel");
				$(this).removeClass("span-" + current_span);
				$(this).addClass("span-" + new_cols );
				$(this).attr("rel", new_cols );
				var id = $(this).prop("id").replace("_li", "_colspan" );
				$("#" + id).val(new_cols);
			}
		});
		$("#col_fields").prop("innerHTML", "");
		for (var i = new_cols; i >= 1; i--) {
			var html = '<input type="hidden" name="col_' + i + '" id="col_' + i + '" value="">';
			$("#col_fields").append(html);
		}
		//ninja_forms_style_update_field_pos();

	});

	$(".style-mp-page").live("click", function(e){
		e.preventDefault();
		var page_number = this.title;
		var new_page = jQuery("#ninja_forms_style_mp_" + page_number).position().left;
		if(jQuery("#ninja-forms-slide").position().left != -new_page ){
			jQuery("#ninja-forms-slide").animate({left: -new_page},"300" );
			$(".style-mp-page").removeClass("active");
			$(this).addClass("active");
			$("#mp_page").val(page_number);		
		}
	});

	$(".style-mp-add").droppable({
        accept: ".ninja-forms-style-sortable li",
        hoverClass: "drop-hover",
        tolerance: "pointer",
		drop: function( event, ui ) {
			var type = "_page_divider";
			var form_id = $("#_form_id").val();
			$(".spinner").show();
			
			$.post( ajaxurl, { type: type, form_id: form_id, action:"ninja_forms_new_field"}, function(response){
				ninja_forms_style_mp_add( response ) 
				var page = jQuery(".style-mp-page").length;
				ui.draggable.hide( "slow", function() {
					var cols = $("#cols_" + page).val();

					$( this ).appendTo( "#ninja_forms_style_list_" + page );
					$( this ).attr("style", "")
					if( $( this ).attr("rel") > cols ){
						$( this ).removeClass("span-" + $( this ).attr("rel") );
						$( this ).addClass("span-" + cols );
						$( this ).attr("rel", cols);
						var id = $(this).prop("id").replace("_li", "_colspan" );
						$("#" + id).val(cols);
					}
					$( this ).show( "slow" );
					var new_page = jQuery("#ninja_forms_style_mp_" + page).position().left;
					if(jQuery("#ninja-forms-slide").position().left != -new_page ){
						jQuery("#ninja-forms-slide").animate({left: -new_page},"300" );
						$(".style-mp-page").removeClass("active");
						$("#ninja_forms_style_mp_page_" + page).addClass("active");
						$("#mp_page").val(page);
					}
					$(".spinner").hide();
					//ninja_forms_mp_change_page( page_number );   
	            });


			});
		}
    });

    $(".style-mp-add").click(function(){
    	var type = "_page_divider";
		var form_id = $("#_form_id").val();
		$(".spinner").show();
		
		$.post( ajaxurl, { type: type, form_id: form_id, action:"ninja_forms_new_field"}, ninja_forms_style_mp_add( response ) );
    });

    function ninja_forms_style_mp_add( response ){
    	var last_page = jQuery(".style-mp-page").length;
		var new_page = last_page + 1;
		
		var html = '<li class="style-mp-page" title="' + new_page + '" id="ninja_forms_style_mp_page_' + new_page + '">' + new_page + '</li>';
		$("#style-mp-page-list").append(html);

		var html = '<div id="ninja_forms_style_mp_' + new_page +'" class="style-layout"><div>Columns: <select name="cols_' + new_page + '" id="cols_' + new_page + '" class="ninja-forms-style-col"><option value="1" selected>1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></div><input type="hidden" name="order_' + new_page + '" id="order_' + new_page + '" value="" class="field-order"><div id="col_fields_' + new_page + '"></div><ul class="sortable ninja-forms-style-sortable cols-1" rel="1" id="ninja_forms_style_list_' + new_page + '"><li class="ui-disabled" style="display: none;" id="ninja_forms_field_' + response.new_id + '_li"></li></ul>';
		$("#ninja-forms-slide").append(html);

		$( ".ninja-forms-style-sortable" ).sortable({
			items: "li:not(.ui-state-disabled)",
			tolerance: "intersect",
			cursor: "move",
			placeholder: "ninja-forms-style-placeholder",
			forcePlaceholderSize: true,
			opacity: 0.4,
			handle: ".style-handle",

			connectWith: ".ninja-forms-style-sortable",
		  start: function(e,ui){
	            ui.placeholder.height(ui.item.height());
	            ui.placeholder.width(ui.item.width());
	        }
		});

		$(".style-mp-page").droppable({
	        accept: ".ninja-forms-style-sortable li",
	        hoverClass: "drop-hover",
	        tolerance: "pointer",
			drop: function( event, ui ) {
				$(".spinner").show();
				var page = this.title;

				ui.draggable.hide( "slow", function() {
					var cols = $("#cols_" + page).val();

					$( this ).appendTo( "#ninja_forms_style_list_" + page );
					$( this ).attr("style", "")
					if( $( this ).attr("rel") > cols ){
						$( this ).removeClass("span-" + $( this ).attr("rel") );
						$( this ).addClass("span-" + cols );
						$( this ).attr("rel", cols);
						var id = $(this).prop("id").replace("_li", "_colspan" );
						$("#" + id).val(cols);
					}
					$( this ).show( "slow" );
					$(".spinner").hide();
					//ninja_forms_mp_change_page( page_number );   
	            });
			}
	    });

		$(".spinner").hide();
    }

	$(".style-mp-subtract").click(function(){
    	var answer = confirm("Really delete this page? All fields will be removed.");
    	if(answer){
			var form_id = $("#_form_id").val();
	    	var current_page = $(".style-mp-page.active").attr("title");
	    	var page_count = $(".style-mp-page").length;

	    	//if(page_count > 1){
	    		//$("#ninja_forms_field_list_" + current_page).find(".page-divider").removeClass("not-sortable");
	    	//}

	    	var fields = $("#ninja_forms_style_list_" + current_page).sortable("toArray");

	    	if(fields != ''){
	    		$(".spinner").show();

				$.post( ajaxurl, { form_id: form_id, fields: fields, action:"ninja_forms_mp_delete_page"}, function(response){

					if(page_count == 1){
						for (var i = fields.length - 1; i >= 0; i--) {
							$("#" + fields[i] ).remove();
						};
					}else{
						if(current_page > 1){
				    		move_to_page = current_page - 1;
				    	}else{
				    		move_to_page = 1;
				    	}

						

				    	$("#ninja_forms_style_list_" + current_page).remove();
				    	$("#ninja_forms_style_mp_page_" + current_page).remove();
				    	$("#ninja_forms_style_mp_" + current_page).remove();

				    	var i = 1;
				    	$(".style-mp-page").each(function(){
				    		$(this).prop("id", "ninja_forms_style_mp_page_" + i);
				    		$(this).prop("innerHTML", i);
				    		$(this).attr("title", i);
				    		i++;
				    	});

				    	var i = 1;
				    	$(".ninja-forms-style-sortable").each(function(){
				    		$(this).prop("id", "ninja_forms_style_list_" + i);
				    		i++;
				    	});

				    	var i = 1;
				    	$(".style-layout").each(function(){
				    		$(this).prop("id", "ninja_forms_style_mp_" + i);
				    		i++;
				    	});

				    	if( move_to_page != 1 ){
				    		var new_page = jQuery("#ninja_forms_style_mp_" + move_to_page).position().left;
							if(jQuery("#ninja-forms-slide").position().left != -new_page ){
								jQuery("#ninja-forms-slide").animate({left: -new_page},"300" );
								
							}
				    	}

		    			$(".style-mp-page").removeClass("active");
						$("#ninja_forms_style_mp_page_" + move_to_page).addClass("active");
						$("#mp_page").val(move_to_page);	

						$(".spinner").hide();
				    	

				    	//ninja_forms_mp_change_page(move_to_page, ninja_forms_mp_hide_spinner);
					}
			    });
			}
		}
    });


	$(".ninja-forms-style-col").change(function(){
		var page = this.id.replace("cols_", "");
		var new_cols = this.value;
		var current_cols = $("#ninja_forms_style_list_" + page).attr("rel");
		$("#ninja_forms_style_list_" + page).removeClass("cols-" + current_cols );
		$("#ninja_forms_style_list_" + page).addClass("cols-" + new_cols );
		$("#ninja_forms_style_list_" + page).attr("rel", new_cols );

		$("#ninja_forms_style_list_" + page + " li").each(function(){
			if( $(this).attr("rel") > new_cols ){
				var current_span = $(this).attr("rel");
				$(this).removeClass("span-" + current_span);
				$(this).addClass("span-" + new_cols );
				$(this).attr("rel", new_cols );
				var id = $(this).prop("id").replace("_li", "_colspan" );
				$("#" + id).val(new_cols);
			}
		});

		ninja_forms_style_mp_update_field_pos(page);
	});

	$(".style-mp-page").droppable({
        accept: ".ninja-forms-style-sortable li",
        hoverClass: "drop-hover",
        tolerance: "pointer",
		drop: function( event, ui ) {
			$(".spinner").show();
			var page = this.title;

			ui.draggable.hide( "slow", function() {
				var cols = $("#cols_" + page).val();

				$( this ).appendTo( "#ninja_forms_style_list_" + page );
				$( this ).attr("style", "")
				if( $( this ).attr("rel") > cols ){
					$( this ).removeClass("span-" + $( this ).attr("rel") );
					$( this ).addClass("span-" + cols );
					$( this ).attr("rel", cols);
					var id = $(this).prop("id").replace("_li", "_colspan" );
					$("#" + id).val(cols);
				}
				$( this ).show( "slow" );
				$(".spinner").hide();
				//ninja_forms_mp_change_page( page_number );   
            });
		}
    });

	function ninja_forms_style_mp_update_field_pos(page){
		var col_1 = "";
		var col_2 = "";
		var col_3 = "";
		var col_4 = "";		

		var add_px = ( page - 1 ) * 450;

		var col_count = $("#cols_" + page).val();

		$("#col_fields_" + page).prop("innerHTML", "");
		
		for (var i = col_count; i >= 1; i--) {
			var html = '<input type="hidden" name="col_' + i + '_' + page + '" id="col_' + i + '_' + page + '" value="">';
			$("#col_fields_" + page).append(html);
		}
	
		$("#ninja_forms_style_list_" + page + " li").each(function(){
			var pos = $(this).position();
			var field_id = this.id.replace("ninja_forms_field_", "");
			field_id = field_id.replace("_li", "");
			var left = pos.left;
			left = parseInt(left);
			col_1_left = 0 + add_px;
			col_2_left = 125 + add_px;
			col_3_left = 225 + add_px;

			if( left <= col_1_left || left == 0 ){
				if( col_1 == "" ){
					col_1 = field_id;
				}else{
					col_1 = col_1 + "," + field_id;
				}
			}
			if( left > col_1_left && left < col_2_left ){
				if( col_2 == "" ){
					col_2 = field_id;
				}else{
					col_2 = col_2 + "," + field_id;
				}
			}			
			if( left > col_2_left && left < col_3_left ){
				if( col_3 == "" ){
					col_3 = field_id;
				}else{
					col_3 = col_3 + "," + field_id;
				}
			}
			if( left > col_3_left ){
				if( col_4 == "" ){
					col_4 = field_id;
				}else{
					col_4 = col_4 + "," + field_id;
				}
			}
		});

		$("#col_1_" + page).val(col_1);
		$("#col_2_" + page).val(col_2);
		$("#col_3_" + page).val(col_3);
		$("#col_4_" + page).val(col_4);

		var order = $("#ninja_forms_style_list_" + page).sortable("toArray");
		$("#order_" + page).val(order);

	}

	function ninja_forms_style_update_field_pos(){
		var col_1 = "";
		var col_2 = "";
		var col_3 = "";
		var col_4 = "";		

		$(".ninja-forms-style-sortable li").each(function(){
			var pos = $(this).position();
			var field_id = this.id.replace("ninja_forms_field_", "");
			field_id = field_id.replace("_li", "");
			var left = pos.left;
			left = parseInt(left);

			if( left == 0 ){
				if( col_1 == "" ){
					col_1 = field_id;
				}else{
					col_1 = col_1 + "," + field_id;
				}
			}
			if( left > 0 && left < 150 ){
				if( col_2 == "" ){
					col_2 = field_id;
				}else{
					col_2 = col_2 + "," + field_id;
				}
			}			
			if( left > 150 && left < 250 ){
				if( col_3 == "" ){
					col_3 = field_id;
				}else{
					col_3 = col_3 + "," + field_id;
				}
			}
			if( left > 250 ){
				if( col_4 == "" ){
					col_4 = field_id;
				}else{
					col_4 = col_4 + "," + field_id;
				}
			}
		});

		$("#col_1").val(col_1);
		$("#col_2").val(col_2);
		$("#col_3").val(col_3);
		$("#col_4").val(col_4);

		var order = $(".ninja-forms-style-sortable").sortable("toArray");
		//alert( order );
		$("#order").val(order);

	}
});

function reloadWithQueryStringVars (queryStringVars) {
    var existingQueryVars = location.search ? location.search.substring(1).split("&") : [],
        currentUrl = location.search ? location.href.replace(location.search,"") : location.href,
        newQueryVars = {},
        newUrl = currentUrl + "?";
    if(existingQueryVars.length > 0) {
        for (var i = 0; i < existingQueryVars.length; i++) {
            var pair = existingQueryVars[i].split("=");
            newQueryVars[pair[0]] = pair[1];
        }
    }
    if(queryStringVars) {
        for (var queryStringVar in queryStringVars) {
            newQueryVars[queryStringVar] = queryStringVars[queryStringVar];
        }
    }
    if(newQueryVars) { 
        for (var newQueryVar in newQueryVars) {
            newUrl += newQueryVar + "=" + newQueryVars[newQueryVar] + "&";
        }
        newUrl = newUrl.substring(0, newUrl.length-1);
        window.location.href = newUrl;
    } else {
        window.location.href = location.href;
    }
}