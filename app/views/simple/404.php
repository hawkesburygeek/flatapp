<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>That page couldn't be found</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="robots" content="noindex, nofollow">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/style.css" rel="stylesheet">
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
      <!--[if lt IE 9]>
      <script src="<?php echo \Jade\Config::get('site.siteRoot'); ?>assets/js/html5shiv.js"></script>
      <![endif]-->


      <?php include 'includes/analytics.php'; ?>

   </head>
   <body class="not-found">
    <div class="container">
      <?php include 'includes/header.php'; ?>


      <h1>We're sorry, that page couldn't be found</h1>


      <?php include 'includes/footer.php'; ?>
      </div>
   </body>
</html>