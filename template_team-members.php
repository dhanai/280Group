<?php
/**
 * Glide Theme Template
 *
 * Template Name: Team Members
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>

<div class="team-members-page"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php  get_template_part( '/partials/masthead'); ?>

<main class="content">
  
  <?php
    // Get the Online Courses
    $args = array(
      'post_type' => 'team_member',
      'posts_per_page' => -1
    );
    
    $team = array();
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) : 
      while ( $query->have_posts() ) : $query->the_post();
        $fields = get_fields(get_the_ID());
        $fields['id'] = get_the_ID();
        $fields['title'] = get_the_title();
        $fields['desc'] = apply_filters( 'the_content', get_the_content() );
        array_push( $team, $fields );
      endwhile;
    endif;
  ?>
  
  <section class="touts container row">
    <?php $touts = snag_field('touts'); ?>

    <?php if ($touts !== "") : ?>

      <?php foreach ($touts as $tout) : ?>
        
        <div class="col l6 s12 center-align">
          <h2><?php echo $tout['title'] ?></h2>
          <div class="copy"><?php echo $tout['copy'] ?></div>
        </div>
                
      <?php endforeach; ?>
      
    <?php endif; ?>
    
  </section>

  <section id="team-member-list" class="container row">

    <?php $i = 1; ?>
    <?php foreach ($team as $member) : ?>

      <div class="col l4 s6 center-align team-member">
        <a class="modal-trigger" href="#modal<?php echo $i ?>">
          <?php
            $image_1 = get_the_post_thumbnail_url($member['id']); 
            /*$img_id = get_the_post_thumbnail_url($member['id'])!="" ? glide_get_image_id(get_the_post_thumbnail_url($member['id'])) : "";
            $image = wp_get_attachment_image($img_id, 'team-member');*/
          ?>
          <span class="img-wrapper">
            <?php //echo $image ?>
            <?php echo '<img src="'.$image_1.'">'; ?>
          </span>
          <h3><?php echo $member['title'];  ?></h3>
          <?php echo (isset($member['position']) ? $member['position'] : "");  ?>
        </a>

        <div id="modal<?php echo $i ?>" class="modal">
          <div class="modal-header">
            <span class="img-wrapper"><?php echo $image ?></span>
            <h3><?php echo $member['title'];  ?></h3>
            <?php echo (isset($member['position']) ? $member['position'] : "");  ?>
            
            <a href="#!" class="modal-close">&#10005;</a>
            
          </div>
          <div class="modal-content">
            
            <div><?php print $member['desc'];  ?></div>
          </div>
        </div>
        
      </div>
      <?php $i++; ?>
    <?php endforeach; ?>
    
  </section>
  

</main>

<?php
get_footer();
?>



<Script>
$(document).ready(function(){
  

});    
</script>