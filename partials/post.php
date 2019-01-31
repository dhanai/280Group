<div class="post">

  <div class="row">
    
    <div class="col l4 s12 img-wrapper">
    
      <?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_id() ), 'blog-list')  ?>
    
    </div>
    
    <div class="col l8 s12 text-wrapper">
      <h6><?php echo wp_trim_words( get_the_title(), $num_words = 18, $more = " ..." ); ;?></h6>

      <div class="post-meta">

        By: <?php echo get_the_author_meta("display_name",$post->post_author); ?> | 

        <?php echo get_the_date( "M j, Y", get_the_id() ); ?> | 

        <?php  $cat =  get_the_category( get_the_id() ) ?>

        <?php echo sprintf('<a href="%s">%s</a>',get_category_link($cat[0]->cat_ID), $cat[0]->name); ?>    

      </div>

      <div class="excerpt">

        <?php echo wp_trim_words(get_the_excerpt( $post->ID ), $num_words = 28, $more = " ...");?>

      </div>
        
      <a href="<?php echo get_the_permalink($post->ID); ?>" class="btn btn-link">Read More</a>
        
    </div>
  
  </div>

</div>
