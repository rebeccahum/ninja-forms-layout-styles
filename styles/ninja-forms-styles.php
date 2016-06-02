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
        add_filter( 'ninja_forms_field_settings_groups', array( $this, 'add_field_settings_group' ) );
        add_filter( 'ninja_forms_field_load_settings', array( $this, 'add_field_settings' ) );
    }

    public function ninja_forms_loaded()
    {
        new NF_Styles_Admin_Submenu();
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

    public function add_field_settings_group( $groups )
    {
        return $groups = array_merge( $groups, self::config( 'FieldSettingGroups' ) );
    }

    public function add_field_settings( $settings )
    {
        $style_settings = self::config( 'FieldSettings' );

        foreach( $style_settings as $name => $style_setting ){

            $style_setting[ 'group' ] = 'styles';
            $style_setting[ 'settings' ] = self::config( 'CommonSettings' );

            $settings[ $name ] = $style_setting;
        }

        return $settings;
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
