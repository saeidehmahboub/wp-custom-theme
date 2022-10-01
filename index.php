<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Itineris wp custom theme
 */

get_header();
?>
<div class="iwct-main-content">
    <div class="container">
        <div class="row">
            <?php get_template_part('partials/filters'); ?>
            <div class="col-sm-9 ">

            </div>
        </div>
    </div>
    
</div>
<?php
get_footer();
