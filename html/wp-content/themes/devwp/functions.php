<?php
$path = get_template_directory();

$lib_includes = [
    '/lib/setup.php',
    '/lib/utils/render.php',
	'/lib/utils/dev-funcs.php',
	'/lib/utils/image-path.php',
	'/lib/utils/site-settings.php',
	'/lib/utils/meta-no-index.php',
	'/lib/utils/get-ip.php',
];

foreach ($lib_includes as $helper) {
	require_once $path . $helper;
}
