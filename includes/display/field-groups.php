<?php

function ninja_forms_style_open_field_group( $field_id, $data ) {
	if ( !$class = $data['class'] ) {
		$class = '';
	}
	if ( strstr( $class, 'nf-open-field-group' ) ) {
		$class =  ninja_forms_get_group_wrap_class( $class );
		echo '<div class="' . $class . '">';
	}
}
add_action( 'ninja_forms_display_before_opening_field_wrap', 'ninja_forms_style_open_field_group', 10, 2 );

function ninja_forms_style_close_field_group( $field_id, $data ) {
	if ( !$class = $data['class'] ) {
		$class = '';
	}
	if ( strstr( $class, 'nf-close-field-group' ) ) {
		echo '</div>';
	}
}
add_action( 'ninja_forms_display_after_closing_field_wrap', 'ninja_forms_style_close_field_group', 10, 2 );


function ninja_forms_get_group_wrap_class( $class ) {
	$class = str_replace( '-group', '', $class );
	$class = str_replace( '-open', '', $class );
	$x = 0;
	$custom_class = '';

	if ( isset( $class ) AND !empty( $class ) ) {
		$class_array = explode(" ", $class );
		foreach($class_array as $class){
			$custom_class .= $class;
			if($x != (count($class_array) - 1)){
				$custom_class .= " ";
			}
			$x++;
		}
	}

	if($custom_class != ''){
		$custom_class = str_replace( ' ', '-group ', $custom_class );
		$field_wrap_class .= ' ' . $custom_class . '-group';
	}

	return $field_wrap_class;
}