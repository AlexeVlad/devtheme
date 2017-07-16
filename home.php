<?php
/*
  Template Name: Home
 */

get_header();
?>
<section class="content home">

    <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <?php if (has_post_thumbnail()) { ?>
            <?php the_post_thumbnail('test'); ?>
        <?php } else { ?>
            <img src="<?php bloginfo('template_directory'); ?>/images/no-thumb.jpg"/>
        <?php } ?>
    <?php endwhile; ?>

    <!-- custom query -->
    <?php
    $custom_query = new WP_Query(array(
        'post_type' => 'test',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'test_category',
                'field' => 'term_id',
                'terms' => 7
            )
        )
    ));
    ?>

    <?php if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

            <?php
        endwhile;
        wp_reset_query();
    endif;
    ?>

    <!-- custom query 2 -->
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args_news = array(
        'post_type' => 'test',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'paged' => $paged,
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'test_category',
                'field' => 'id',
                'terms' => 7,
            ),
        ),
    );
    query_posts($args_news);
    if (have_posts()) : while (have_posts()) : the_post();
            ?>
            <?php
        endwhile;
    endif;
    if (function_exists('wp_pagenavi')) {
        ?>  
        <div class="navigation">
            <?php wp_pagenavi(array('query' => $ina)); ?>
        </div>
    <?php } else {
        ?>
        <div class="navigation ina-nav">
            <p><?php posts_nav_link(); ?></p>
        </div>
        <?php
    }
    wp_reset_query();
    ?>
    <!-- acf Repeater -->

    <?php if (have_rows('repeater_field_name')): ?>
        <?php
        while (have_rows('repeater_field_name')): the_row();
            $image = get_sub_field('image');
            $content = get_sub_field('content');
            ?>
            <?php if (!empty($content)): ?>
                <div class="content"><?php echo $content; ?></div>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
    <!-- acf fields -->
    <?php
    $image = get_field("image");
    $image_url = $image['url'];
    $image_title = $image['title'];
    $image_alt = $image['alt'];
    $image_caption = $image['caption'];
    $image_size = 'thumbnail';
    $image_thumb = $image['sizes'][$image_size];
    $image_width = $image['sizes'][$image_size . '-width'];
    $image_height = $image['sizes'][$image_size . '-height'];

    $title = get_field("tratamente_titlu_home");
    ?>

    <?php if (!empty($image)) { ?>
        <a href="<?php echo $image_url; ?>" title="<?php echo $image_title; ?>">
            <img src="<?php echo $image_thumb; ?>" alt="<?php echo $image_alt; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
        </a>
    <?php } ?>
    <?php if (!empty($title)): ?>
        <div class="title"><?php echo $title; ?></div>
    <?php endif; ?>

    <!-- language change -->
    <?php if (ICL_LANGUAGE_CODE == en) { ?>
        <?php echo do_shortcode('[contact-form-7 id="119" title="Contact En"]') ?> 
    <?php } ?>
    <?php if (ICL_LANGUAGE_CODE == ro) { ?>
        <?php echo do_shortcode('[contact-form-7 id="4" title="Contact Ro"]') ?> 
    <?php } ?>


</section>

<?php get_footer(); ?>