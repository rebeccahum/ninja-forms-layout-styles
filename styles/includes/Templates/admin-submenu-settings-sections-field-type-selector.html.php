<div>
    <label for="">
        Choose Field Type to Style
    </label>
    <select name="" id="ninja-forms-styles-field-type-selector">
        <option value=""><?php echo __( 'Select a Field Type', 'ninja-forms-styles' ); ?></option>
        <?php foreach( Ninja_Forms()->fields as $field ): ?>
            <option value="<?php echo $field->get_name(); ?>"><?php echo $field->get_nicename(); ?></option>
        <?php endforeach; ?>
    </select>
</div>