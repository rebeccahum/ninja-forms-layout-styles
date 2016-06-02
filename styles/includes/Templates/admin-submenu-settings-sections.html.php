<?php if( isset( $groups[ $tab ] ) && isset( $groups[ $tab ][ 'sections' ] ) ): ?>
    <?php foreach( $groups[ $tab ][ 'sections' ] as  $section ): ?>

        <div id="ninja_forms_metabox_general_settings" class="postbox">
            <span class="item-controls">
                <!--<a class="item-edit metabox-item-edit" id="edit_id" title="Edit Menu Item" href="#">Edit Menu Item</a>-->
            </span>
            <h3 class="hndle"><span><?php echo $section[ 'label' ]; ?></span></h3>
            <div class="inside" style="">
                <table class="form-table">

                    <?php NF_Styles::template( 'admin-submenu-settings-settings.html.php', compact( 'groups', 'settings', 'tab' ) ); ?>

                </table>
            </div>
        </div>

    <?php endforeach; ?>
<?php endif; ?>