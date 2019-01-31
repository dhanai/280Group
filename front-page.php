<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: Homepage
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>
<div class="homepage"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead-home.php')); ?>

<main class="content">
  
  <?php $stats = snag_field('stats'); ?>
  <?php if ($stats != "") : ?>
  
    <section id="stats" class="container row">
      
      <?php foreach ($stats as $stat) : ?>
      
        <div class="col l4 m4 s12 center-align stat">
      
          <b><?php print $stat['stat'] ?></b>
      
          <?php print $stat['description'] ?>
      
        </div>
      
      <?php endforeach; ?>

    </section>  
  
  <?php endif; ?>
  
  <section id="intro">
    
    <div class="container row valign-wrapper">

      <div class="col l6 s12">

        <h2><?php print snag_field('intro_headline'); ?></h2>

        <div class="copy"><?php print snag_field('intro_copy'); ?></div>

        <?php print build_acf_button(snag_field('intro_link'), 'btn'); ?>

      </div>
      
      <div class="col l6 s12">
        
        <div class="img-wrapper">

          <a href="<?php echo snag_field('intro_link')['url'] ?>">

            <?php echo wp_get_attachment_image( snag_field('intro_image')['id'], 'large')  ?>
          
          </a>

        </div>
      </div>

    </div>
    
  </section>
  
  <section id="clients" class="center-align">

    <div class="container">

      <h2><?php echo snag_field('clients_title'); ?></h2>

      <?php 
        $item['clients_list'] = snag_field('clients'); 
      ?>
      
      <?php  get_template_part( '/partials/element-clients'); ?>

      <div><?php echo build_acf_button(snag_field('clients_link'), 'btn'); ?></div>

    </div>    

  </section>
  
  <section id="training_options">

    <div class="container">

    <h2><?php echo snag_field('training_title'); ?></h2>
    
    <?php $cards = snag_field("training_cards"); ?>

    <?php if ($cards != "") : ?>

      <div class="row">    

      <?php foreach ($cards as $card) : ?>

        <div class="col l4 s12 m12">

          <div class="card">

            <div class="card-content">
    
              <div class="img-wrapper valign-wrapper"><?php echo wp_get_attachment_image( $card['group1']['card_icon']['id'], 'xlarge')  ?></div>

              <h3 class="card-title"><?php echo $card['group1']['card_title'] ?></h3>

              <p><?php echo $card['card_copy'] ?></p>
              
            </div>

            <div class="card-action center-align valign-wrapper">

              <?php echo build_acf_button($card['group1']['card_link'], 'btn'); ?>

            </div>

          </div>

        </div>

      <?php endforeach; ?>

    </div>
      
    <?php endif; ?>
    
    </div>
    
  </section>  
  
  <section id="testimonials">
    
    <div class="container row">
    
    <?php
      global $item; 
      $item['testimonials'] = snag_field('testimonials');
    ?>
    
      <div class="col l9 offset-l2 s12">
    
        <?php  get_template_part( '/partials/element', 'testimonial_multiple'); ?>
    
      </div>
    
    </div>

  </section>    
  
  <section id="product-listing">
    
    <div class="container row">
    
      <div class="col l5 m12 s12">
        
        <div class="img-wrapper">
          
          <a href="<?php echo snag_field('product_link')['url'] ?>">  
          
          <?php echo wp_get_attachment_image( snag_field('product_image')['id'], 'large')  ?>
          
          </a>
          
        </div>

      </div>
    
      <div class="col l7 m12 s12">
    
        <h2><?php echo snag_field('product_title'); ?></h2>
    
        <p><?php echo snag_field('product_copy'); ?></p>
    
        <?php echo build_acf_button(snag_field('product_link'), 'btn'); ?>
    
    </div>
    
    </div>
    
  </section>  
  
</main>

<?php
get_footer();
?>

