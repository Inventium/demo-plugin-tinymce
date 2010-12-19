/* TinyMCE plugin for WordPress hRecipe plug-in.
   Details on creating TinyMCE plugins at
     http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x 
*/
(function() {
// Grab the text strings to be used by hrecipe TinyMCE button
tinymce.PluginManager.requireLangPack('demo_tinymce');

tinymce.create('tinymce.plugins.demo_tinymce', {
	getInfo : function() {
		return {
			longname : 'Demo Plugin for TinyMCE',
			author : 'Dave Doolin',
			authorurl : 'http://website-in-a-weekend.net/demo-plugins',
			infourl : 'http://website-in-a-weekend.net/demo-plugins',
			version : "0.1"
		};
	},

	init : function(ed, url) {
		ed.addButton('demo_tinymce_button', {
			title : 'demo_tinymce.insertbutton',
			image : url + '/starfull.gif',
			onclick : function () {
				edInsertDemoTinyMCE();
			}
		});
	},

	createControl : function (n, cm) {
		return null;
	}

});

// Adds the plugin class to the list of available TinyMCE plugins
tinymce.PluginManager.add('demo_tinymce', tinymce.plugins.demo_tinymce);
})();
