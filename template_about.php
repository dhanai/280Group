<?php
/**
 * Glide Theme Page
 *
 * Template Name: About
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>
<div class="about-page"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<section class="content">
    
  <section id="intro">
    <div class="container center-align">
        <h2><?php print snag_field('intro_title'); ?></h2>
        <div class="copy"><?php print snag_field('intro_copy'); ?></div>
    </div>
  </section>
  
  <?php $stats = snag_field('about_stats')['stats']; ?>
  
  <?php if ($stats != "") : ?>
  
    <section id="stats" class="container row">
      <?php foreach ($stats as $stat) : ?>
        <div class="col l4 s12 center-align stat">
          <b><?php print $stat['stat'] ?></b>
          <?php print $stat['description'] ?>
        </div>
      <?php endforeach; ?>
    </section>  
  
  <?php endif; ?>
  
  <section id="difference">
    <div class="container">
        <h2 class="center-align"><?php print snag_field('difference_title'); ?></h2>
        <div class="copy"><?php print snag_field('difference_copy'); ?></div>
    </div>
  </section>
  
  <section id="clients" class="center-align">
    <div class="container">
      <h2 class="center-align"><?php echo snag_field('clients_title'); ?></h2>
      <?php 
        $item['clients_list'] = snag_field('clients'); 
      ?>
      
      <?php  get_template_part( '/partials/element-clients'); ?>
      <div><?php echo build_acf_button(snag_field('clients_button'), 'btn'); ?></div>
    </div>    
  </section>
  
  <section id="video" class="center-align">
    <div class="container">
      <h2><?php echo snag_field('video_title'); ?></h2>
      <?php echo snag_field('video') ?>
      
    </div>    
  </section>
  
  <section id="products" class="center-align">
    <div class="container">
      <h2><?php echo snag_field('products_title'); ?></h2>
      
      <?php $products = snag_field('products'); ?>
      
      <?php if ($products != "") : ?>

      <div class="scroller-products">
      <?php foreach ( $products as $row) : ?>

        <?php 
          $img_id = get_the_post_thumbnail_url($row->ID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($row->ID)) : "";
          $image = wp_get_attachment_image($img_id, 'medium');        
        ?>

        <article class="product"><a href="<?php echo get_the_permalink( $row->ID ) ?>"><?php echo $image; ?></a></article>
        
      <?php endforeach; ?>
      </div>
      <div class="controls controls-products">
        <span class="prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
        <span class="next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
      </div>
      <?php endif; ?>
      
      
    </div>    
  </section>
  
  <section id="awards" class="center-align">
    
    <div class="container">
    
    <h2><?php echo snag_field('awards_title'); ?></h2>
    
    <?php $awards = snag_field('awards'); ?>
    <?php if ($awards != "") : ?>
    
      <?php foreach ($awards as $award) : ?>
        <?php 
          $icon_id = glide_get_image_id($award['image']['url']);
          $icon = wp_get_attachment_image($icon_id, 'award-logo');
        ?>      
        <span class="image-wrapper">
          <?php echo $icon; ?>
          <p><?php echo $award['title'] ?></p>
        </span>
      <?php endforeach; ?>
    <?php endif; ?>
    
    </div>
    
  </section>  
 
</section>

<?php
get_footer();
?>