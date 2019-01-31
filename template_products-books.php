<?php
/**
 * Glide Theme Template
 *
 * Template Name: Products - Books
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>

<div class="products-list books"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php  get_template_part( '/partials/masthead'); ?>

<main class="content">
  
  <?php
    // Get the Products
    $args = array(
      'post_type' => 'products',
      'meta_key'		=> 'type',
    	'meta_value'	=> 'book'
    );
    
    $products = array();
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) : 
      while ( $query->have_posts() ) : $query->the_post();
        $fields = get_fields(get_the_ID());
        $fields['id'] = get_the_ID();
        $fields['title'] = get_the_title();
        $fields['link'] = get_permalink();
        array_push( $products, $fields );
      endwhile;
    endif;
  ?>
  


  <section class="prod-list center-align">
    <div class="row">
      <?php  foreach ($products as $product) : ?>
          <div class="col l6 s12 product-wrapper">
            <div class="product row">
                <div class="col l5 image-wrapper">
                  <?php
                  $image_1 = get_the_post_thumbnail_url($product['id']);
                    /*$img_id = get_the_post_thumbnail_url($product['id'])!="" ? glide_get_image_id(get_the_post_thumbnail_url($product['id'])) : "";
                    $image = wp_get_attachment_image($img_id, 'product-detail');*/
                  ?>
                  
                  <?php //echo $image; ?>
                  <?php echo '<img src="'.$image_1.'">'; ?>
                </div>
                <div class="col l7">
                  <h3><?php echo $product['title'] ?></h3>
                  <div><?php echo $product['short_description']; ?></div>
                  <a href="<?php echo get_the_permalink($product['id']) ?>" class="btn">View Details</a>
                </div>
            </div>
          </div>
      <?php endforeach; ?>
    </div>
  </section>
  

</main>

<?php
get_footer();
?>
