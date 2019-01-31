<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: What Is Product Management?
 */

get_header(); 

global $pID;
global $glide_acf_option_fields;
global $glide_acf_fields;

$tabs = snag_field('tabs');  
?>

<div class="what-is-product-management"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php  get_template_part( '/partials/masthead'); ?>

<!-- SECTION FOR SUB PAGE NAVIGATION -->
<?php 

if (get_current_page_depth()==2) {
  
  $page_args = array(
    'child_of' => $post->post_parent,
    'title_li' => "",
    'depth' => 1
  );
  
  echo "<section class='sub-nav'><div class='container center-align'><ul>";
  wp_list_pages( $page_args);
  echo "</ul></div></section>";
} else if (get_current_page_depth()==3) {
  
  $page_args = array(
    'child_of' => wp_get_post_parent_id(wp_get_post_parent_id( $pID )),
    'title_li' => "",
    'depth' => 1
  );
  
  echo "<section class='sub-nav'><div class='container center-align'><ul>";
  wp_list_pages( $page_args);
  echo "</ul></div></section>";
}
?>

<main class="content container row">

  <div class="col l8 push-l4 page-content">

    <?php echo the_content();  ?>
    
  </div>
  
  <div class="sidebar col l4 pull-l8">    

    <?php if (isset($glide_acf_option_fields['sidebar_blurb_defaults']['title']) && $glide_acf_option_fields['sidebar_blurb_defaults']['title'] != "") : ?>
      
      <div class="card sidebar-blurb">

        <div class="card-header">
  
          <h3><?php if (isset(snag_field('sidebar_blurb_override')['title']) && snag_field('sidebar_blurb_override')['title'] != "" ) { echo snag_field('sidebar_blurb_override')['title']; } else  { echo $glide_acf_option_fields['sidebar_blurb_defaults']['title']; } ?></h3>
  
        </div>
  
        <p><?php if (isset(snag_field('sidebar_blurb_override')['subtitle']) && snag_field('sidebar_blurb_override')['subtitle'] != "" ) { echo snag_field('sidebar_blurb_override')['subtitle']; } else  { echo $glide_acf_option_fields['sidebar_blurb_defaults']['subtitle']; } ?></p>
  
        <?php if (isset(snag_field('sidebar_blurb_override')['button']) && snag_field('sidebar_blurb_override')['button'] != "" ) { echo build_acf_button(snag_field('sidebar_blurb_override')['button'], 'btn'); } else  { echo build_acf_button($glide_acf_option_fields['sidebar_blurb_defaults']['button'],'btn'); } ?>    

      </div>

    <?php endif; ?>

    <?php 
    
      if (has_children()) {
      $page_args = array(
        'child_of' => $pID,
        'title_li' => "",
      );
    } else {
      $page_args = array(
        'child_of' => $post->post_parent,
        'title_li' => "",
      );
    }
      echo "<section class='sub-nav'><ul>";
      wp_list_pages( $page_args);
      echo "</ul></section>";
    
    ?>    
    
    <?php echo do_shortcode( '[su_form_container title="Join 50K+ Product Managers Reading Our Newsletter"]<iframe src="https://go.280group.com/l/50472/2018-05-08/9nd221" width="100%" height="185" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>[/su_form_container]' ) ?>
    
    
    
  </div>

</main>

<section id="product-listing">
  
  <div class="container row valign-wrapper">
    
    <div class="col l5 s12"><div class="img-wrapper"><?php echo wp_get_attachment_image( $glide_acf_option_fields['wipm_footer_product_image']['id'], 'large')  ?></div></div>
    
    <div class="col l7 s12">
      
      <h2><?php echo $glide_acf_option_fields['wipm_footer_product_title']; ?></h2>
      
      <p><?php echo $glide_acf_option_fields['wipm_footer_product_copy']; ?></p>
      
      <?php echo build_acf_button($glide_acf_option_fields['wipm_footer_product_link'], 'btn'); ?>
      
    </div>
  
  </div>

</section>  

<?php
get_footer();
?>





