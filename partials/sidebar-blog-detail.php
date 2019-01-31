<div class="card">
  <div class="card-header">
    <h3>Join 50K+ Product Managers Reading Our Newsletter</h3>
  </div>
  
  <div class="card-body">
  <iframe src="https://go.280group.com/l/50472/2018-05-08/9nd225" width="100%" height="500" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
  </div>
</div>

<ul>
  
  <?php print wp_list_categories( array('title_li'=>"Blog Categories", 'show_count'=>true)	 ); ?>
  
</ul>


<div class="recent-posts">
  
  <h3>Recent Posts</h3>
  
<?php 

$args = array(
	'numberposts' => 5,
	'exclude' => get_the_id(),
	'post_type' => 'post',
	'post_status' => 'publish'
);

$recent_posts = wp_get_recent_posts( $args);  
  
foreach ($recent_posts as $recent_post) {
  echo "<div class='recent-post'>";
  echo wp_get_attachment_image( get_post_thumbnail_id( $recent_post['ID'] ), 'blog-list');  
  echo "<a href='" . get_the_permalink( $recent_post['ID'] ) . "'>" . get_the_title($recent_post['ID']) . "</a>";
  echo "</div>";
}
  
?>
  
</div>


