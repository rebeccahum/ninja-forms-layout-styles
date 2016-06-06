<div class="postbox">
            <span class="item-controls">
                <!--<a class="item-edit metabox-item-edit" id="edit_id" title="Edit Menu Item" href="#">Edit Menu Item</a>-->
            </span>
    <h3 class="hndle"><span><?php echo $data[ 'label' ]; ?></span></h3>
    <div class="inside" style="">
        <table class="form-table">

            <?php
                foreach( $data[ 'settings' ] as $setting ) {
                    echo $view->get_part('postbox-content', $setting );
                }
            ?>

        </table>
    </div>
</div>