<!doctype html>
<html lang="en">
    <head>
        <meta name="google-site-verification" content="" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="description" content="Learn from your local government officials & staff about the smart, safe, and sustainable solutions working in their communities" />

        <title><?php wp_title(); ?></title>

        <?php render('/src/features/header/favicon.php'); ?>

        <?php if ($data->vue) {
          render('/src/features/footer/scripts/app.php');
        } ?>

        <!-- Add scripts -->
        <?php render('/src/features/header/scripts.php'); ?>

        <?php wp_head(); ?>

        <link href="<?= get_template_directory_uri() . '/build/css/app.css'; ?>" rel="stylesheet" />
    </head>
    <body <?php body_class(); ?>>
    <?php render('/src/features/header/scripts/gtm-body.php'); ?>
