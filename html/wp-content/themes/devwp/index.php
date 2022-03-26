<?php

// force 404 for things falling back to index.
// create actual templates for everything.
// ie. front-page.php, single.php, page.php, archive.php etc

global $wp_query;

$wp_query->set_404();
status_header( 404 );
nocache_headers();
include( get_query_template( '404' ) );
die();
