<?php if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'NF_Abstracts_Submenu' ) ) return;

final class NF_Styles_Admin_Submenu extends NF_Abstracts_Submenu
{
    public $parent_slug = 'ninja-forms';

    public $page_title = 'Styling';

    public $priority = 11.5;

    public function __construct()
    {
        parent::__construct();

        if( isset( $_POST[ 'update_ninja_forms_style_settings' ] ) ){
            $this->update();
        }
    }

    public function display()
    {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'ninja_forms_styles_admin_css', NF_Styles::$url . 'assets/css/admin.css', array(), false );
        wp_enqueue_script( 'ninja_forms_styles_admin_js', NF_Styles::$url . 'assets/js/admin.js', array( 'wp-color-picker' ), false, true );

        wp_enqueue_style( 'codemirror', Ninja_Forms::$url . 'assets/css/codemirror.css' );
        wp_enqueue_script( 'codemirror', Ninja_Forms::$url . 'assets/js/lib/codemirror.min.js' );


        $groups = NF_Styles::config( 'PluginSettingGroups' );
        $settings = NF_Styles::config( 'CommonSettings' );
        $tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : 'form';
        $plugin_settings = Ninja_Forms()->get_setting( 'style' );

        unset( $settings[ 'show_advanced_css' ] );

        $groups[ 'field_type' ][ 'sections' ] = array();
        foreach( Ninja_Forms()->fields as $field ){
            $groups[ 'field_type' ][ 'sections' ][ $field->get_name() ] = array(
                'name' => $field->get_name(),
                'label' => $field->get_nicename()
            );
        }

        NF_Styles::template( 'admin-submenu-settings.html.php', compact( 'groups', 'settings', 'tab', 'plugin_settings' ) );
    }

    public function update()
    {
        $data = $_POST[ 'style' ];
        $data = self::sanitize_text_field( $data );
        Ninja_Forms()->update_setting( 'style', $data );
    }

    public static function sanitize_text_field( $data )
    {
        if( is_array( $data ) ){
            return array_map( array( 'self', 'sanitize_text_field' ), $data );
        }
        return sanitize_text_field( $data );
    }

}