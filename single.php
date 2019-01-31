<?php
// Blog Detail page

get_header(); 
$pID = get_the_ID();
the_post();
?>

<div class="default-page blog-detail"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->

<main class="content">

  <div class="container row">
    
    <div class="col l9 s12 post-content">
      
      <h1 class="blog-title"><?php echo get_the_title(); ?></h1>
      
      <div class="post-meta">

        By: <?php echo get_the_author_meta("display_name",$post->post_author); ?> | 

        <?php echo get_the_date( "M j, Y", get_the_id() ); ?> | 

        <?php  $cat =  get_the_category( get_the_id() ) ?>

        <?php echo sprintf('<a href="%s">%s</a>',get_category_link($cat[0]->cat_ID), $cat[0]->name); ?>    

      </div>

      <?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_id() ), 'blog-detail')  ?>
      
      <div class="blog-body">
      <?php  the_content(); ?>
      </div>

      <?php
				if ( comments_open() || get_comments_number() ) :
				  comments_template();
				endif;
      ?>
      
    </div>
    
    <div class="col l3 s12 sidebar">
      <?php  get_template_part( '/partials/sidebar', 'blog-detail'); ?>
    </div>
    
  </div>

</main>

<?php
get_footer();
?>

