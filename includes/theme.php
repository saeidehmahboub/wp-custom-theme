<?php
// no direct access
defined('ABSPATH') or die();

if(!class_exists('IWCT_Theme')):

/**
 * Theme Class
 *
 * @class IWCT_Theme
 * @version	1.0.0
 */
class IWCT_Theme extends IWCT_Base
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function init()
    {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('after_setup_theme', array($this, 'content_width'), 0);
    }
	
    public function setup()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         */
        add_theme_support('post-thumbnails');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
			'navigation-widgets',
        ));
		
		/**
         * Add support for editors style.
         */
		add_theme_support('editor-styles');
		
		/**
         * Add support for block style.
         */
		add_theme_support('wp-block-styles');
		
		/**
         * Add support for responsive embeds.
         */
		add_theme_support('responsive-embeds');
		
		/**
         * Add support for align wide.
         */
		add_theme_support('align-wide');
    }

    public function content_width()
    {
        $GLOBALS['content_width'] = apply_filters('IWCT_content_width', 640); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
    }

}

endif;