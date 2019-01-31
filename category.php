<?php
get_header(); 
global $glide_acf_option_fields;
global $pID;
global $glide_acf_fields;

?>


<div class="default-page blog-list"><!-- PAGE IDENTIFIER TAG -->


<section id="masthead" class="blog-masthead no-background center-align">
  
  <h1><?php echo snag_field('mh_title') ?></h1>
  
  
  <?php
  $category = get_the_category();
  $args = array(
      'numberposts' => 1,
      'category' => $category[0]->term_id,
  	  'post_status' => 'publish',
  );
  
  $recent_post = wp_get_recent_posts( $args);
  ?>
  
  
  <?php  $featured_post = snag_field('mh_featured_post')[0]; ?>

  <div class="post container">

    <div class="row">

      <div class="col l6 img-wrapper">

        <?php echo wp_get_attachment_image( get_post_thumbnail_id( $recent_post[0]['ID'] ), 'blog-list-large')  ?>

      </div>

      <div class="col l6 left-align text-wrapper">

        <h6><?php echo wp_trim_words( get_the_title( $recent_post[0]['ID'] ), $num_words = 18, $more = " ..." );?></h6>

        <div class="post-meta">

          By: <?php echo get_the_author_meta("display_name",$recent_post[0]['post_author']); ?> | 

          <?php echo get_the_date( "M j, Y", get_the_id($recent_post[0]['ID']) ); ?>

          <?php  $cat =  get_the_category( get_the_id($recent_post[0]['ID']) ) ?><br>

          <?php echo sprintf('<a href="%s">%s</a>',get_category_link($cat[0]->cat_ID), $cat[0]->name); ?>

        </div>

        <div class="excerpt">

          <?php echo wp_trim_words(get_the_excerpt( $recent_post[0]['ID'] ), $num_words = 40, $more = " ...");?>

        </div>
        
        <a href="<?php echo get_the_permalink($recent_post[0]['ID']); ?>" class="btn btn-link">Read More</a>

      </div>

    </div>

  </div>  

</section>

<main class="content container row">

  <div class="col l9 post-list">

    <h2>The Latest</h2>

    <div id="posts-container">
  
      <?php
  			if ( have_posts() ) :
  				// Start the Loop.
  				while ( have_posts() ) : the_post();
  				
  				  if ($post->ID == $recent_post[0]['ID']) continue;
  				
  					get_template_part( 'partials/post');
  				endwhile;
  			endif;
  		?>
  
  
    </div>  
    
    <?php load_more_button(); ?>
 
  </div>
  
  <div class="col l3 sidebar">

    <?php  get_template_part( '/partials/sidebar', 'blog'); ?>

  </div>
  
</main>

<?php
  
  wp_reset_query();   
get_footer();
?>


<!-- TODO: JLM - Move slider script to main file -->