<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <header>

        <h1><?php
            if (is_day()) :
                printf(__('Daily Archives: %s'), get_the_date());
            elseif (is_month()) :
                printf(__('Monthly Archives: %s'), get_the_date(_x('F Y', 'monthly archives date format')));
            elseif (is_year()) :
                printf(__('Yearly Archives: %s'), get_the_date(_x('Y', 'yearly archives date format')));
            else :
                _e('Archives');
            endif;
            ?></h1>
    </header>
    <?php while (have_posts()) : the_post(); ?>
        <?php if (has_post_thumbnail()) { ?>
           <?php the_post_thumbnail('test'); ?>
        <?php } else { ?>
            <img src="<?php bloginfo('template_directory'); ?>/images/no-thumb.jpg"/>
        <?php } ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
    <?php
    if (function_exists('wp_pagenavi')) {
        wp_pagenavi();
    } else {
        ?>
        <div class="postNavi">
            <div class="clear"></div><p><?php posts_nav_link(); ?></p>
        </div>
        <?php
    }
    $wp_query = $tmp;
    wp_reset_query();
    ?> 

<?php endif; ?>
<?php get_footer(); ?>