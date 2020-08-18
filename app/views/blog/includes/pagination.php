<?php
if ($numberOfPosts > $postsPerPage) {
  ?>

  <div class="pagination">
   
   <?php

   if (($paginationStart * \Jade\Config::get('blog.postsPerPage', 10)) < $numberOfPosts) {
     ?>
     <a href="?start=<?php echo (($paginationStart) + 1); ?>" class="older">Older</a>
     <?php
   } else {
    echo '<span class="older">Older</span>';
  }

  ?>
  
  <span>·</span>
  
  <?php

  if (($paginationStart - 1) !== 0) {
    ?>
    <a href="?start=<?php echo ($paginationStart - 1   ); ?>" class="previous">Newer</a>
    <?php
  } else {
    echo '<span class="previous">Newer</span>';
  }

  ?>
  
</div>

<?php
}
?>