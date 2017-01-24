<?php if ( ! defined( 'ABSPATH' ) ) exit;

if( class_exists( 'NF_Layouts', false ) ) return;

/**
 * Class NF_Layouts
 */
final class NF_Layouts
{
    const VERSION = '3.0.5';
    const SLUG    = 'layouts';
    const NAME    = 'Layouts';
    const AUTHOR  = 'WP Ninjas';
    const PREFIX  = 'NF_Layouts';

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
        add_action( 'nf_admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        add_action( 'nf_display_enqueue_scripts', array( $this, 'display_scripts' ) );
    }

    public function admin_scripts()
    {
        $ver = self::VERSION;
        wp_enqueue_style(  'nf-layout-builder', plugin_dir_url( __FILE__ ) . 'assets/css/builder.css', array(), $ver );
        wp_enqueue_script( 'nf-layout-builder', plugin_dir_url( __FILE__ ) . 'assets/js/min/builder.js', array( 'nf-builder' ), $ver );
        wp_enqueue_script( 'jquery-split',      plugin_dir_url( __FILE__ ) . 'assets/js/lib/split.js',   array( 'jquery' ),     $ver );
        ?>
        <script id="nf-tmpl-empty-cell" type="text/template">
            <div class="no-fields">
                Add fields, <a href="#" class="delete">delete column</a>, or leave it empty.
            </div>
        </script>

        <?php
        $form_id = absint( $_GET['form_id'] );
        if ( !$form_id ) {
            return false;
        }
        $rows = array();
        $form = Ninja_Forms()->form( $form_id );
        foreach( $form->get_fields() as $field ) {
            $rows[] = array(
                'order' => absint( $field->get_setting( 'order' ) ),
                'cells'	=> array(
                    array(
                        'order' => 0,
                        'fields'	=> array(
                            $field->get_setting( 'key' )
                        ),
                        'width'		=> '100'
                    )
                )
            );
        }
        wp_localize_script( 'nf-layout-builder', 'nfLayouts', array( 'rows' => $rows ) );
    }

    public function display_scripts()
    {
        $ver = self::VERSION;
        wp_enqueue_style(  'nf-layout-front-end', plugin_dir_url( __FILE__ ) . 'assets/css/display-structure.css', array(), $ver );
        wp_enqueue_script( 'nf-layout-front-end', plugin_dir_url( __FILE__ ) . 'assets/js/min/front-end.js', array( 'nf-front-end' ), $ver );
        ?>
        <script id="nf-tmpl-cell" type="text/template">
            <nf-fields></nf-fields>
        </script>

        <script id="nf-tmpl-row" type="text/template">
            <nf-cells></nf-cells>
        </script>

        <?php
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
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof NF_Layouts ) ) {
            self::$instance = new NF_Layouts();
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
