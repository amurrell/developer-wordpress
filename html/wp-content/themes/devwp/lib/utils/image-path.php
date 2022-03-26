<?php

/**
 * Image Path
 *
 * Global image path to built images folder.
 */
function image_path($src, $variations = false) {
	if ($variations) {
		$var = $_GET['v'];
		if ($var && $variations[$var]) {
			$src = $variations[$var];
		}
	}
	return get_template_directory_uri() . '/assets/img/' . (isset($src) ? $src : '');
}
