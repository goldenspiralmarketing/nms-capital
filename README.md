<img src="theme/screenshot.png" style="width:100%;max-width:400px;display:block;margin:0 auto;">

## Requirements ##
* [Node Package Manager](https://docs.npmjs.com/getting-started/installing-node "NPM")
* [Bower](https://bower.io/ "Bower") (`$ npm -g install bower`)
* [Bower Installer](https://github.com/blittle/bower-installer "Bower Installer") (`$ npm -g install bower-installer`)
* [Gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md "Gulp") (`$ npm -g install gulp`)

---

## Getting Started  ##

Clone the repository to a client directory:

	$ git clone https://github.com/goldenspiralmarketing/wp-modules-starter-template.git [client folder name]

Remove the `.git` directory, as it points to the template repo:

	$ rm -R .git


* **Update files to be client-appropriate**

	- `README.md`
	- `header.php`
		+ update application-name meta tag
	- `theme/screenshot.png`
	- `theme/img/client.png`
	- `_sass/global/_variables.scss`
		+ colors
		+ font families
		+ base font size
	- `_sass/global/_colors.scss`
		+ add/remove ordinals
	- `_sass/style_gs.scss`
		+ add/remove vendor modules
	- `bower.json`
		+ add/remove libraries
	- `theme/wp_modules/markup.php`
		+ add/remove libraries to/from `theme_header_scripts()` and `theme_styles()`
	- `theme/wp_modules/mce.php`
		+ update brand colors in the `add_custom_palette` function


* **Install WordPress Plugins**

	- Advanced Custom Fields PRO
		+ Import `import/gs-advanced-custom-fields.json` via `Custom Fields -> Tools -> Import Field Groups` in WP Admin
	- Regenerate Thumbnails
	- Custom Post Type UI
	- WordFence Security
	- Redirection
	- Manage XML-RPC
	- Yoast SEO

* **Import Module Styleguide**

	- Install Wordpress importer via `Tools -> Import -> Wordpress`
	- Run importer and import `import/gs-modules-styleguide.xml`


Initialize a new git repo, stage all files, then make the first commit:

	$ git init
	$ git add .
	$ git commit -m 'first commit'

---

## Development Setup ##

	$ npm install

The `npm install` command will do the following:
* install any dev dependencies
* auto-run `bower install`
* auto-run `bower-installer`
* auto-build stylesheets and scripts
* begin watching the appropriate directories for any changes to stylesheets and scripts

By default, the following libraries are included via Bower:
* jQuery Validation
* GreenSock Animation Platform (GSAP)
* JS Cookie
* Twitter's Bootstrap (minimal features enabled)
	- to enable more features, modify `_sass/vendor/_bootstrap.scss`
* Magnific Popup
	- customize styles by modifying `_sass/vendor/_magnific.scss`
* Sticky Kit
	- customize styles by modifying `_sass/vendor/_stickykit.scss`
* Slick Carousel
	- customize styles by modifying `_sass/vendor/_slickcarousel.scss`

---

## Builds ##

### Sass ###

Add new `.sass` files to any `_sass/` sub-directory, then reference them in one or more of the following files:
* `_sass/style_gs.scss`
* `_sass/style_wysiwyg.scss`
* `_sass/style_ie.scss`

Output `theme/style_gs.css` (custom stylesheet)

	$ gulp css [--p||--prod||--live --min]

Output `theme/style_wysiwyg.css` (used by WP admin MCE)

	$ gulp wysiwyg [--p||--prod||--live --min]

Output `theme/style_ie.css` (Internet Explorer specific styles)

	$ gulp ie [--p||--prod||--live --min]

Output all three

	$ gulp styles [--p||--prod||--live --min]


### JavaScript ###

Add new `.js` files to `_js/`:

Output `theme/js/require.js`

	$ gulp req [--p||--prod||--live --min]

Output `theme/js/app.js`

	$ gulp js [--ftp staging --min]

Output `theme/js/*` (third-party libraries)

	$ gulp js3 [--p||--prod||--live --min]

Output all three

	$ gulp scripts [--p||--prod||--live --min]


### Build all stylesheets and scripts ###

	$ gulp build [--p||--prod||--live --min]


### Watch For Changes in stylesheets and scripts ###

	$ gulp watcher [--p||--prod||--live --min]


### Build then Watch for Changes in stylesheets and scripts ###

	$ gulp [--p||--prod||--live --min]


---

## Gulp Parameters/Flags ##

**@param** `--p||--prod||--live`

excluding this flag will add a `map` file for any `sass` that is compiled, making development easier

**@param** `--min`

will minify CSS and minify/uglify JS

**@example**

the following command will:

1) compile the specified sass files into one file (`css`),
2) minify that compiled file (`--min`),
3) add a `map` file for each compiles stylesheet

	$ gulp css --min

---

## Advisements ##

* **DO NOT modify this repository directly**

	- unless making changes to the starter template itself

* **DO NOT rename the `theme/` directory**

	- the contents of the `theme/` directory should be transferred to the appropriate theme directory on the remote server

* **STAY OUT of `functions.php`**

	- Any new WordPress hooks/actions/filters/functions should be placed in their appropriate file in `theme/wp_modules/` or just in `theme/wp_modules/custom.php`

	* **Custom Post Types**
		- Place any new CPTs in `theme/wp_modules/cpt.php`

	* **Shortcodes**
		- Place any new shortcodes in `theme/wp_modules/shortcodes.php`

	* **Widgets**
		- Place any new widgets in `theme/wp_modules/widgets.php`

---

## Accessibility Reminder ##

 - Use the correct HTML element for your content [More Info](http://accessibility.voxmedia.com/#engineers#engineers-1)
 - Support keyboard navigation [More Info](http://accessibility.voxmedia.com/#engineers#engineers-2)
 - Understand and use HTML landmarks [More Info](http://accessibility.voxmedia.com/#engineers#engineers-3)
 - Write good alt text for your images [More Info](http://accessibility.voxmedia.com/#engineers#engineers-4)
 - Design focus states to help users navigate and understand where they are [More Info](http://accessibility.voxmedia.com/#engineers#engineers-5)
 - Help users understand inputs, and help them avoid and correct mistakes [More Info](http://accessibility.voxmedia.com/#engineers#engineers-6)
 - Use ARIA attributes when applicable [More Info](http://accessibility.voxmedia.com/#engineers#engineers-7)
 - Give users a way to skip top level navigation to access main content [More Info](http://accessibility.voxmedia.com/#engineers#engineers-8)
 - Make links descriptive [More Info](http://accessibility.voxmedia.com/#engineers#engineers-9)
 - Avoid images and iconography in pseudo-elements [More Info](http://accessibility.voxmedia.com/#engineers#engineers-10)
 - Make SVGs accessible to assistive technology [More Info](http://accessibility.voxmedia.com/#engineers#engineers-11)
 - Hide decorative elements from screen readers [More Info](http://accessibility.voxmedia.com/#engineers#engineers-12)
 - Create alternate routes for users to access information [More Info](http://accessibility.voxmedia.com/#engineers#engineers-13)
 - Links should be visually identifiable and have clear :focus and :active states [More Info](http://accessibility.voxmedia.com/#engineers#engineers-14)
 - HTML document should have a language attribute [More Info](http://accessibility.voxmedia.com/#engineers#engineers-15)
