<?php get_header(); ?>
<div class="content">
    <div class="wrapper">
        <?php if (have_posts()) : ?>
            <header>
                <h1><?php printf(__('Category Archives: %s'), single_cat_title('', false)); ?></h1>

                <?php if (category_description()) : // Show an optional category description ?>
                   <?php echo category_description(); ?>
                <?php endif; ?>
            </header>
            <?php while (have_posts()) : the_post(); ?>
                <?php if (has_post_thumbnail()) { ?>
                    <?php the_post_thumbnail('blog'); ?>
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

    </div>
</div>
</div><!-- content -->

<?php get_footer(); ?>