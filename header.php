<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

    <head profile="http://gmpg.org/xfn/11">
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,minimum-scale=1, user-scalable=no" />
        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico"/>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="header">
            <a href="<?php echo esc_url(home_url()); ?>" class="logo"></a>
            <span class="small_res_menu">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <nav class="menu">
                <?php wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' => 'header-menu')); ?>
            </nav>
            <?php get_search_form(true); ?>
               <div class="social">
                <?php
                $facebook = get_option('facebook');
                $twitter = get_option('twitter');
                $google = get_option('google');
                $youtube = get_option('youtube');
                $linkedin = get_option('linkedin');
                ?>
                <?php if (!empty($facebook)) { ?>
                    <a href="<?php echo $facebook; ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                <?php } ?>
                <?php if (!empty($twitter)) { ?>
                    <a href="<?php echo $twitter; ?>" class="twitter"><i class="fa fa-twitter"></i></a>
                <?php } ?>
                <?php if (!empty($google)) { ?>
                    <a href="<?php echo $google; ?>" class="google"><i class="fa fa-google"></i></a>
                <?php } ?>
                <?php if (!empty($youtube)) { ?>
                    <a href="<?php echo $youtube; ?>" class="youtube"><i class="fa fa-youtube-play"></i></a>
                <?php } ?>
                <?php if (!empty($linkedin)) { ?>
                    <a href="<?php echo $linkedin; ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <?php } ?>
            </div>
        </header>