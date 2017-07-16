<?php get_header(); ?>
<section class="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php if (has_post_thumbnail()) { ?>
                <?php the_post_thumbnail('test'); ?>
            <?php } else { ?>
                <img src="<?php bloginfo('template_directory'); ?>/images/no-thumb.jpg"/>
            <?php } ?>

            <?php the_content(); ?>

            <?php
        endwhile;

    endif;
    ?>
</section>
<aside class="sidebar">
    <?php get_sidebar(); ?>
</aside>
<?php get_footer(); ?>
