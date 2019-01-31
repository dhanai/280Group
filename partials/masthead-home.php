<?php
  global $glide_acf_option_fields;
  global $pID;
  global $glide_acf_fields;

  //Set the masthead content variables
  
  $mh_title = (is_single() ? get_the_title() : snag_field('mh_title'));
  $mh_subtext = snag_field('mh_subtext');  
  $mh_button_text = snag_field('mh_button_text');
  $mh_button_link = snag_field('mh_button_link');
  
  $mh_video = snag_field('mh_video');
  
  $mh_image = (is_single() ? wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), "masthead" )[0] : get_field('mh_background_image', $pID)['sizes']['masthead']);
  
    
  if (DevTests::isMobile()) $mh_image = get_field('mh_background_image', $pID)['sizes']['masthead-mobile'];
  
?>


<div id="masthead" class="home-masthead valign-wrapper center-align" <? if ($mh_image!="") :?> style="background-image: url('<?=$mh_image;?>')"<? endif; ?>>

  <div class="overlay"></div>

  <div class="inner container row">
    
    <div class="col l7 m 6 valign-wrapper">
      
      <?php if ($mh_title != "") : ?>
      
        <h1 class="title"><?php echo $mh_title;?></h1>
        
      <?php endif; ?>
      
    </div>
  
  </div>
  
  <?php $blurbs = snag_field('mh_blurbs'); ?>
  
  <?php if ($blurbs != "") : ?>
  
    <div class="blurbs-container">
      
      <?php $i = 1; ?>
      
      <?php foreach ($blurbs as $blurb) : ?>

        <?php 
          $modal = "";
          if ($i==1) { $modal = "modal-link-minimal" ;}
        ?>
      
        <a href="<?php echo $blurb['link']['url'] ?>" class="blurb valign-wrapper <?php echo $modal ?>">
          
          <div class="icon-container">
            
            <div class="wrapper valign-wrapper">
              
              <img src="<?php print $blurb['icon']['sizes']['masthead-home-icon'] ?>">
              
            </div>
            
          </div>
          
          <div class="inner">
  
            <h3><?php print $blurb['title'] ?></h3>
            
            <p><?php print $blurb['copy'] ?></p>
            
            <span class="btn btn-link"><?php echo $blurb['link']['title'] ?></span>
            
            <?php //print build_acf_button($blurb['link'], 'btn btn-link '. $modal) ?>
            
          </div>
        
      </a>
      
      <?php $i++; ?>
      
      <?php endforeach; ?>
      
    </div>  
  
  <?php endif; ?>
  
</div>
