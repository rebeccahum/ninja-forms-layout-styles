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

        $tab = ( isset( $_GET[ 'tab' ] ) ) ? self::sanitize_text_field( $_GET[ 'tab' ] ) : 'form_settings';
        $groups = NF_Styles::config( 'PluginSettingGroups' );

        if( 'field_type' == $tab ) {

            if( isset( $_GET[ 'field_type' ] ) ) {

                $field_type = self::sanitize_text_field($_GET['field_type']);

                if (isset(Ninja_Forms()->fields[ $field_type ])) {

                    $field = Ninja_Forms()->fields[ $field_type ];

                    $sections = array('wrap' => __('Wrap'), 'label' => __('Label'), 'element' => __('Element'));

                    if ('html' == $field->get_name()) {
                        unset($sections['label']);
                    }

                    if ('hr' == $field->get_name()) {
                        unset($sections['wrap']);
                        unset($sections['label']);
                    }

                    foreach ($sections as $section => $label) {

                        $name = $field->get_name() . "_$section";

                        $groups['field_type']['sections'][$name] = array(
                            'name' => $name,
                            'field' => $field->get_name(),
                            'label' => $field->get_nicename() . ' ' . $label
                        );
                    }
                }
            }
        }

        $sections = $groups[ $tab ][ 'sections' ];
        $plugin_settings = Ninja_Forms()->get_setting( 'style' );

        foreach( $sections as $section_id => $section ){
            $settings = NF_Styles::config( 'CommonSettings' );
            unset( $settings[ 'show_advanced_css' ] );

            foreach( $settings as $name => $setting ){
                $settings[ $name ][ 'section' ] = $section_id;
            }

            $sections[ $section_id ][ 'settings' ] = $settings;
        }
        
        $view = new NF_Styles_Admin_Views_PluginSettings( compact( 'tab', 'groups', 'sections' ) );

        NF_Styles::template( 'PluginSettings/index.html.php', compact( 'view' ) );
    }

    public function update()
    {
        $data = self::sanitize_text_field( $_POST[ 'style' ] );
        $group = self::sanitize_text_field( $_GET[ 'tab' ] );

        $settings = Ninja_Forms()->get_setting( 'style' );

        $settings[ $group ] = $data[ $group ];

        Ninja_Forms()->update_setting( 'style', $settings );
    }

    public static function sanitize_text_field( $data )
    {
        if( is_array( $data ) ){
            return array_map( array( 'self', 'sanitize_text_field' ), $data );
        }
        return sanitize_text_field( $data );
    }

}