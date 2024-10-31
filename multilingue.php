<?php
/*
Plugin Name: Multilingue
Plugin URI: https://wordpress.org/plugins/multilingue/
Description: Translate your website in one click !
Version: 1.0.1
Author: Bastien Canas
Author URI: http://bastiencanas.fr/
*/
class myWidget {

	function myWidget() {
		add_action('widgets_init', array(& $this, 'init_widget'));
	}

	function init_widget() {
		if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
			return;
		register_sidebar_widget(array('Multilingue','widgets'),array(& $this, 'widget'));
		register_widget_control(array('Multilingue', 'widgets'), array(& $this, 'widget_options'));
	}

	function widget($args) {
		global $wpdb;

		$WidgetTitle=get_option('mywidget_options');
		extract($args);

		echo $before_widget.$before_title.$WidgetTitle.$after_title;

$Langue = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$Langue = strtolower(substr(chop($Langue[0]),0,2));
?>

<a href="http://translate.google.com/translate?u=<?php echo get_option('home'); ?>&langpair=<?php echo $Langue; ?>|fr" target="_blank" ><img src="<?php echo WP_PLUGIN_URL ?>/multilingue/img/fr.png" alt="Fran&ccedil;ais" width="24" height="24" border="0"></a> 
<a href="http://translate.google.com/translate?u=<?php echo get_option('home'); ?>&langpair=<?php echo $Langue; ?>|en" target="_blank"><img src="<?php echo WP_PLUGIN_URL ?>/multilingue/img/gb.png" alt="English" width="24" height="24" border="0"></a> 
<a href="http://translate.google.com/translate?u=<?php echo get_option('home'); ?>&langpair=<?php echo $Langue; ?>|de" target="_blank"><img src="<?php echo WP_PLUGIN_URL ?>/multilingue/img/de.png" alt="Deutsch" width="24" height="24" border="0"></a> 
<a href="http://translate.google.com/translate?u=<?php echo get_option('home'); ?>&langpair=<?php echo $Langue; ?>|it" target="_blank"><img src="<?php echo WP_PLUGIN_URL ?>/multilingue/img/it.png" alt="Italiano" width="24" height="24" border="0"></a> 
<a href="http://translate.google.com/translate?u=<?php echo get_option('home'); ?>&langpair=<?php echo $Langue; ?>|es" target="_blank"><img src="<?php echo WP_PLUGIN_URL ?>/multilingue/img/es.png" alt="Espa&ntilde;ol" width="24" height="24" border="0"></a>
<a href="http://translate.google.com/translate?u=<?php echo get_option('home'); ?>&langpair=<?php echo $Langue; ?>|zh-CN" target="_blank"><img src="<?php echo WP_PLUGIN_URL ?>/multilingue/img/cn.png" alt="Chinese" width="24" height="24" border="0"></a>
<?php
		echo $after_widget;
	}

	function widget_options() {
		if ($_POST['mywidget_options']) {
			$option=$_POST['mywidget_options'];
			update_option('mywidget_options',$option);
		}
		$option=get_option('mywidget_options');
		echo '<label for="mywidget_options">Title : <input id="mywidget_options" name="mywidget_options" type="text" value="'.$option.'" /></label>';
	}
}
$myWidgetVariable= new myWidget ();
?>