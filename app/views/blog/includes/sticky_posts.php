<?php

$ms = new \MetaSearcher('posts/');
$results = $ms->searchOn('sticky', 'true');
$stickyCount = 0;
foreach($results as $postDate => $post) {
  $stickyCount++;
  $stickyPage = new \Page($post);
  if ($stickyCount < \Jade\Config::get('blog.stickyPostCount', 2)) {
	  ?>
	  <div class="post sticky-post">
	   <h1><a href="?page=<?php echo $post; ?>"><?php echo $stickyPage->title; ?></a></h1>
	   <span class="post-date"><?php echo date('j F Y', $stickyPage->getFile()->getCTime()); ?></span>

	   <?php
	               //echo $postCount;
	   echo \Jade\StringHelper::getFirstParagraph($stickyPage->content);
	   ?>

	   <p><a href="?page=<?php echo $post; ?>">Read More</a></p>

	 </div>

	 <?php
	 unset($stickyPage);
	 $stickyCount++;
  }
}
unset($ms);