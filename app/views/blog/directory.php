<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title><?php echo $page->title; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $page->desc; ?>">
      <meta name="author" content="<?php echo $page->author; ?>">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/_blog/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/_blog/css/bootstrap-responsive.min.css" rel="stylesheet">
      <link href="<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/_blog/css/style.css" rel="stylesheet">
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
      <!--[if lt IE 9]>
      <script src="<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/js/html5shiv.js"></script>
      <![endif]-->


      <?php include 'includes/analytics.php'; ?>

   </head>
   <body>
    <div class="container">
      <?php include 'includes/header.php'; ?>


      <div class="container">
         <div class="row-fluid">
            <div class="span9">

                <?php
                  $pages = PageFinder::getDirectoryTree($pageURL);

                  if (count($pages) >= 1) {
                    echo  '<p class="lead">Theres no page here (yet), in the mean-time here\'s a list of files in \''.$pageURL.'\'</p>';
                    echo '<ul>';
                    foreach($pages as $pageDate => $post) {
                        $postPage = new Page($post['path']);
                        //echo '<li><a href="?page='.$post['path'].'">'.$postPage->title.'</a></li>';
                        echo '<li><a href="'.$post['path'].'">'.$postPage->title.'</a></li>';
                        unset($postPage);
                    }
                    echo '</ul>';
                  } else {
                     echo  '<p class="lead">We\'re sorry, but there isn\'t anything here yet.</p>';
                  }

             ?>

               <?php include 'includes/disqus.php'; ?>
            </div>
            <div class="span3">
               <?php
                  include 'includes/sidebar.php';
               ?>
            </div>
         </div>
      </div>

      <?php include 'includes/footer.php'; ?>
      </div>

      <script src="<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/_blog/js/jquery.js"></script>
      <script src="<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/_blog/js/bootstrap.min.js"></script>
      <script src="<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/_blog/js/jquery.backstretch.min.js"></script>
      <script>
         $(".blog-header-background").backstretch('<?php echo \Jade\Config::get('site.siteRoot'); ?>public/assets/_blog/img/header.jpg');
      </script>
   </body>
</html>
