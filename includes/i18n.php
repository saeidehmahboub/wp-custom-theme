<?php

namespace IWCT;

/**
 * Internationalization Class
 *
 * @class IWCT_I18n
 * @version 1.0.0
 */
class IWCTI18n extends IWCTBase
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function init()
    {
        add_action('after_setup_theme', [$this, 'setup']);
    }

    public function setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /i18n/languages/ directory.
         * If you're building a theme based on IWCT, use a find and replace
         * to change 'iwct' to the name of your theme in all the template files.
         */
        load_theme_textdomain('my-theme', get_template_directory() . '/languages');
    }
}
