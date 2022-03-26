<?php
/**********************************************************
 * loads the plugins in the this directory
 * since Wordpress will not look in subdirectories
 *********************************************************/
foreach (scandir(WPMU_PLUGIN_DIR) as $dir) {
    $base = WPMU_PLUGIN_DIR . '/' . $dir . '/' . $dir;

    if (!file_exists($loadFile = $base . '.php')) {
        $loadFile = $base . '-loader.php';
    }

    if (file_exists($loadFile)) {
        require $loadFile;
    }
}
