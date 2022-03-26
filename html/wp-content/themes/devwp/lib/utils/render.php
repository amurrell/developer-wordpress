<?php

/**
 * Renderer
 */
function render($templatePath, $data = [], $returnHtml = false)
{
    if ($data) {
        $data = (object) $data;
    }

    if ($returnHtml) {
        ob_start();
    }

    include get_template_directory() . $templatePath;

    if ($returnHtml) {
        return ob_get_clean();
    }
}
