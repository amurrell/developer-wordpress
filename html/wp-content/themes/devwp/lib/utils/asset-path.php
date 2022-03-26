<?php

function assetPath()
{
  $hotPath = get_template_directory() . '/hot';
  $hot = file_exists($hotPath);
  $hotLocal = empty($hot) ? '' : trim(file_get_contents($hotPath));
  $basePath = $hot ? $hotLocal : get_template_directory_uri();
  return $basePath;
}
