<?php

function get_breadcrumbs() {
    global $wp_query;
    if (!is_home()) {
        // Start the UL
        echo '<ul id="breadcrumbs" itemprop="breadcrumb" class="breadcrumbs">';
        // Add the Home link
        echo '<li><a rel="home" href="' . get_settings('home') . '">' . 'Home' . '</a></li>';
        if (is_category()) {
            $catTitle = single_cat_title("", false);
            $cat = get_cat_ID($catTitle);
            echo "<li>  " . get_category_parents($cat, TRUE, "  ") . "</li>";
        } elseif (is_archive() && !is_category()) {
            echo "<li>  Archives</li>";
        } elseif (is_search()) {
            echo "<li>  Search Results</li>";
        } elseif (is_404()) {
            echo "<li>  404 Not Found</li>";
        } elseif (is_single()) {
            if (get_post_type() == 'management') {
                echo '<li><a href="' . $homeLink . '/' . 'about-us' . '/">About Us</a></li>';
                echo '<li><a href="' . $homeLink . '/' . 'about-us/management-team' . '/"> Management Team </a></li>';
                echo '<li>' . get_the_title() . '</li>';
            } else {
                $category = get_the_category();
                $category_id = get_cat_ID($category[0]->cat_name);
                echo '<li>  ' . get_category_parents($category_id, TRUE, "  ") . "</li>";
                echo '<li>  ' . the_title('', '', FALSE) . "</li>";
            }
        } elseif (is_page()) {
            $post = $wp_query->get_queried_object();
            if ($post->post_parent == 0) {
                echo "<li>  " . the_title('', '', FALSE) . "</li>";
            } else {
                $title = the_title('', '', FALSE);
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                array_push($ancestors, $post->ID);
                foreach ($ancestors as $ancestor) {
                    if ($ancestor != end($ancestors)) {
                        echo '<li>  <a href="' . get_permalink($ancestor) . '"' . 'title="' . get_the_title($ancestor) . '"rel="' . get_the_title($ancestor) . '">' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '</a></li>';
                    } else {
                        echo '<li>  ' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '</li>';
                    }
                }
            }
        }
        // End the UL
        echo "</ul>";
    }
}

?>