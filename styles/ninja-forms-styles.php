<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Styles
 */
final class NF_Styles
{
    const VERSION = '3.0.0';
    const SLUG    = 'styles';
    const NAME    = 'Styles';
    const AUTHOR  = 'WP Ninjas';
    const PREFIX  = 'NF_Styles';

    /**
     * @var NF_Layouts
     * @since 3.0
     */
    private static $instance;

    /**
     * Plugin Directory
     *
     * @since 3.0
     * @var string $dir
     */
    public static $dir = '';

    /**
     * Plugin URL
     *
     * @since 3.0
     * @var string $url
     */
    public static $url = '';

    /**
     * NF_Layouts constructor.
     */
    public function __construct()
    {
        add_action( 'ninja_forms_loaded', array( $this, 'ninja_forms_loaded' ) );

        add_action( 'ninja_forms_before_container', array( $this, 'localize_plugin_styles' ), 10, 3 );
        add_action( 'ninja_forms_before_container_preview', array( $this, 'localize_plugin_styles' ), 10, 3 );

        add_action( 'ninja_forms_before_container', array( $this, 'localize_form_styles' ), 10, 3 );
        add_action( 'ninja_forms_before_container_preview', array( $this, 'localize_form_styles' ), 10, 3 );

        add_action( 'ninja_forms_before_container', array( $this, 'localize_field_styles' ), 10, 3 );
        add_action( 'ninja_forms_before_container_preview', array( $this, 'localize_field_styles' ), 10, 3 );

        add_filter( 'ninja_forms_from_settings_types', array( $this, 'add_form_settings_groups' ) );
        add_filter( 'ninja_forms_localize_form_styles_settings', array( $this, 'add_form_settings' ) );

        add_filter( 'ninja_forms_field_settings_groups', array( $this, 'add_field_settings_groups' ) );
        add_filter( 'ninja_forms_field_load_settings', array( $this, 'add_field_settings' ), 10, 3 );
    }

    public function ninja_forms_loaded()
    {
        new NF_Styles_Admin_Submenu();
    }

    public function add_form_settings_groups( $groups )
    {
        $new_groups = self::config( 'FormSettingsGroups' );
        $groups = array_merge( $groups, $new_groups );
        return $groups;
    }

    public function add_form_settings( $settings )
    {
        $form_settings = self::config( 'FormSettings' );

        foreach( $form_settings as $name => $form_setting ){
            $form_setting[ 'group' ] = 'primary';

            foreach( self::config( 'CommonSettings' ) as $common_setting ){

                $common_setting[ 'name' ] = $name . '_' . $common_setting[ 'name' ];

                if ( isset ( $common_setting[ 'deps' ] ) ) {
                    foreach( $common_setting[ 'deps' ] as $dep_name => $val ) {
                        $common_setting[ 'deps' ][ $name . '_' . $dep_name ] = $val;
                        unset( $common_setting[ 'deps' ][ $dep_name ] );
                    }
                }

                $form_setting[ 'settings' ][] = $common_setting;
            }

            $form_settings[ $name ] = $form_setting;
        }

        $settings = array_merge( $settings, $form_settings );
        return $settings;
    }

    public function add_field_settings_groups( $groups )
    {
        return $groups = array_merge( $groups, self::config( 'FieldSettingsGroups' ) );
    }

    public function add_field_settings( $settings, $field_type, $field_parent_type )
    {
        $style_settings = self::config( 'FieldSettings' );

        if( 'list' == $field_parent_type ){
            $style_settings = array_merge( $style_settings, self::config( 'ListFieldSettings' ) );
        }

        foreach( $style_settings as $name => $style_setting ){

            $style_setting[ 'group' ] = 'styles';

            foreach( self::config( 'CommonSettings' ) as $common_setting ){

                $common_setting[ 'name' ] = $name . '_' . $common_setting[ 'name' ];

                if ( isset ( $common_setting[ 'deps' ] ) ) {
                    foreach( $common_setting[ 'deps' ] as $dep_name => $val ) {
                        $common_setting[ 'deps' ][ $name . '_' . $dep_name ] = $val;
                        unset( $common_setting[ 'deps' ][ $dep_name ] );
                    }
                }

                $style_setting[ 'settings' ][] = $common_setting;
            }

            $settings[ $name ] = $style_setting;
        }

        return $settings;
    }

    public function localize_plugin_styles( $form_id, $settings, $fields )
    {
        $style_settings = Ninja_Forms()->get_setting( 'style' );
        $settings_groups = self::config( 'PluginSettingGroups' );

        $styles = array();
        foreach( $settings_groups as $setting_group ){

            if( ! isset( $setting_group[ 'sections' ] ) || ! $setting_group[ 'sections' ] ) continue;

            $group_name = $setting_group[ 'name' ];

            if( ! isset( $style_settings[ $group_name ] ) || ! $style_settings[ $group_name ] ) continue;

            foreach( $setting_group[ 'sections' ] as $section ){

                if( ! isset( $section[ 'selector' ] ) || ! $section[ 'selector' ] ) continue;

                $section_name = $section[ 'name' ];

                $selector = $section[ 'selector' ];

                foreach( $style_settings[ $group_name ][ $section_name ] as $element => $style ){

                    if( ! $style ) continue;

                    $styles[ $selector ][ $element ] = $style;

                }
            }
        }

        $this->localize_styles( $styles, 'Plugin Wide Styles' );
    }

    public function localize_form_styles( $form_id, $settings, $fields )
    {
        $form_settings_groups = self::config( 'FormSettings' );
        $common_settings = self::config( 'CommonSettings' );

        $styles = array();
        foreach( $form_settings_groups as $form_settings_group ){

            if( ! isset( $form_settings_group[ 'selector' ] ) ) continue;

            $selector = str_replace( '{ID}', $form_id, $form_settings_group[ 'selector' ] );

            foreach( $common_settings as $common_setting ){

                $setting = $form_settings_group[ 'name' ] . '_' . $common_setting[ 'name' ];
                if( ! isset( $settings[ $setting ] ) || ! $settings[ $setting ] ) continue;

                $rule = $common_setting[ 'name' ];

                $styles[ $selector ][ $rule ] = $settings[ $setting ];
            }
        }
        
        // $styles[ $selector ][ $element ] = $style;
        $this->localize_styles( $styles, 'Form Styles' );
    }

    public function localize_field_styles( $form_id, $settings, $fields )
    {
        $styles = array();

        $this->localize_styles( $styles, 'Field Styles' );
    }

    private function localize_styles( $styles, $title = '' )
    {
        self::template( 'display-form-styles.css.php', compact( 'styles', 'title' ) );
    }


    /**
     * Main Plugin Instance
     *
     * Insures that only one instance of a plugin class exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     *
     * @since 3.0
     * @static
     * @static var array $instance
     * @return NF_Layouts Highlander Instance
     */
    public static function instance()
    {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof NF_Styles ) ) {
            self::$instance = new NF_Styles();
            self::$dir = plugin_dir_path(__FILE__);
            self::$url = plugin_dir_url(__FILE__);
            spl_autoload_register( array( self::$instance, 'autoloader' ) );
        }
        return self::$instance;
    }

    /**
     * Autoloader
     *
     * @param $class_name
     */
    public function autoloader( $class_name )
    {
        if (class_exists($class_name)) return;

        if ( false === strpos( $class_name, self::PREFIX ) ) return;

        $class_name = str_replace( self::PREFIX, '', $class_name );
        $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
        $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';

        if (file_exists($classes_dir . $class_file)) {
            require_once $classes_dir . $class_file;
        }
    }

    /**
     * Template
     *
     * @param string $file_name
     * @param array $data
     */
    public static function template( $file_name = '', array $data = array() )
    {
        if( ! $file_name ) return;

        extract( $data );

        include self::$dir . 'includes/Templates/' . $file_name;
    }

    /**
     * Config
     *
     * @param $file_name
     * @return mixed
     */
    public static function config( $file_name )
    {
        return include self::$dir . 'includes/Config/' . $file_name . '.php';
    }

    /**
     * License Setup
     */
    public function setup_license()
    {
        if ( ! class_exists( 'NF_Extension_Updater' ) ) return;

        new NF_Extension_Updater( self::NAME, self::VERSION, self::AUTHOR, __FILE__, self::SLUG );
    }
}

/**
 * The main function responsible for returning The Highlander Plugin
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @since 3.0
 * @return NF_Styles Highlander Instance
 */
function NF_Styles()
{
    return NF_Styles::instance();
}

NF_Styles();
