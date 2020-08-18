<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title><?php echo \Jade\Config::get('site.name', ''); ?> | <?php echo $pageURL; ?></title>
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
   <body>
    <div class="container">
      <?php include 'includes/header.php'; ?>


     <div class="row-fluid">
         <div class="span12">

             <?php
                  $pages = PageFinder::getDirectoryTree($pageURL);

                  if (count($pages) >= 1) {
                    echo  '<p class="lead">Theres no page here (yet), in the mean-time here\'s a list of files in \''.$pageURL.'\'</p>';
                    echo '<ul>';
                    foreach($pages as $pageDate => $post) {
                        $postPage = new Page($post['path']);
                        echo '<li><a href="?page='.$post['path'].'">'.$postPage->title.'</a></li>';
                        unset($postPage);
                    }
                    echo '</ul>';
                  } else {
                     echo  '<p class="lead">We\'re sorry, but there isn\'t anything here yet.</p>';
                  }

             ?>

         </div>
     </div>


      <?php include 'includes/footer.php'; ?>
      </div>
   </body>
</html>