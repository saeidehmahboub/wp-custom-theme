
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'my-theme'); ?></a>

    <div id="primary">

        <header>
            <div class="row">
                <div class="col-sm-6 iwct-header-left">
                    <h3 class="iwct-header-left-title">Land a career that you love</h3>
                
                    <p class="iwct-header-left-description">
                        <i class="fa-sharp fa-solid fa-quote-left iwct-qutation-fontawesome-top"></i>
                        I have had an amazing time studying at the College, 
                        made lots of new friends and cannot wait to progress to Level 2, 
                        so that I can pursue my dream of working with animals.
                        <i class="fa-sharp fa-solid fa-quote-right iwct-qutation-fontawesome-bottom"></i>
                    </p>

                    <div class="iwct-header-left-text-bottom">Amy studied Introduction to Animal Care (Level 1)</div>
                </div>
                <div class="col-sm-6 iwct-header-right">
                    <img 
                        src="<?php echo esc_html(get_template_directory_uri()); ?>/assets/img/flowers-turkey.jpg" 
                        alt="img"
                    />
                </div>
            </div>
        </header>
    
        
