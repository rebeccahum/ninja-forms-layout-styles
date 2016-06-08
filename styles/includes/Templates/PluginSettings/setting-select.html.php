<select name='<?php echo $view->get_field_name( $data ); ?>' id='<?php echo $view->get_field_id( $data ); ?>'>
<?php foreach( $data['options'] as $option ): ?>
    <option value='<?php echo $option[ 'label' ]; ?>' <?php echo ( $view->get_field_value( $data ) == $option['value'] ) ? 'selected="selected"' : ''; ?>>
        <?php echo $option[ 'label' ]; ?>
    </option>
<?php endforeach; ?>
</select>