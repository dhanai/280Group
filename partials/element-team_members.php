<?php 
  global $item;
  //print_r($item['content']);
  $rows = $item['members'];
?>

<section id="team-member-list" class="container row">

    <?php $i = 1; ?>
    <?php foreach ($rows as $row) : ?>

      
      <div class="col l4 s6 center-align team-member">

          <?php 
            $img_id = get_the_post_thumbnail_url($row->ID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($row->ID)) : "";
            $image = wp_get_attachment_image($img_id, 'team-member');
          ?>
          <span class="img-wrapper">
            <?php echo $image ?>
          </span>
          <h3><?php echo get_the_title($row->ID); ?></h3>
          <span class="position"><?php echo get_field('position',$row->ID); ?></span>
          
          
          <div class="hover-content">
            <div class="close-hover">&#10005;</div>
            <div class="hover-header"><b><?php echo get_the_title($row->ID); ?>,</b> <?php echo get_field('position',$row->ID); ?></div>
            <div class="description">
              <?php echo wp_trim_words(get_post_field('post_content', $row->ID), 100);  ?>
            </div>
          </div>
          
        </div>

      <?php $i++; ?>
    <?php endforeach; ?>
    
  </section>

<?php
  
if (isset($item['button']) && $item['button'] != "") {
  echo build_acf_button($item['button'], 'btn');
} 
  
?>

