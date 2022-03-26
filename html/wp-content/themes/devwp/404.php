<?php

get_header();

render('/src/controllers/page.php', (object) [
    'title' => '404! Oops, Not Found.',
    'content' => '',
]);

get_footer();
