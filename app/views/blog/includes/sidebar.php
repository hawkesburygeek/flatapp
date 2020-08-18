<?php
	$categories = new \CategoryFinder('posts/');
?>
<div class="categories">
<h3>Categories</h3>
	<ul>
	<?php
		foreach($categories->getCategories() as $k => $category) {
			//echo '<li><a href="?page=category&name='.$category.'">'.$category.'</a></li>';
            echo '<li><a href="/category/'.$category.'">'.$category.'</a></li>';
		}
	?>
	</ul>
</div>
<?php

$recentPosts = PageFinder::getDirectoryTree('/posts/');

?>
<div class="recent-posts">
<h3>Recent Posts</h3>
	<ul>
		<?php
			$counter = 1;
			foreach($recentPosts as $key => $value) {
				if ($counter <= \Jade\Config::get('blog.recentPostCount')) {
					$page = new \Page($value['path']);
					//echo '<li><a href="?page='.$value['path'].'">'.$page->title.'</a></li>';
					echo '<li><a href="' .$value['path'].'">'.$page->title.'</a></li>';
					unset($page);
					$counter++;
				}
			}

		?>
	</ul>
</div>
<?php
unset($recentPosts);
?>
