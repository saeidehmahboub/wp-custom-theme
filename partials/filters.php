<div class="col-sm-3 iwct-filters">
    <div id="iwct-filters-campus">
        <div class="iwct-filters-title">
            <?php esc_html_e('Filter by campus', 'my-theme'); ?>
            <button class="iwct-filters-button"><i class="fa-solid fa-chevron-up"></i></button>
        </div>
        <ul class="iwct-filters-items">
            <?php
                $course_campus_terms = get_terms('course_campus', [
                    'hide_empty' => false,
                ]);

                foreach ($course_campus_terms as $course_campus_term) {
                    $name = $course_campus_term->name;

                    echo '<li class="iwct-filters-item">
                            <input 
                                type="checkbox" 
                                id="' . esc_html($name) . '" 
                                name="' . esc_html($name) . '" 
                                value="' . esc_html($name) . '"
                            />
                            <label for="' . esc_html($name) . '">' . esc_html($name) . ' </label>
                        </li>';
                }
                ?>
        </ul>
    </div>

    <div id="iwct-filters-course-type">
        <div class="iwct-filters-title">
            <?php esc_html_e('Filter by course type', 'my-theme'); ?>
            <button class="iwct-filters-button" ><i class="fa-solid fa-chevron-up"></i></button>
        </div>
        <ul class="iwct-filters-items">
            <?php
                $course_type_terms = get_terms('coursetype', [
                    'hide_empty' => false,
                ]);

                foreach ($course_type_terms as $course_type_term) {
                    $name = $course_type_term->name;
                    echo '<li class="iwct-filters-item">
                            <input 
                                type="checkbox" 
                                id="' . esc_html($name) . '" 
                                name="' . esc_html($name) . '" 
                                value="' . esc_html($name) . '"
                            />
                            <label for="' . esc_html($name) . '">' . esc_html($name) . ' </label>
                        </li>';
                }
                ?>
        </ul>
    </div>

    <button class="iwct-filters-apply-button"><?php esc_html_e('Apply now', 'my-theme'); ?></button>
</div>
