# BB-Button-Accordion
Use BB buttons to minimize content like an accordion

## Usage
For the snippets below, you need to define or change ZESTSMS_FUNCTIONALITY_PLUGIN_DIR and ZESTSMS_FUNCTIONALITY_PLUGIN_URL

Include the button.php extension to add the settings to the button module. This code will search the extensions folder and automatically include them.
```
function zestsms_load_custom_bb_extensions() {
	$dirs = array(
	  'extensions'
	);

	if(class_exists('FLBuilder')) {
		foreach($dirs as $dir) {
			foreach(glob( ZESTSMS_FUNCTIONALITY_PLUGIN_DIR . 'bb-plugin/' . $dir . '/*.php' ) as $file) {
				require_once $file;
			}
		}
	}
}

add_action( 'after_setup_theme', 'zestsms_load_custom_bb_extensions' );
```


Include the JS files when needed -- with the example code below, any js files that have 'frontend' in the name will be include while editing in BB. Files with 'settings' in the name are added to the global JS.
```
add_action( 'wp_enqueue_scripts', 'zestsms_enqueue_bb_scripts' );
function zestsms_enqueue_bb_scripts() {
	$dirs = array(
		'js'
	);

	if(class_exists('FLBuilder')) {
		foreach($dirs as $dir) {
			foreach(glob( ZESTSMS_FUNCTIONALITY_PLUGIN_DIR . 'bb-plugin/' . $dir . '/*.js' ) as $file) {
				$filename = basename( $file );

				if(strpos( $file, 'frontend') === false  && strpos( $file, 'settings') && FLBuilderModel::is_builder_active()) {
					wp_enqueue_script( $filename, ZESTSMS_FUNCTIONALITY_PLUGIN_URL . 'bb-plugin/' . $dir . '/'. $filename,  array('jquery'), NULL, true);
				}
			}
		}
	}
}

add_filter('fl_builder_render_js', 'zestsms_add_custom_js', 10, 4);
function zestsms_add_custom_js($js, $nodes, $global_settings, $include_global) {
	if( $include_global ) {
		$dirs = array(
			'js'
		);

		foreach ( $dirs as $dir ) {
			foreach ( glob( ZESTSMS_FUNCTIONALITY_PLUGIN_DIR . 'bb-plugin/' . $dir . '/*.js' ) as $file ) {
				if ( strpos( $file, 'frontend' ) ) {
					ob_start();
					include $file;
					$add_js = ob_get_clean();

					$js .= $add_js;
				}
			}
		}
	}

	return $js;
}
```