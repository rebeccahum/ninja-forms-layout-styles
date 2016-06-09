<style>

    <?php if( $title ): ?>
    /* <?php echo strtoupper( $title ); ?> */
    <?php endif; ?>

    <?php foreach( $styles as $selector => $rules ): ?>
    <?php echo $selector; ?> {
        <?php foreach( $rules as $rule => $value ): ?>
        <?php echo apply_filters( 'ninja_forms_styles_output_rule_' . $rule, $rule ); ?>:<?php echo $value; ?>;
        <?php endforeach; ?>
    }
    <?php endforeach; ?>
</style>