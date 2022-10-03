<div class="col-sm-3 iwct-filters">
    <div id="iwct-filters-campus">
        <div class="iwct-filters-title">
            Filter by campus
            <button class="iwct-filters-button"><i class="fa-solid fa-chevron-up"></i></button>
        </div>
        <ul class="iwct-filters-items">
            <?php
                $course_campus_terms = get_terms( 'course_campus', array(
                    'hide_empty' => false,
                ) );

                foreach ($course_campus_terms as $term){
                    echo '<li class="iwct-filters-item">
                            <input type="checkbox" id="'.$term->name.'" name="'.$term->name.'" value="'.$term->name.'">
                            <label for="'.$term->name.'">'.$term->name.' </label>
                        </li>';
                }
            ?>
        </ul>
    </div>

    <div id="iwct-filters-course-type">
        <div class="iwct-filters-title">
            Filter by course type
            <button class="iwct-filters-button" ><i class="fa-solid fa-chevron-up"></i></button>
        </div>
        <ul class="iwct-filters-items">
            <?php
                $course_type_terms = get_terms( 'coursetype', array(
                    'hide_empty' => false,
                ) );

                foreach ($course_type_terms as $term){
                    echo '<li class="iwct-filters-item">
                            <input type="checkbox" id="'.$term->name.'" name="'.$term->name.'" value="'.$term->name.'">
                            <label for="'.$term->name.'">'.$term->name.' </label>
                        </li>';
                }
            ?>
        </ul>
    </div>

    <button class="iwct-filters-apply-button">Apply now</button>
</div>