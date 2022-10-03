<?php

namespace IWCT;

/**
 * Assets Class
 *
 * @class IWCT_Assets
 * @version 1.0.0
 */
class IWCTAssets extends IWCTBase
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'frontend']);
    }

    public function frontend()
    {
        // Font Awesome.
        wp_enqueue_style(
            'fontawesome',
            get_template_directory_uri() . '/assets/packages/fontawesome/css/all.min.css',
            [],
            $this->version()
        );

        // Bootstrap.
        wp_enqueue_style(
            'bootstrap',
            get_template_directory_uri() . '/assets/packages/bootstrap/css/bootstrap.min.css',
            [],
            $this->version()
        );
        
        // Frontend Styles.
        wp_enqueue_style(
            'iwct',
            get_template_directory_uri() . '/assets/css/styles.min.css',
            [],
            $this->version()
        );

        // Bootstrap JavaScript.
        wp_enqueue_script(
            'bootstrap',
            get_template_directory_uri() . '/assets/packages/bootstrap/js/bootstrap.bundle.min.js',
            [],
            $this->version(),
            true
        );
        
        // IWCT JavaScript.
        wp_enqueue_script(
            'iwct',
            get_template_directory_uri() . '/assets/js/scripts.min.js',
            ['jquery'],
            $this->version(),
            true
        );

        // Comments.
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    public static function version()
    {
        $version = IWCT_VERSION;
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $version .= '.' . time();
        }

        return $version;
    }
}
