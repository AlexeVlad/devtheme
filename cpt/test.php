<?php
add_action('init', 'test_init');

function test_init() {
    $labels = array(
        'name' => __('Test'),
        'singular_name' => __('test'),
        'add_new' => __('Add test'),
        'add_new_item' => __('Add test'),
        'edit_item' => __('Edit test'),
        'new_item' => __('New test'),
        'view_item' => __('View test'),
        'search_items' => __('Search test'),
        'not_found' => __('No test found'),
        'not_found_in_trash' => __('No test found in trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-clipboard', //https://developer.wordpress.org/resource/dashicons/#menu
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('test', $args);
}

add_action('admin_init', 'register_meta_boxes_test');

function register_meta_boxes_test() {
    add_meta_box('test_meta_box', __('Link Pic'), 'test_meta_box', 'test', 'normal', 'high');
}

function test_meta_box() {
    global $post;
    $nonce_value = wp_create_nonce('test_nonce');
    $_fname = get_post_meta($post->ID, '_fname', true);
    ?>

    <input type="hidden" name="test_nonce" value="<?php echo $nonce_value; ?>" />
    <label class="test"><?php _e('Nume:'); ?></label>
    <input type="text" name="_fname" value="<?php echo $_fname ?>" size="45" />

    <?php
}

add_action('save_post', 'test_save');

function test_save($post_id) {
    if (!wp_verify_nonce($_POST['test_nonce'], 'test_nonce'))
        return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    if (('test' == $_POST['post_type']) && (!current_user_can('manage_options', $post_id)))
        return $post_id;;
    update_post_meta($post_id, '_fname', $_POST['_fname']);
}
?>