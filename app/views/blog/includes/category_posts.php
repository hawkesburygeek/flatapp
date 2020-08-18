<h1>Categories</h1>
<ul class="category-listing">
<?php
foreach($categories->getCategories() as $k => $category) {
	//echo '<li><a href="?page=category&name='.$category.'">'.$category.'</a></li>';
    echo '<li><a href="category/'.$category.'">'.$category.'</a></li>';
}
?>
</ul>

<?php
$categoryPosts = new \MetaSearcher('posts/');
$categoryResults = $categoryPosts->searchOn('categories', \Jade\Input::get('name'));
?>
<p class="lead"><?php echo \Jade\Input::get('name', '').' ('.count($categoryResults).' posts)'; ?></p>
<?php
foreach($categoryResults as $postDate => $post) {
  $categoryPage = new \Page($post);
	  ?>
	  <div class="post category-post">
	   <!--<h1><a href="?page=<?php// echo $post; ?>"><?php// echo $categoryPage->title; ?></a></h1>-->
       <h1><a href="<?php echo $post; ?>"><?php echo $categoryPage->title; ?></a></h1>
	   <span class="post-date"><?php echo date('j F Y', $categoryPage->getFile()->getCTime()); ?></span>

	   <?php
	               //echo $postCount;
	   echo \Jade\StringHelper::getFirstParagraph($categoryPage->content);
	   ?>

	   <p><a href="?page=<?php echo $post; ?>">Read More</a></p>

	 </div>

	 <?php
	 unset($categoryPage);
  
}
unset($categoryPosts);
