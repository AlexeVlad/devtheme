<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php if (has_post_thumbnail()) { ?>
            <?php the_post_thumbnail('test'); ?>
        <?php } else { ?>
            <img src="<?php bloginfo('template_directory'); ?>/images/no-thumb.jpg"/>
        <?php } ?>
        <?php the_content(); ?>
        <?php comments_template(); ?>
        <?php
    endwhile;
endif;
?>
<?php get_footer(); ?>
