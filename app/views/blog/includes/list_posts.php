<?php

PageFinder::sortTreeAsc($posts);


$postCount = 0;
$numberOfPosts = count($posts);
$paginationCount = 0;

$postsPerPage = \Jade\Config::get('blog.postsPerPage');
$paginationStart = \Jade\Input::Get('start', 1);

$paginationControl = new Pagination($postsPerPage, $paginationStart, $posts);
$posts = $paginationControl->apply();


foreach($posts as $postDate => $post) {
  $postCount++;
  
  $postPage = new Page($post['path']);
  ?>

  <div class="post">
   <!--<h1><a href="?page=<?php// echo $post['path']; ?>"><?php// echo $postPage->title; ?></a></h1>-->
   <h1><a href="<?php echo $post['path']; ?>"><?php echo $postPage->title; ?></a></h1>
   <span class="post-date"><?php echo date('j F Y', $post['info']->getCTime()); ?></span>

   <?php
               //echo $postCount;
   echo \Jade\StringHelper::getFirstParagraph($postPage->content);
   ?>

  <!-- <p><a href="?page=<?php// echo $post['path']; ?>">Read More</a></p> -->
    <p><a href="<?php echo $post['path']; ?>">Read More</a></p>
 </div>

 <?php
 unset($postPage);
}

?>
