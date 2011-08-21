<?php 
/*
 Plugin Name: Demo Plugin TinyMCE
 Plugin URI: http://website-in-a-weekend.net/demo-plugins/
 Description: A brief description of the Plugin.
 Version: 0.1
 Author: Dave Doolin
 Author URI: http://website-in-a-weekend.net/
 */

/*  
 Copyright (c) 2009, David M. Doolin
 http://website-in-a-weekend.net/
 All rights reserved.
 Redistribution and use in source and binary forms, with or without modification,
 are permitted provided that the following conditions are met:
 
 * Redistributions of source code must retain the above copyright notice,
 this list of conditions and the following disclaimer.
 
 * Redistributions in binary form must reproduce the above copyright
 notice, this list of conditions and the following disclaimer in the
 documentation and/or other materials provided with the distribution.
 
 * Neither the name of Website In A Weekend nor the names of its contributors
 may be used to endorse or promote products derived from this software
 without specific prior written permission.
 
 THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR
 CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


// FirePHP initialization.
//require_once ('FirePHPCore/FirePHP.class.php');
//ob_start();

/* 
 * Add a button to the editor interface.
 * Display text first.
 * Editor demo plugin has one field.
 * Field is stored in database; hard code the key.
 * Database call to process field and display.  Set up two closures for this.
 */

global $tinymce_plugin_url;
$tinymce_plugin_url = WP_PLUGIN_URL.'/demo-plugin-tinymce';


//$firephp = FirePHP::getInstance(true);
//$firephp->log('From top level...', 'From top level...');


function tinymce_plugin_init() {

    //$firephp = FirePHP::getInstance(true);
    //$firephp->log('tinymce_plugin_init', 'tinymce_plugin_init');
    
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

    //$firephp = FirePHP::getInstance(true);
    //$firephp->log('tinymce_plugin_mce_external_plugins', 'tinymce_plugin_mce_external_plugins');
    
    global $tinymce_plugin_url;
    $plugins['demo_tinymce'] = $tinymce_plugin_url.'/tinymceplugin/editor_plugin.js';
    return $plugins;
}

function tinymce_plugin_mce_buttons($buttons) {

    //$firephp = FirePHP::getInstance(true);
    //$firephp->log('tinymce_plugin_mce_buttons', 'tinymce_plugin_mce_buttons');
    
    array_push($buttons, 'demo_tinymce_button');
    return $buttons;
}

add_action('init', 'tinymce_plugin_init');
add_filter('admin_footer', 'tinymce_script_init');

?>
