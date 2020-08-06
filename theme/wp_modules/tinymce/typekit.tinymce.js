(function() {
	tinymce.create( 'tinymce.plugins.typekit', {
		init: function( ed, url ) {
			ed.onPreInit.add( function ( ed ) {
				// Get the iframe.
				var doc = ed.getDoc();

				// Create the script to inject into the header asynchronously.
				var jscript = "(function() {\n";
						jscript += "var config = {\n";
							jscript += "kitId: 'ank0brn' // YOUR TYPEKIT ID GOES HERE INSIDE THE SINGLE QUOTES.\n";
						jscript += "};";
						jscript += "var d     = false,\n";
							jscript += "tk    = document.createElement('script');\n";
						jscript += "tk.src    = '//use.typekit.net/' + config.kitId + '.js';\n";
						jscript += "tk.type   = 'text/javascript';\n";
						jscript += "tk.async  = 'true';\n";
						jscript += "tk.onload = tk.onreadystatechange = function() {\n";
							jscript += "var rs = this.readyState;\n";
							jscript += "if (d || rs && rs != 'complete' && rs != 'loaded') return;\n";
							jscript += "d = true;\n";
							jscript += "try { Typekit.load(config); } catch (e) {}\n";
						jscript += "};\n";
						jscript += "var s = document.getElementsByTagName('script')[0];\n";
							jscript += "s.parentNode.insertBefore(tk, s);\n";
					jscript += "})();";

				// Create a DOM script element and insert the code inside of it.
				var script  = doc.createElement( 'script' );
				script.type = 'text/javascript';
				script.appendChild( doc.createTextNode( jscript ) );

				// Append the srcript to the header.
				doc.getElementsByTagName( 'head' )[0].appendChild( script );
			});
		},
		getInfo: function () {
			return {
				longname:  'TypeKit',
				author:    'Golden Spiral Marketing',
				authorurl: 'https://www.goldenspiralmarketing.com',
				infourl:   'https://twitter.com/jgoldenspiralmarketing',
				version:   '1.0'
			};
		}
	});
	tinymce.PluginManager.add( 'typekit', tinymce.plugins.typekit );
})();
