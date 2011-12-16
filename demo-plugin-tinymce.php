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

function tinymce_script_init() {

    global $tinymce_plugin_url;
    // Only add the javascript to post.php, post-new.php, page-new.php, or
    // bookmarklet.php pages
    if (strpos($_SERVER['REQUEST_URI'], 'post-new.php') 
    || strpos($_SERVER['REQUEST_URI'], 'page-new.php')
    || strpos($_SERVER['REQUEST_URI'], 'page.php')
    || strpos($_SERVER['REQUEST_URI'], 'post.php')) {
?>
  
<script type="text/javascript">
    //<![CDATA[  
    
    var tinymce_from_gui;
    
    function edInsertDemoTinyMCE(){
        tb_show("Add a Tiny", "<?php echo $tinymce_plugin_url; ?>/tinymceinput.php?TB_iframe=true");
        tinymce_from_gui = true;
    }
    
    function edInsertDemoTinyMCECode(){
        tb_show("Add a Tiny", "<?php echo $tinymce_plugin_url; ?>/tinymceinput.php?TB_iframe=true");
        tinymce_from_gui = false;
    }
    
    var tinymce_qttoolbar = document.getElementById("ed_toolbar");  
    
    if (tinymce_qttoolbar) {
        var tnewbutton = document.createElement("input");
        tnewbutton.type = "button";
        tnewbutton.id = 'ed_tinymce';
        tnewbutton.className = 'ed_button';
        tnewbutton.value = 'DemoTinyMCE';
        tnewbutton.onclick = edInsertDemoTinyMCECode;
        tnewbutton.title = 'TinyMCEDemo';
        tinymce_qttoolbar.appendChild(tnewbutton);
    } 
    //]]>
</script>
<?php 
    }
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
add_filter('admin_footer', 'tinymce_script_init');

?>
