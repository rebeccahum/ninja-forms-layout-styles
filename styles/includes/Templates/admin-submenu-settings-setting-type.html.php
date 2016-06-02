<?php

$setting[ 'value' ] = $plugin_settings[ $tab ][ $section[ 'name' ] ][ $setting[ 'name' ] ];

switch ( $setting[ 'type' ] ) {
    case 'html':
        echo $setting[ 'html'];
        break;
    case 'desc' :
        echo $setting[ 'value' ];
        break;
    case 'color' :
        echo '<input type="text" value="' . $setting['value'] . '" class="js-ninja-forms-styles-color-field" data-default-color="#F9F9F9" />';
        break;
    case 'textbox' :
        echo "<input type='text' class='code widefat' name='{$setting['name']}' id='{$setting['name']}' value='{$setting['value']}'>";
        break;
    case 'textarea':
        echo "<textarea class='widefat' name='{$setting['name']}' id='{$setting['name']}' rows='8'>{$setting['value']}</textarea>";
        break;
    case 'checkbox' :
        $checked = ( $setting[ 'value' ] ) ? 'checked' : '';
        echo "<input type='hidden' name='{$setting['name']}' value='0'>";
        echo "<input type='checkbox' name='{$setting['name']}' value='1' id='{$setting['name']}' class='widefat' $checked>";
        break;
    case 'select' :
        echo "<select name='{$setting['name']}' id='{$setting['name']}'>";
        foreach( $setting['options'] as $option ) {
            $selected = ( $setting['value'] == $option['value'] ) ? 'selected="selected"' : '';
            echo "<option value='{$option['value']}' {$selected}>{$option['label']}</option>";
        }
        echo "</select>";
        break;
}
