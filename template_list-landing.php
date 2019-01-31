<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: List Landing
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;
global $glide_acf_fields;

$page_content = snag_field('list_items');

?>
<div class="list-landing"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<main class="content">

  <div class="container row list"> 
  <?php if ($page_content != "") : ?>
    <?php foreach ($page_content as $list_item) : ?>
    
          <div class="col l4 list-item">
            <a href="<?php echo $list_item['button']['url'] ?>" class="card">
              <div class="card-header valign-wrapper" style="background-image: url('<?php echo $list_item["background_image"]["sizes"]["medium"] ?>');">
                <div class="overlay"></div>
                <h3 class="item-title"><?php echo $list_item['title'] ?></h3>
              </div>
              <?php 
                $icon_id = glide_get_image_id($list_item['icon']['url']);
                $icon = wp_get_attachment_image($icon_id, 'icon-medium');
              ?>
              
              <div class="card-icon valign-wrapper"><?php echo $icon ?></div>
              <div class="card-content center-align">
                <?php echo $list_item['copy'] ?>
              </div>
              
              <div class="card-action center-align">
                
                <span class="btn"><?php echo $list_item['button']['title'] ?></span>
              </div>
              
            </a>
          </div>

    <?php endforeach; ?>
  <?php endif; ?>
  </div>
    
</main>

<?php
get_footer();
?>

