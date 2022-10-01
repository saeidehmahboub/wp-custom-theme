<?php
// no direct access
defined('ABSPATH') or die();

if(!class_exists('IWCT_Bootstrap')):

/**
 * Bootstraper Class
 *
 * @class IWCT_Bootstrap
 * @version	1.0.0
 */
final class IWCT_Bootstrap
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
     * @var IWCT_Bootstrap
     * @since 1.0.0
     */
    protected static $instance = null;

    /**
     * Ensures only one instance of Theme is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return IWCT_Bootstrap - Main instance.
     */
    public static function instance()
    {
        // Get an instance of Class
        if(is_null(self::$instance)) self::$instance = new self();

        // Return the instance
        return self::$instance;
    }

    /**
     * Cloning is forbidden.
     * @since 1.0.0
     */
    public function __clone()
    {
        _doing_it_wrong(__FUNCTION__, esc_html__('Cheating huh?', 'iwct'), '1.0.0');
    }

    /**
     * Unserializing instances of this class is forbidden.
     * @since 1.0.0
     */
    public function __wakeup()
    {
        _doing_it_wrong(__FUNCTION__, esc_html__('Cheating huh?', 'iwct'), '1.0.0');
    }

    /**
     * Constructor
     */
    protected function __construct()
    {
        // Define Constants
        $this->define_constants();

        // Auto Loader
        spl_autoload_register([$this, 'autoload']);

        // Initialize the Theme
        $this->init();

        // Include Helper Functions
        $this->helpers();
    }

    /**
     * Define Theme Constants.
     */
    private function define_constants()
    {
        // Theme Version
        if(!defined('IWCT_VERSION')) define('IWCT_VERSION', $this->version);
    }

    /**
     * Initialize the Theme
     */
    private function init()
    {
        // I18n
        (new IWCT_I18n())->init();

        // Assets
        (new IWCT_Assets())->init();
    }

    /**
     * Include Helper Functions
     */
    public function helpers()
    {
        // Util Functions
        require_once get_template_directory().'/includes/helpers/util.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Automatically load theme classes whenever needed.
     * @param string $class_name
     * @return void
     */
    private function autoload($class_name)
    {
        $class_ex = explode('_', strtolower($class_name));

        // It's not a IWCT Class
        if($class_ex[0] != 'iwct') return;

        // Drop 'IWCT'
        $class_path = array_slice($class_ex, 1);

        // Create Class File Path
        $file_path = get_template_directory() . '/includes/' . implode('/', $class_path) . '.php';

        // We found the class!
        if(file_exists($file_path)) require_once $file_path; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }
}

endif;