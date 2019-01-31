<?php
  global $glide_acf_option_fields;
  global $pID;
  global $glide_acf_fields;
//  the_post();
  //Set the masthead content variables
  
  $mh_title = (is_single() && snag_field('mh_title') == "" ? get_the_title() : snag_field('mh_title'));
  $mh_subtext = snag_field('mh_subtext');  
  $mh_background = snag_field('mh_background');
  $mh_image = ""; 
  if (snag_field('mh_background_image') != "") $mh_image = snag_field('mh_background_image')['sizes']['masthead'];
    
  if (DevTests::isMobile()) $mh_image = get_field('mh_background_image', $pID)['sizes']['masthead-mobile'];
  
?>

<?php if ($mh_background == "") : ?>


<?php if(function_exists('bcn_display'))
{
    echo '<div id="breadcrumbs" class="above"><div class="container">';
    bcn_display();
    echo '</div></div>';
}?>

<?php endif; ?>

<div id="masthead" class="valign-wrapper center-align <?php if ($mh_background == "") : ?> no-background <?php else : ?> has-background <?php endif; ?> <?php if ($mh_image != "") : ?> has-image <?php endif; ?>" <? if ($mh_image!="") :?> style="background-image: url('<?php echo $mh_image;?>')"<? endif; ?>>

  <div class="overlay"></div>

  <div class="inner container <?php if (snag_field('two_column')) : ?> row <?php endif; ?>">
    
    <?php if (snag_field('two_column')) : ?>
    
      <div class="col l6 s12 left-align">
    
    <?php endif; ?>
    
    <?php if ($mh_title != "") : ?>
      <h1 class="title"><?php echo $mh_title;?></h1>
    <?php endif; ?>

    <?php $variant_id = snag_field('shopify_product'); $variant_id_decoded = substr(base64_decode( $variant_id ), strrpos(base64_decode( $variant_id ), '/') + 1);?>
    
    <?php if ($variant_id!="") : ?>
      <a href="<?php echo snag_field('shopify_page_link') ?>" class="fallback-button btn" target="_blank">Get Started</a>
      <span id="<?php echo $variant_id_decoded ?>-masthead" class="buy-button-container" data-id-variant="<?php echo $variant_id_decoded ?>"></span>
    <?php endif; ?>
    
    <?php if ($mh_subtext != "") : ?>

      <div class="subtext">

        <?php echo do_shortcode($mh_subtext);?>
        
        <?php if (get_post_type() === "courses" && snag_field('whats_included_masthead_text') != "") : ?>

<!--           <div class="mh-whats-included"><h3>What's Included</h3><?php echo snag_field('whats_included_masthead_text') ?></div> -->

        <?php endif; ?>
        
      </div>
      
    <?php endif; ?>

    <?php if (snag_field('two_column')) : ?>
    
      </div>
      
      <div class="col l6 s12">
        
      <?php echo do_shortcode(snag_field('second_column'));?>
    
      </div>
    
    <?php endif; ?>
  
  </div>
  
</div>

<?php if ($mh_background != "") : ?>

<?php if(function_exists('bcn_display'))
{
    echo '<div id="breadcrumbs"><div class="container">';
    bcn_display();
    echo '</div></div>';
}?>


<?php endif; ?>

