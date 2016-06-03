<div class="wrap">

    <h1><?php _e( 'Style Settings', 'ninja-forms-styles' ); ?></h1>

    <h2 class="nav-tab-wrapper">
        <?php NF_Styles::template( 'admin-submenu-settings-tabs.html.php', compact( 'groups', 'tab' ) ); ?>
    </h2>

    <div id="poststuff">
        <form action="" method="POST">

            <?php if( 'field_type' == $tab ) NF_Styles::template( 'admin-submenu-settings-sections-field-type-selector.html.php', compact( 'groups', 'settings', 'tab', 'plugin_settings' ) ); ?>

            <?php NF_Styles::template( 'admin-submenu-settings-sections.html.php', compact( 'groups', 'settings', 'tab', 'plugin_settings' ) ); ?>

            <p>
                <label>
                    <input type="checkbox" name="advanced" id="advanced_css" value="1" checked="checked"> Show Advanced CSS Properties
                </label>
            </p>

            <input type="hidden" name="update_ninja_forms_style_settings">
            <input type="submit" class="button button-primary" value="Save Settings">

        </form>
    </div>

</div>
