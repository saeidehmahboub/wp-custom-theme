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
                        global $post;
                        $posts = get_posts([
                            'post_type' => 'course',
                            'post_status' => 'publish',
                            'numberposts' => -1    
                        ]);
                        if( $posts ):
                            foreach( $posts as $post ) :   
                                setup_postdata($post); 

                                $course_type = get_post_meta($post->ID, 'course_type', true);
                                $course_code = get_post_meta($post->ID, 'course_code', true);
                                $course_duration = get_post_meta($post->ID, 'course_duration', true);

                                $campus = get_the_terms($post->ID, 'course_campus' );
                                
                    ?>
                            
                                <div class="col-sm-4 iwct-custom-posts">
                                    <div class="iwct-custom-post">
                                        <?php the_post_thumbnail( 'medium' ); ?>

                                        <br/>
                                        <div class="iwct-custom-post-content">
                                            <a href="#" class="iwct-custom-post-title"><?php the_title(); ?></a>
                                            
                                            <div class="iwct-custom-post-time">
                                                <div><?php echo $course_type; ?></div>
                                                <div><?php echo $course_duration; ?></div>
                                            </div>
                                            
                                            <div><?php echo $course_code; ?></div>
                                        </div>
                                        

                                        <div class="iwct-custom-post-taxonomies">
                                            <?php
                                                if($campus){
                                                    foreach($campus as $campus_item){
                                                        echo '<div tooltip="'.$campus_item->name.'" class="iwct-custom-post-taxonomy iwct-tooltip">';

                                                        $explode = explode(' ', $campus_item->name);
                                                        foreach($explode as $term_item){
                                                            echo $term_item[0];
                                                        }

                                                        echo '<span class="iwct-tooltiptext">';
                                                            echo $campus_item->name;
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
