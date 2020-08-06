const { series, parallel, src, dest, watch }	= require( 'gulp' ),
	sass		= require( 'gulp-sass' ),
	sass_glob	= require( 'gulp-sass-glob' ),
	babel		= require( 'gulp-babel' ),
	srcmap		= require( 'gulp-sourcemaps' ),
	autopre		= require( 'gulp-autoprefixer' ),
	cleancss	= require( 'gulp-clean-css' ),
	concat		= require( 'gulp-concat' ),
	insert		= require( 'gulp-insert' ),
	uglify		= require( 'gulp-uglify' ),
	plumber		= require( 'gulp-plumber' ),
	notify		= require( 'gulp-notify' ),
	util		= require( 'gulp-util' ),
	gif			= require( 'gulp-if' );

const RESET		= "\x1b[0m",
	BRIGHT		= "\x1b[1m",
	DIM			= "\x1b[2m",
	UNDERSCORE	= "\x1b[4m",
	BLINK		= "\x1b[5m",
	REVERSE		= "\x1b[7m",
	HIDDEN		= "\x1b[8m",
// foreground
	FGBLACK		= "\x1b[30m",
	FGRED		= "\x1b[31m",
	FGGREEN		= "\x1b[32m",
	FGYELLOW	= "\x1b[33m",
	FGBLUE		= "\x1b[34m",
	FGMAGENTA	= "\x1b[35m",
	FGCYAN		= "\x1b[36m",
	FGWHITE		= "\x1b[37m",
// bright foreground
	FGBBLACK	= "\x1b[90m",
	FGBRED		= "\x1b[91m",
	FGBGREEN	= "\x1b[92m",
	FGBYELLOW	= "\x1b[93m",
	FGBBLUE		= "\x1b[94m",
	FGBMAGENTA	= "\x1b[95m",
	FGBCYAN		= "\x1b[96m",
	FGBWHITE	= "\x1b[97m",
// background
	BGBLACK		= "\x1b[40m",
	BGRED		= "\x1b[41m",
	BGGREEN		= "\x1b[42m",
	BGYELLOW	= "\x1b[43m",
	BGBLUE		= "\x1b[44m",
	BGMAGENTA	= "\x1b[45m",
	BGCYAN		= "\x1b[46m",
	BGWHITE		= "\x1b[47m",
// bright background
	BGBBLACK	= "\x1b[100m",
	BGBRED		= "\x1b[101m",
	BGBGREEN	= "\x1b[102m",
	BGBYELLOW	= "\x1b[103m",
	BGBBLUE		= "\x1b[104m",
	BGBMAGENTA	= "\x1b[105m",
	BGBCYAN		= "\x1b[106m",
	BGBWHITE	= "\x1b[107m";

const error_handler = {
	errorHandler: notify.onError( {
		title: 'Gulp',
		message: 'Error: <%= error.message %>'
	} )
};

const build_stylesheet_header = ( data ) => {
	var header = '/*\n';
	for ( var prop in data ) {
		if ( ! data.hasOwnProperty( prop ) ) continue;
		if ( data[prop] !== '' ) {
			header += '\t' + prop + ': ' + data[prop] + '\n';
		}
	}
	header += '*/\n';
	return header;
};

const build_css = ( cb ) => {
	let args = util.env;

	try {
		src( '_sass/style_gs.scss' )
			.pipe( plumber( error_handler ) )
			.pipe( gif( ! args.p && ! args.prod && ! args.live, srcmap.init() ))
			.pipe( sass_glob() )
			.pipe( sass() )
			.pipe( autopre() )
			.pipe( gif( args.min, cleancss( { compatibility: 'ie8' } ) ) )
			.pipe( insert.prepend( build_stylesheet_header( { 'Stylesheet': 'Golden Spiral Custom' } ) ))
			.pipe( gif( ! args.p && ! args.prod && ! args.live, srcmap.write( '/' ) ) )
			.pipe( dest( 'theme' ) );

		cb();
	} catch ( ex ) {
		cb( new Error ( ex.message ) );
	// } finally {
	}
};
const css = series( build_css );
exports.css = css;

const build_wysiwyg = ( cb ) => {
	let args = util.env;

	try {
		src( '_sass/style_wysiwyg.scss' )
			.pipe( plumber( error_handler ) )
			.pipe( gif( ! args.p && ! args.prod && ! args.live, srcmap.init() ))
			.pipe( sass_glob() )
			.pipe( sass() )
			.pipe( autopre() )
			.pipe( gif( args.min, cleancss( { compatibility: 'ie8' } ) ) )
			.pipe( insert.prepend( build_stylesheet_header( { 'Stylesheet': 'WYSIWYG' } ) ))
			.pipe( gif( ! args.p && ! args.prod && ! args.live, srcmap.write( '/' ) ) )
			.pipe( dest( 'theme' ) );

		cb();
	} catch ( ex ) {
		cb( new Error ( ex.message ) );
	// } finally {
	}
};
const wysiwyg = series( build_wysiwyg );
exports.wysiwyg = wysiwyg;

const build_ie = ( cb ) => {
	let args = util.env;

	try {
		src( '_sass/style_ie.scss' )
			.pipe( plumber( error_handler ) )
			.pipe( gif( ! args.p && ! args.prod && ! args.live, srcmap.init() ))
			.pipe( sass_glob() )
			.pipe( sass() )
			.pipe( autopre() )
			.pipe( gif( args.min, cleancss( { compatibility: 'ie8' } ) ) )
			.pipe( insert.prepend( build_stylesheet_header( { 'Stylesheet': 'IE/Edge' } ) ))
			.pipe( gif( ! args.p && ! args.prod && ! args.live, srcmap.write( '/' ) ) )
			.pipe( dest( 'theme' ) );

		cb();
	} catch ( ex ) {
		cb( new Error ( ex.message ) );
	// } finally {
	}
};
const ie = series( build_ie );
exports.ie = ie;

const build_js = ( cb ) => {
	let args = util.env;

	try {
		src( [
			// '_js/app.js',
			// '_js/global.js',
			// '_js/entry.js',
			// '_js/main.js',
			// '_js/transition.js',
			'_js/*.js'
		] )
			.pipe( plumber( error_handler ) )
			.pipe( gif( args.min, srcmap.init() ))
			.pipe( babel( { presets: ['@babel/preset-env'] } ) )
			.pipe( concat( 'app.js' ) )
			.pipe( gif( args.min, uglify() ) )
			.pipe( gif( args.min, srcmap.write( '/' ) ) )
			.pipe( dest( 'theme/js' ) );

		cb();
	} catch ( ex ) {
		cb( new Error ( ex.message ) );
	// } finally {
	}
};
const js = series( build_js );
exports.js = js;

const build_require = ( cb ) => {
	let args = util.env;

	try {
		src( '_lib/js/requirejs/require.js' )
			.pipe( plumber( error_handler ) )
			.pipe( concat( 'require.js' ) )
			.pipe( gif( args.min, uglify() ) )
			.pipe( dest( 'theme/js' ) );

		cb();
	} catch ( ex ) {
		cb( new Error ( ex.message ) );
	// } finally {
	}
};
const req = series( build_require );
exports.req = req;

const build_js3 = ( cb ) => {
	let args = util.env;

	try {
		src( [
			'_lib/js/**/*.js',
			'_js3/**/*.js',
			'!_lib/js/requirejs/*.js'
		] )
			.pipe( plumber( error_handler ) )
			.pipe( gif( args.min, uglify() ) )
			.pipe( dest( 'theme/js' ) );

		cb();
	} catch ( ex ) {
		cb( new Error ( ex.message ) );
	// } finally {
	}
};
const js3 = series( build_js3 );
exports.js3 = js3;

const watch_log = ( path, stats ) => {
	let dt = new Date(),
		evt = '';

	if ( ! stats ) {
		evt = 'Deleting';
	} else {
		if ( stats.birthtimeMs === stats.ctimeMs ) {
			evt = 'Adding  ';
		} else {
			evt = 'Changing';
		}
	}

	let time = ( '0' + dt.getHours() ).slice( -2 ) + ':' + ( '0' + dt.getMinutes() ).slice( -2 ) + ':' + ( '0' + dt.getSeconds() ).slice( -2 );

	console.log( `[${FGBBLACK}${time}${RESET}] ${FGRED}${evt}${RESET} file ${FGGREEN}'${path}'${RESET}` );
};

const watcher = ( cb ) => {
	let opts = { alwaysStat: true };

	let watcher_css = watch( '_sass/**/*.scss', opts, css );
		watcher_css.on( 'change',	watch_log );
		watcher_css.on( 'add',		watch_log );
		watcher_css.on( 'unlink',	watch_log );

	let watcher_js = watch( '_js/*.js', opts, js );
		watcher_js.on( 'change',	watch_log );
		watcher_js.on( 'add',		watch_log );
		watcher_js.on( 'unlink',	watch_log );

	let watcher_req = watch( '_lib/js/requirejs/require.js', opts, js );
		watcher_req.on( 'change',	watch_log );
		watcher_req.on( 'add',		watch_log );
		watcher_req.on( 'unlink',	watch_log );

	let watcher_js3 = watch( ['_lib/js/**/*.js', '_js3/**/*.js', '!_lib/js/requirejs/*.js'], opts, js );
		watcher_js3.on( 'change',	watch_log );
		watcher_js3.on( 'add',		watch_log );
		watcher_js3.on( 'unlink',	watch_log );

	cb();
};

exports.scripts	= series( req, js, js3 );
exports.styles	= series( css, wysiwyg, ie );
exports.build	= series( css, wysiwyg, ie, req, js, js3 );
exports.watcher	= watcher;
exports.default	= series( css, wysiwyg, ie, req, js, js3, watcher );
