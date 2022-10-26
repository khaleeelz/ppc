<?php

/*
Plugin Name: LeadsLeap Ad Widget
Plugin URI: http://www.leadsleap.com/members/widget.get.php
Description: An alternative to add LeadsLeap Ad Widget
Author: LeadsLeap
Version: 7.2
Author URI: http://leadsleap.com
*/

class leadsleap_adwidget_plugin extends WP_Widget {

// constructor
function __construct() {
// Give widget name here
parent::__construct(false, $name = __('LeadsLeap Ad Widget', 'wp_widget_plugin') );
}

// widget form creation

public function form($instance) {

// Check values
if( $instance) {
$title = esc_attr($instance['title']);
$textarea = $instance['textarea'];
} else {
$title = 'Sponsored Links';
$textarea = '';
}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Widget Parameters ONLY:', 'wp_widget_plugin'); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>" rows="7" cols="20" ><?php echo $textarea; ?></textarea>
</p>
<?php
}

public function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = strip_tags($new_instance['title']);
$instance['textarea'] = strip_tags($new_instance['textarea']);
return $instance;
}

// display widget
public function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = apply_filters('widget_title', $instance['title']);
$textarea = $instance['textarea'];
echo $before_widget;

// Display the widget

// Check if title is set
if ( $title ) {
echo $before_title . $title . $after_title ;
}

// Check if textarea is set
if( $textarea ) {
echo '<script data-cfasync="false">'.$textarea.'</script><script data-cfasync="false" src="//w.leadsleap.com/js.js"></script>';
}
echo $after_widget;
}
}

// register widget
function leadsleap_adwidget_init_plugin ()
{
    return register_widget('leadsleap_adwidget_plugin');
}
add_action ('widgets_init', 'leadsleap_adwidget_init_plugin');

?>