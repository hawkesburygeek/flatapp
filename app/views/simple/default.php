<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title><?php echo $page->title; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $page->desc; ?>">
      <meta name="author" content="<?php echo $page->author; ?>">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/style.css" rel="stylesheet">
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
      <!--[if lt IE 9]>
      <script src="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/js/html5shiv.js"></script>
      <![endif]-->

      <?php include 'includes/analytics.php'; ?>

   </head>
   <body>
    <div class="container">
      <?php include 'includes/header.php'; ?>


      <h1><?php echo $page->title; ?></h1>

      <?php
        
        echo $page->content;

      ?>

      <?php include 'includes/disqus.php'; ?>

      <?php include 'includes/footer.php'; ?>
      </div>
   </body>
</html>