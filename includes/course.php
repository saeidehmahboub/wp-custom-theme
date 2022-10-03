<?php

namespace IWCT;

/**
 * Course Class
 *
 * @class IWCT_Course
 * @version 1.0.0
 */
class IWCTCourse extends IWCTBase
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function init()
    {
        add_action('init', [$this, 'registerPostType']);
        add_action('init', [$this, 'registerCampusTaxonomy']);
        add_action('init', [$this, 'registerCoursetypeTaxonomy']);

        add_action('add_meta_boxes_course', [$this, 'metaBoxForCourse']);
        add_action('save_post_course', [$this, 'courseSaveMetaBoxesData'], 10, 2);
    }

    public function registerPostType()
    {
        register_post_type('course', [
            'label' => __('Courses', 'my-theme'),
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-book',
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'course'],
            'labels' => [
                'singular_name' => __('Course', 'my-theme'),
                'add_new_item' => __('Add new course', 'my-theme'),
                'new_item' => __('New course', 'my-theme'),
                'view_item' => __('View course', 'my-theme'),
                'not_found' => __('No courses found', 'my-theme'),
                'not_found_in_trash' => __('No courses found in trash', 'my-theme'),
                'all_items' => __('All courses', 'my-theme'),
                'insert_into_item' => __('Insert into course', 'my-theme')
            ],
        ]);
    }

    public function registerCampusTaxonomy()
    {
        register_taxonomy('course_campus', ['course'], [
            'label' => __('Campus', 'my-theme'),
            'rewrite' => ['slug' => 'course-campus'],

            'hierarchical' => false,
            'show_admin_column' => true,
            'show_in_rest' => true,
            
            'labels' => [
                'singular_name' => __('Campus', 'my-theme'),
                'all_items' => __('All Campus', 'my-theme'),
                'edit_item' => __('Edit Campus', 'my-theme'),
                'view_item' => __('View Campus', 'my-theme'),
                'update_item' => __('Update Campus', 'my-theme'),
                'add_new_item' => __('Add New Campus', 'my-theme'),
                'new_item_name' => __('New Campus Name', 'my-theme'),
                'search_items' => __('Search Campus', 'my-theme'),
                'popular_items' => __('Popular Campus', 'my-theme'),
                'separate_items_with_commas' => __('Separate campus with comma', 'my-theme'),
                'choose_from_most_used' => __('Choose from most used campus', 'my-theme'),
                'not_found' => __('No Campus found', 'my-theme'),
            ]
        ]);
    }

    public function registerCoursetypeTaxonomy()
    {
        register_taxonomy('coursetype', ['course'], [
            'label' => __('Course Types', 'my-theme'),
            'rewrite' => ['slug' => 'course-coursetype'],
            
            'hierarchical' => false,
            'show_admin_column' => true,
            'show_in_rest' => false,

            'labels' => [
                'name' => __('Course Types', 'my-theme'),
                'singular_name' => __('Course Type', 'my-theme'),
                'menu_name' => __('Course Types', 'my-theme'),
                'all_items' => __('All Course Types', 'my-theme'),
                'parent_item' => __('Parent Course Type', 'my-theme'),
                'parent_item_colon' => __('Parent Course Type:', 'my-theme'),
                'new_item_name' => __('New Course Type Name', 'my-theme'),
                'add_new_item' => __('Add New Course Type', 'my-theme'),
                'edit_item' => __('Edit Course Type', 'my-theme'),
                'update_item' => __('Update Course Type', 'my-theme'),
                'view_item' => __('View Course Type', 'my-theme'),
                'separate_items_with_commas' => __('Separate Course Types with commas', 'my-theme'),
                'add_or_remove_items' => __('Add or remove Course Types', 'my-theme'),
                'choose_from_most_used' => __('Choose from the most used', 'my-theme'),
                'popular_items' => __('Popular Course Types', 'my-theme'),
                'search_items' => __('Search Course Types', 'my-theme'),
                'not_found' => __('Not Found', 'my-theme'),
                'no_terms' => __('No Course Types', 'my-theme'),
                'items_list' => __('Course Types list', 'my-theme'),
                'items_list_navigation' => __('Course Types list navigation', 'my-theme'),
            ],
        ]);
    }

    public function courseSaveMetaBoxesData( $post_id )
    {
        $post = wp_unslash($_POST);

        // check for nonce to top xss.
        if (
            !isset($post['course_meta_box_nonce'])
            || !wp_verify_nonce($post['course_meta_box_nonce'], basename(__FILE__))
        ) {
            return;
        }
    
        // check for correct user capabilities - stop internal xss from customers.
        if (! current_user_can('edit_post', $post_id)) {
            return;
        }
    
        // update fields.
        if (isset($_REQUEST['course_type'])) {
            update_post_meta($post_id, 'course_type', sanitize_text_field($post['course_type']));
        }

        if (isset($_REQUEST['course_code'])) {
            update_post_meta($post_id, 'course_code', sanitize_text_field($post['course_code']));
        }

        if (isset($_REQUEST['course_duration'])) {
            update_post_meta($post_id, 'course_duration', sanitize_text_field($post['course_duration']));
        }
    }

    public function metaBoxForCourse( $post )
    {
        add_meta_box(
            'my_meta_box_custom_id',
            __('Additional info', 'my-theme'),
            [$this, 'courseMetaBoxHtmlOutput'],
            'course',
            'normal',
            'low'
        );
    }

    public function courseMetaBoxHtmlOutput( $post )
    {
        wp_nonce_field(basename(__FILE__), 'course_meta_box_nonce');

        $course_type = get_post_meta($post->ID, 'course_type', true);
        $course_code = get_post_meta($post->ID, 'course_code', true);
        $course_duration = get_post_meta($post->ID, 'course_duration', true);
        
        $terms = get_terms([
            'taxonomy' => 'coursetype',
            'hide_empty' => false,
        ]);
        ?>
            <p>
                <label><?php echo esc_html_e('Course Type:', 'my-theme'); ?></label>
                <select name="course_type">
                    <option><?php echo esc_html_e('Select', 'my-theme'); ?></option>
                    <?php
                    foreach ($terms as $term) {
                        $selected = $course_type === $term->name ? 'selected' : '';
                            
                        echo '<option ' . esc_html($selected) . ' value="' . esc_html($term->name) . '">' .
                            esc_html($term->name) .
                        '</option>';
                    }
                    ?>
                </select>
            </p>

            <p>
                <label><?php echo esc_html_e('Course Code:', 'my-theme'); ?></label>
                <input type="text" value="<?php echo esc_html($course_code); ?>" name="course_code"/>
            </p>

            <p>
                <label><?php echo esc_html_e('Course Duration:', 'my-theme'); ?></label>
                <input type="text" value="<?php echo esc_html($course_duration); ?>" name="course_duration"/>
            </p>
        <?php
    }
}
