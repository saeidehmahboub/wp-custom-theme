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
                <div class="row">
                    <?php
                        $course_posts = get_posts([
                            'post_type' => 'course',
                            'post_status' => 'publish',
                            'numberposts' => -1
                        ]);
                        if ($course_posts) :
                            foreach ($course_posts as $course_post) :
                                setup_postdata($course_post);

                                $course_type = get_post_meta($course_post->ID, 'course_type', true);
                                $course_code = get_post_meta($course_post->ID, 'course_code', true);
                                $course_duration = get_post_meta($course_post->ID, 'course_duration', true);

                                $campus = get_the_terms($course_post->ID, 'course_campus');
                                
                                ?>
                            
                                <div class="col-sm-4 iwct-custom-posts">
                                    <div class="iwct-custom-post">
                                        <?php echo get_the_post_thumbnail($course_post->ID, 'medium'); ?>

                                        <br/>
                                        <div class="iwct-custom-post-content">
                                            <a href="#" class="iwct-custom-post-title">
                                                <?php echo esc_html(get_the_title($course_post->ID)); ?>
                                            </a>
                                            
                                            <div class="iwct-custom-post-time">
                                                <div><?php echo esc_html($course_type); ?></div>
                                                <div><?php echo esc_html($course_duration); ?></div>
                                            </div>
                                            
                                            <div><?php echo esc_html($course_code); ?></div>
                                        </div>
                                        

                                        <div class="iwct-custom-post-taxonomies">
                                            <?php
                                            if ($campus) {
                                                foreach ($campus as $campus_item) {
                                                    echo '<div tooltip="' . esc_html($campus_item->name) . '" 
                                                        class="iwct-custom-post-taxonomy iwct-tooltip">';

                                                    $explode = explode(' ', $campus_item->name);
                                                    foreach ($explode as $term_item) {
                                                        echo esc_html($term_item[0]);
                                                    }

                                                    echo '<span class="iwct-tooltiptext">';
                                                        echo esc_html($campus_item->name);
                                                    echo '</span>';

                                                    echo '</div> ';
                                                }
                                            }
                                            ?>
                                        </div>
                                        

                                    </div>
                                    
                                </div>
                                <?php
                            endforeach;
                            wp_reset_postdata();
                        endif;
                        ?>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php
get_footer();
