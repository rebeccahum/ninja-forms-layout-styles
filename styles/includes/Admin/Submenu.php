<?php if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'NF_Abstracts_Submenu' ) ) return;

final class NF_Styles_Admin_Submenu extends NF_Abstracts_Submenu
{
    public $parent_slug = 'ninja-forms';

    public $page_title = 'Styling';

    public $priority = 11.5;

    public function display()
    {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'ninja_forms_styles_admin_js', NF_Styles::$url . 'assets/js/admin.js', array( 'wp-color-picker' ), false, true );

        $groups = NF_Styles::config( 'SettingGroups' );
        $settings = NF_Styles::config( 'CommonSettings' );
        $tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : 'form';
        
        NF_Styles::template( 'admin-submenu-settings.html.php', compact( 'groups', 'settings', 'tab' ) );
    }

}