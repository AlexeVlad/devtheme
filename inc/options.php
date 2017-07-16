<?php
// create custom plugin settings menu
add_action('admin_menu', 'theme_create_menu');

function theme_create_menu() {

    //create new top-level menu
    add_menu_page('Theme Settings', 'Theme Options', 'administrator', __FILE__, 'theme_settings_page', 'dashicons-admin-tools');

    //call register settings function
    add_action('admin_init', 'register_mysettings');
}

function register_mysettings() {
    //register our settings
    register_setting('theme-settings-group', 'facebook');
    register_setting('theme-settings-group', 'twitter');
    register_setting('theme-settings-group', 'google');
    register_setting('theme-settings-group', 'youtube');
    register_setting('theme-settings-group', 'linkedin');
    register_setting('theme-settings-group', 'googleanalytics');
}

function theme_settings_page() {
    ?>
    <div class="wrap">
        <h2>Theme Options</h2>

        <form method="post" action="options.php">
            <?php settings_fields('theme-settings-group'); ?>
            <?php do_settings_sections('theme-settings-group'); ?>
            <table class="form-table">
                <th style="font-size: 18px;">Social</th>
                <tr valign="top">
                    <th scope="row">Facebook</th>
                    <td><input type="text" name="facebook" value="<?php echo esc_attr(get_option('facebook')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Twitter</th>
                    <td><input type="text" name="twitter" value="<?php echo esc_attr(get_option('twitter')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Google</th>
                    <td><input type="text" name="google" value="<?php echo esc_attr(get_option('google')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Youtube</th>
                    <td><input type="text" name="youtube" value="<?php echo esc_attr(get_option('youtube')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Linkedin</th>
                    <td><input type="text" name="linkedin" value="<?php echo esc_attr(get_option('linkedin')); ?>" /></td>
                </tr>
                <th style="font-size: 18px;">Analytics</th>
                <tr valign="top">
                    <th scope="row">Google Analytics</th>
                    <td><textarea style="resize: none;" rows="8" cols="50" name="googleanalytics"><?php echo esc_attr(get_option('googleanalytics')); ?></textarea></td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>
<?php } ?>