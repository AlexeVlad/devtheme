<?php

class Kc_Widget_Attributes {

    public static function setup() {
        if (is_admin()) {
            add_action('in_widget_form', array(__CLASS__, '_input_fields'), 10, 3);
            add_filter('widget_update_callback', array(__CLASS__, '_save_attributes'), 10, 4);
        } else {
            add_filter('dynamic_sidebar_params', array(__CLASS__, '_insert_attributes'));
        }
    }

    /*
     * Inject input fields into widget configuration form
     */

    public static function _input_fields($widget, $return, $instance) {
        $instance = self::_get_attributes($instance);
        ?>
     <!--  <p>
        <?php
         /* printf(
          '<label for="%s">%s</label>', esc_attr($widget->get_field_id('widget-link')), esc_html__('Link', 'widget-attributes')
          )
          ?>
          <?php
          printf(
          '<input type="text" class="widefat" id="%s" name="%s" value="%s" />', $widget->get_field_id('widget-link'), $widget->get_field_name('widget-link'), $instance['widget-link']
          ) */
        ?>
           </p> -->
        <p>
            <?php
            printf(
                    '<label for="%s">%s</label>', esc_attr($widget->get_field_id('widget-class')), esc_html__('HTML Class(es)', 'widget-attributes')
            )
            ?>
            <?php
            printf(
                    '<input type="text" class="widefat" id="%s" name="%s" value="%s" />', esc_attr($widget->get_field_id('widget-class')), esc_attr($widget->get_field_name('widget-class')), esc_attr($instance['widget-class'])
            )
            ?>
            
        </p>
        <?php
        return null;
    }

    /*
     * Get default attributes
     */

    private static function _get_attributes($instance) {
        $instance = wp_parse_args(
                $instance, array(
            'widget-id' => '',
            'widget-class' => '',
                )
        );
        return $instance;
    }

    /*
     * Save attributes upon widget saving
     */

    public static function _save_attributes($instance, $new_instance, $old_instance, $widget) {
        $instance['widget-id'] = $instance['widget-class'] = '';
// Link
        if (!empty($new_instance['widget-link'])) {
            $instance['widget-link'] = apply_filters(
                    'widget_attribute_link', $new_instance['widget-link']
            );
        }
// Classes
        if (!empty($new_instance['widget-class'])) {
            $instance['widget-class'] = apply_filters(
                    'widget_attribute_classes', implode(
                            ' ', array_map(
                                    'sanitize_html_class', explode(' ', $new_instance['widget-class'])
                            )
                    )
            );
        } else {
            $instance['widget-class'] = '';
        }
        return $instance;
    }

    /**
     * Insert attributes into widget markup
     */
    public static function _insert_attributes($params) {
        global $wp_registered_widgets;
        $widget_id = $params[0]['widget_id'];
        $widget_obj = $wp_registered_widgets[$widget_id];
        if (
                !isset($widget_obj['callback'][0]) || !is_object($widget_obj['callback'][0])
        ) {
            return $params;
        }
        $widget_options = get_option($widget_obj['callback'][0]->option_name);
        if (empty($widget_options))
            return $params;
        $widget_num = $widget_obj['params'][0]['number'];
        if (empty($widget_options[$widget_num]))
            return $params;
        $instance = $widget_options[$widget_num];
// Link
        if (!empty($instance['widget-link'])) {
            $params[0]['before_widget'] = preg_replace(
                    '/href=".*?"/', sprintf('href="%s"', $instance['widget-link']), $params[0]['before_widget'], 1
            );
        }
// Classes
        if (!empty($instance['widget-class'])) {
            $params[0]['before_widget'] = preg_replace(
                    '/class="/', sprintf('class="%s ', $instance['widget-class']), $params[0]['before_widget'], 1
            );
        }
        return $params;
    }

}

add_action('widgets_init', array('Kc_Widget_Attributes', 'setup'));
?>