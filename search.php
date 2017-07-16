<?php get_header(); ?>

<div class="content">
    <div class="wrapper">
        <?php include_once('part/sidebar-inc.php'); ?>
        <h1><?php _e('Search results'); ?></h1>
        <?php
        global $wpdb, $wp_query;
        $tmp = $wp_query;
        $search = get_search_query();
        $exclude = array(0);
        $args = array(
            'paged' => get_query_var('paged'),
            'post_type' => 'any',
            's' => $search,
        );
        $wp_query = new WP_Query($args);
        if (have_posts()) : while (have_posts()) : the_post();
                ?>
                <div class="news-box">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="news-thumb"><?php the_post_thumbnail('blog') ?></div>
                    <?php } else { ?>
                        <div class="news-thumb"><img src="<?php bloginfo('template_url'); ?>/images/no-thumb.jpg"/></div>
                    <?php } ?>
                    <div class="news-content">
                        <?php echo get_post_meta($post->ID, '_subtitle', TRUE); ?>
                        <div class="news-date">Posted on <span><?php echo get_the_date("j F, Y"); ?></span> by <?php the_author(); ?> | <a href="<?php comments_link(); ?>">Reply</a></div>
                        <div class="content-blog">
                            <?php the_excerpt(); ?>
                            <a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php
            endwhile;
        else :
            ?>
            <p><?php _e("We are sorry but we haven't found anything"); ?></p>
        <?php
        endif;
        if (function_exists('wp_pagenavi')) {
            wp_pagenavi();
        } else {
            ?><div class="navigation"><p><?php posts_nav_link(); ?></p></div><?php
        }
        $wp_query = $tmp;
        unset($tmp);
        wp_reset_query();
        ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>