<!doctype html>
<html lang="en">

<head>
  <meta name="google-site-verification" content="" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="description" content="Learn from your local government officials & staff about the smart, safe, and sustainable solutions working in their communities" />

  <title><?php wp_title(); ?></title>

  <?php render('/src/templates/header/favicon.php'); ?>

  <!-- Add scripts -->
  <?php render('/src/templates/header/scripts.php'); ?>

  <?php wp_head(); ?>

  <?php render('/src/templates/header/css.php'); ?>
</head>

<body <?php body_class(); ?>>
  <?php render('/src/templates/header/scripts/gtm-body.php'); ?>
