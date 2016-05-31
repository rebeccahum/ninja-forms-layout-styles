<?php foreach( $groups as $name => $group ): ?>

    <?php if( $tab == $name ): ?>

        <span class="nav-tab nav-tab-active"><?php echo $group[ 'label' ] ?></span>

    <?php else: ?>

        <a href="<?php echo add_query_arg( 'tab', $name );?>" target="" class="nav-tab "><?php echo $group[ 'label' ] ?></a>
        
    <?php endif; ?>

<?php endforeach; ?>

