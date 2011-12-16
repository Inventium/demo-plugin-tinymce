<?php 
/*
 Plugin Name: Demo Plugin TinyMCE
 Plugin URI: http://website-in-a-weekend.net/demo-plugins/
 Description: A brief description of the Plugin.
 Version: 0.1
 Author: Dave Doolin
 Author URI: http://website-in-a-weekend.net/
 */

// http://sumtips.com/2011/02/customize-wordpress-tinymce-buttons.html
// http://alisothegeek.com/2011/05/tinymce-styles-dropdown-wordpress-visual-editor/


/* 
 * Add a button to the editor interface.
 * Display text first.
 * Editor demo plugin has one field.
 * Field is stored in database; hard code the key.
 * Database call to process field and display.  Set up two closures for this.
 */

global $tinymce_plugin_url;
$tinymce_plugin_url = WP_PLUGIN_URL.'/demo-plugin-tinymce';


function tinymce_plugin_init() {
    
    //if (get_user_option('rich_editing') == 'true') {
    // Include hooks for TinyMCE plugin
    //add_filter('mce_external_plugins', array($this, 'tinymce_plugin_mce_external_plugins'));
    //add_filter('mce_buttons_3', array($this, 'tinymce_plugin_mce_buttons'));
    add_filter('mce_external_plugins', 'tinymce_plugin_mce_external_plugins');
    add_filter('mce_buttons_3', 'tinymce_plugin_mce_buttons');
    //}
    //global $hrecipe_plugin_url;
    //load_plugin_textdomain('hrecipe', $hrecipe_plugin_url.'/lang', 'hrecipe/lang');
}

function demo_admin_javascript() {
  wp_register_script('star-button','/wp-content/plugins/demo-plugin-tinymce/js/star-button.js','','', true);
  wp_enqueue_script('star-button');  
}
//add_action('admin_init','demo_admin_javascript');


function tinymce_script_init() {
?>  
<script type="text/javascript">
    //<![CDATA[ 
    function edInsertDemoTinyMCE(){
        tb_show("Add a Tiny", "/wiaw/wp-content/plugins/demo-plugin-tinymce/tinymceinput.php?TB_iframe=true");
    }
    //]]>
</script>
<?php
}

function tinymce_plugin_mce_external_plugins($plugins) {
    
    global $tinymce_plugin_url;
    $plugins['demo_tinymce'] = $tinymce_plugin_url.'/tinymceplugin/editor_plugin.js';
    return $plugins;
}

function tinymce_plugin_mce_buttons($buttons) {

    array_push($buttons, 'demo_tinymce_button');
    return $buttons;
}

add_action('init', 'tinymce_plugin_init');
add_filter('admin_print_footer_scripts', 'tinymce_script_init');

?>
