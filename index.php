<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h3> <?php the_title(); ?></h3>
        <?php the_content(); ?>
        <?php if (has_post_thumbnail()) { ?>
            <?php the_post_thumbnail('test'); ?>
        <?php } else { ?>
            <img src="<?php bloginfo('template_directory'); ?>/images/no-thumb.jpg"/>
        <?php } ?>
    <?php endwhile; ?>
<?php else : ?>

<?php endif; ?>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
