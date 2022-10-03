<?php

namespace IWCT;

/**
 * Bootstraper Class
 *
 * @class IWCT_Bootstrap
 * @version 1.0.0
 */
final class IWCTBootstrap
{
    /**
     * Version.
     *
     * @var string
     */
    public $version = '0.0.1';

    /**
     * The single instance of the class.
     *
     * @var IWCTBootstrap
     * @since 1.0.0
     */
    protected static $instance = null;

    /**
     * Ensures only one instance of Theme is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return IWCTBootstrap - Main instance.
     */
    public static function instance()
    {
        // Get an instance of Class.
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        // Return the instance.
        return self::$instance;
    }

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone()
    {
        _doing_it_wrong(__FUNCTION__, esc_html__('Cheating huh?', 'my-theme'), '1.0.0');
    }

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup()
    {
        _doing_it_wrong(__FUNCTION__, esc_html__('Cheating huh?', 'my-theme'), '1.0.0');
    }

    /**
     * Constructor
     */
    protected function __construct()
    {
        // Define Constants.
        $this->defineConstants();

        // Auto Loader.
        spl_autoload_register([$this, 'autoload']);

        // Initialize the Theme.
        $this->init();

        // Include Helper Functions.
        $this->helpers();
    }

    /**
     * Define Theme Constants.
     */
    private function defineConstants()
    {
        // Theme Version.
        if (!defined('IWCT_VERSION')) {
            define('IWCT_VERSION', $this->version);
        }
    }

    /**
     * Initialize the Theme
     */
    private function init()
    {
        // I18n.
        (new IWCTI18n())->init();

        // Theme.
        (new IWCTTheme())->init();

        // Assets.
        (new IWCTAssets())->init();

        // Course.
        (new IWCTCourse())->init();
    }

    /**
     * Include Helper Functions
     */
    public function helpers()
    {
        // Util Functions.
        require_once get_template_directory() . '/includes/helpers/util.php';
    }

    /**
     * Automatically load theme classes whenever needed.
     *
     * @param string $class_name class name.
     * @return void
     */
    private function autoload($class_name)
    {
        $class_name = str_replace('IWCT\IWCT', '', $class_name);
        $class_name = strtolower($class_name);
        $file_path = get_template_directory() . '/includes/' . $class_name . '.php';
        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }
}
