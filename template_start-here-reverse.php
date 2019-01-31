<?php
/**
 * Glide Theme Page
 *
 * Template Name: Start Here - Reversed
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>
<div class="start-here"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<section class="content">
 
  <section id="link-list" class="center-align">
 
    <h2 class="center-align"><?php print snag_field('links_list_title'); ?></h2>  
 
    <div class="subtitle"><?php print snag_field('links_list_subtitle'); ?></div>  
 
    <div class="container row">
      
      <?php if (snag_field('links_list')) : ?>
      
        <?php foreach ( snag_field('links_list') as $link) : ?>

          <div class="col l6 m6 s12 link-item">
            
            <?php 
              $icon_id = glide_get_image_id($link['icon']['url']);
              $icon = wp_get_attachment_image($icon_id, 'icon-small');
            ?>
           
            <div class="img-wrapper valign-wrapper">
           
              <?php echo $icon ?>
           
            </div>
            
            <h3><?php echo $link['title']; ?></h3>
           
            <p><?php echo $link['copy']; ?></p>
           
            <?php echo build_acf_button($link['button'],'btn btn-link'); ?>
            
          </div>  

        <?php endforeach; ?>
        
      
      <?php endif; ?>
      
      
      
    </div>
  </section>    

  <?php $table = snag_field('comparison_table'); ?>
  
  <?php if ($table['comparison_table']['comparison_fields']!= "") : ?>
  

  <section id="comparison-table" class="center-align">
    
    <h2 class="center-align"><?php print snag_field('comparison_title'); ?></h2>  
    
    <div class="subtitle"><?php print snag_field('comparison_subtitle'); ?></div>  
    
    <div class="container row">
      
      <div class="table-wrapper">
        <?php echo do_shortcode( "[mobile-table-message]"); ?>
        <table class="comparison-table comparison-responsive three-column">
          
          <thead>
          
            <tr>
              
              <th></th>
              
                <?php foreach (snag_field('comparison_table')['comparison_table']['table_headers'] as $header) : ?>
                  <th><?php echo $header['title']; ?></th>
                  
                <?php endforeach; ?>
                
            </tr>
            
          </thead>
          
          <tbody>
            <?php foreach (snag_field('comparison_table')['comparison_table']['comparison_fields'] as $comparison) : ?>
            
              <tr>
                
                <td class="descriptor"><?php echo $comparison['descriptor']; ?></td>

                  <?php foreach ($comparison['fields'] as $field) : ?>
                  
                    <td><?php echo $field['copy'] ?></td>
                    
                  <?php endforeach; ?>
                  
              </tr>              
              
            <?php endforeach; ?>
          </tbody>
        </table>
        
      </div>
      
      
      
    </div>
  </section>
  
  <?php endif; ?>
 
  <section id="intro">
    
    <h2 class="center-align"><?php print snag_field('intro_title'); ?></h2>  
    
      <div class="container row">
        
        <?php if (snag_field('intro_touts')) : ?>
        
          <?php foreach ( snag_field('intro_touts') as $tout) : ?>
  
            <div class="col l4 m12 center-align">
              
              <?php 
                $icon_id = glide_get_image_id($tout['icon']['url']);
                $icon = wp_get_attachment_image($icon_id, 'icon-xxlarge');
              ?>
              
              <div class="img-wrapper valign-wrapper">
              
                <?php echo $icon ?>
              
              </div>
              
              <h3><?php echo $tout['title']; ?></h3>
              
              <p><?php echo $tout['copy']; ?></p>
              
            </div>  
  
          <?php endforeach; ?>
          
        
        <?php endif; ?>
        
      </div>  

  </section> 
 
</section>

<?php
get_footer();
?>