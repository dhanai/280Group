<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: Toolkit Template
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;
global $glide_acf_fields;

$page_content = snag_field('toolkit_page_content');

?>




<div class="toolkit-page"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<main class="content <?php if ($mh_background == "") : ?> no-background <?php else : ?> has-background <?php endif; ?>">


  <?php if ($page_content != "") : ?>
    <?php foreach ($page_content as $section) : ?>
    
      <section  class="section <?php echo $section['section_background'] ?> bottom-border-<?php echo $section['bottom_border'] ?>">
        
        <div class="container">
          <?php if ($section['title'] != "") : ?>
            <h2 class="section-title"><?php echo $section['title'] ?></h2>
          <?php endif; ?>
          
          <?php if ($section['toolkit_elements'] != "") : ?>
          
            <?php foreach ($section['toolkit_elements'] as $element) : ?>
  
              <?php 
                global $item; 
                global $include_controls;
                $item = $element;
                $include_controls = true;
              ?>
  
              <div class="detail-element <?php print $element['acf_fc_layout'] ?>">
                
                <?php  get_template_part( '/partials/element', $element['acf_fc_layout']); ?>
              
              </div>
  
            <?php endforeach; ?>
          
          <?php endif; ?>          
          
        </div>
        
      </section>

    <?php endforeach; ?>
  <?php endif; ?>
</main>
<?php get_footer(); ?>

<Script>
$(document).ready(function(){
   
});    
</script>

