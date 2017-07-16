<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
    return;
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php _e('COMMENTS'); ?>
        </h2>
        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'type' => 'comment',
                'callback' => 'theme_comment',
                'style' => 'ul',
                'short_ping' => true,
                'avatar_size' => 45,
            ));
            ?>
        </ul><!-- .comment-list -->
        <?php
        // Are there comments to navigate through?
        if (get_comment_pages_count() > 1 && get_option('page_comments')) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php _e('Comment navigation'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;')); ?></div>
            </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation  ?>

        <?php if (!comments_open() && get_comments_number()) : ?>
            <p class="no-comments"><?php _e('Comments are closed.'); ?></p>
        <?php endif; ?>
    <?php endif; // have_comments()  ?>
    <?php
    $comments_args = array(
        // change the title of send button 
        'label_submit' => 'Send',
        'title_reply' => ' <h3 class="leaveareplytitle">' . __('Leave a reply') . '</h3>',
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x('', 'noun') . '</label><textarea id="comment" name="comment" aria-required="true" placeholder="COMMENT"></textarea></p>',
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' =>
            '<div class="comment-input-fields">' .
            '<p class="comment-form-author">' .
            '<label for="author">' . __('', 'domainreference') . '</label> ' .
            ( $req ? '<span class="required"></span>' : '' ) .
            '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
            '" size="30" placeholder="NAME"' . $aria_req . ' /></p>',
            'email' =>
            '<p class="comment-form-email"><label for="email">' . __('', 'domainreference') . '</label> ' .
            ( $req ? '<span class="required"></span>' : '' ) .
            '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
            '" size="30" placeholder="EMAIL"' . $aria_req . ' /></p>',
            'url' =>
            '<p class="comment-form-url"><label for="url">' .
            __('', 'domainreference') . '</label>' .
            '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
            '" size="30" placeholder="WEBSITE" /></p>' . '</div>'
                )
        ),
    );
    ?>
    <?php comment_form($comments_args); ?>
</div><!-- #comments -->