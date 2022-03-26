<?php

function is_noindexfollow() {

  // Particular Query Data
  $noindex_params = [
  ];
  if (!empty(array_intersect(array_keys($_GET), $noindex_params))) {
      return true;
  }

  // Regex Pattern match on URI
  $noindex_regexes = [
    //   '/your-path/(option1|option2)/*',
    //   '/oauth/*'
  ];

  $regex = '#'.implode('|', $noindex_regexes).'#';

  if (preg_match($regex, $_SERVER['REQUEST_URI'])) {
      return true;
  }

  $noindex_pages = []; // PAGES - use slug names
  $noindex_singles = []; // POSTS - can be ids or slugs
  return is_page($noindex_pages)
      || is_single($noindex_singles);
}

/*
 * Filter for pages that need noindex, follow
 */
add_filter('wp_head', function() {

   if (is_noindexfollow()) {
       echo '<meta name="robots" content="noindex, follow"/>' . "\n";
   }

}, 0);
