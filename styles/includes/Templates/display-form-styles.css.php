<style>

    <?php if( $title ): ?>
    /* <?php echo strtoupper( $title ); ?> */
    <?php endif; ?>

    <?php foreach( $styles as $selector => $rules ): ?>
    <?php echo $selector; ?> {
        <?php foreach( $rules as $rule => $value ): ?>
        <?php echo $rule; ?>:<?php echo $value; ?>;
        <?php endforeach; ?>
    }
    <?php endforeach; ?>
</style>