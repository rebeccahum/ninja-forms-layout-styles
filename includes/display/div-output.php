<?php

function ninja_forms_style_ul_open( $field_id, $data ){
	global $ninja_forms_style_row_col, $ninja_forms_processing;

	$form_row = ninja_forms_get_form_by_field_id( $field_id );
	$form_id = $form_row['id'];
	$form_data = $form_row['data'];
	if( isset( $form_data['ajax'] ) ){
		$ajax = $form_data['ajax'];
	}else{
		$ajax = 0;
	}

	if( isset( $form_data['multi_part'] ) AND $form_data['multi_part'] == 1 AND function_exists( 'ninja_forms_mp_get_pages' ) ){

		$pages = ninja_forms_mp_get_pages( $form_id );
		foreach( $pages as $page => $fields ){
			foreach( $fields as $field ){
				if( $field['id'] == $field_id ){
					$current_page = $page;
					break 2;
				}
			}
		}

		if( isset( $form_data['style']['mp'][$current_page]['cols'] ) ){
			$cols = $form_data['style']['mp'][$current_page]['cols'];
		}else{
			$cols = 1;
		}
	}else{
		if( isset( $form_data['style']['cols'] ) ){
			$cols = $form_data['style']['cols'];
		}else{
			$cols = 1;
		}
	}

	$field_row = ninja_forms_get_field_by_id( $field_id );
	$field_data = $field_row['data'];
	if( isset( $field_data['style']['colspan'] ) ){
		$colspan = $field_data['style']['colspan'];
	}else{
		$colspan = 1;
	}

	if( $cols > 1 ){
   		if( !isset( $ninja_forms_style_row_col ) ){
   			$ninja_forms_style_row_col = 0;
   		}
		if( $ninja_forms_style_row_col == 0 ){
			?>
			<div class="ninja-row">
			<?php
		}
		?>
				<div class="ninja-col-<?php echo $colspan;?>-<?php echo $cols;?>">
		
 		<?php
   	}
}

add_action( 'ninja_forms_display_before_field', 'ninja_forms_style_ul_open', 11, 2);

function ninja_forms_style_ul_close( $field_id, $data ){
	global $ninja_forms_style_row_col, $ninja_forms_processing;

	$form_row = ninja_forms_get_form_by_field_id( $field_id );
	$form_id = $form_row['id'];
	$form_data = $form_row['data'];

	if( isset( $form_data['ajax'] ) ){
		$ajax = $form_data['ajax'];
	}else{
		$ajax = 0;
	}

	
	if( isset( $form_data['multi_part'] ) AND $form_data['multi_part'] == 1 AND function_exists( 'ninja_forms_mp_get_pages' ) ){

		$pages = ninja_forms_mp_get_pages( $form_id );
		foreach( $pages as $page => $fields ){
			foreach( $fields as $field ){
				if( $field['id'] == $field_id ){
					$current_page = $page;
					break 2;
				}
			}
		}

		if( isset( $form_data['style']['mp'][$current_page]['cols'] ) ){
			$cols = $form_data['style']['mp'][$current_page]['cols'];
		}else{
			$cols = 1;
		}
	}else{
		if( isset( $form_data['style']['cols'] ) ){
			$cols = $form_data['style']['cols'];
		}else{
			$cols = 1;
		}
	}

	$field_row = ninja_forms_get_field_by_id( $field_id );
	$field_data = $field_row['data'];
	if( isset( $field_data['style']['colspan'] ) ){
		$colspan = $field_data['style']['colspan'];
	}else{
		$colspan = 1;
	}

	if( $cols > 1 ){
		?>
		</div>
		<?php
		$ninja_forms_style_row_col = $ninja_forms_style_row_col + $colspan;
		if( ( $ninja_forms_style_row_col ) >= $cols ){
			?>
			</div>
			<?php
			$ninja_forms_style_row_col = 0;
		}
	}
}

add_action( 'ninja_forms_display_after_field', 'ninja_forms_style_ul_close', 9, 2 );