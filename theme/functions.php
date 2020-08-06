<?php
/*------------------------------------*\
	Set Module Directory
\*------------------------------------*/
define('MODULE_DIR', 'wp_modules');

/*------------------------------------*\
	Advanced Custom Fields Support
\*------------------------------------*/
include MODULE_DIR . '/acf.php';

/*------------------------------------*\
	Custom Post Types/Taxonomies
\*------------------------------------*/
include MODULE_DIR . '/cpt.php';

/*------------------------------------*\
	Wordpress MCE Support
\*------------------------------------*/
include MODULE_DIR . '/mce.php';

/*------------------------------------*\
	Duplicate Posts Support
\*------------------------------------*/
include MODULE_DIR . '/dup.php';

/*------------------------------------*\
	ShortCode Support
\*------------------------------------*/
include MODULE_DIR . '/shortcodes.php';

/*------------------------------------*\
    Theme Support
\*------------------------------------*/
include MODULE_DIR . '/theme.php';

/*------------------------------------*\
	Widget Support
\*------------------------------------*/
include MODULE_DIR . '/widgets.php';

/*------------------------------------*\
	Excerpt Support
\*------------------------------------*/
include MODULE_DIR . '/excerpts.php';

/*------------------------------------*\
	WP Admin Support
\*------------------------------------*/
include MODULE_DIR . '/admin.php';

/*------------------------------------*\
	Site/Markup Support
\*------------------------------------*/
include MODULE_DIR . '/markup.php';

/*------------------------------------*\
	Deprecated
\*------------------------------------*/
include MODULE_DIR . '/deprecated.php';

/*------------------------------------*\
	Other Custom Support
\*------------------------------------*/
include MODULE_DIR . '/custom.php';
?>
