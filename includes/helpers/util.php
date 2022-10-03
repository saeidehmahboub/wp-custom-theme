<?php

/**
 * Theme util functions
 *
 * @package IWCT
 */

if (!function_exists('wp_body_open')) {
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
}
