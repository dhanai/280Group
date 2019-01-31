<?php   
  global $item; 
  //global $include_controls;
  $scroller_class = "full";
  if (isset($item['cards']) && $item['cards']===true) { 
    $scroller_class = "cards";
  }
?>

<div class="scroller-<?php echo $scroller_class ?>">
<?php 
  $rows = $item['testimonials'];
  foreach ($rows as $row) {
    
    $img_id = get_the_post_thumbnail_url($row->ID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($row->ID)) : "";
    $image = wp_get_attachment_image($img_id, 'testimonial-logo');
  
    if (isset($item['cards']) && $item['cards']===true) { 
      echo sprintf('<article class="testimonial card"><div class="name-title"><aside class="img-wrapper">%s</aside><div class="text"><b>%s</b><span>%s</span></div></div><div class="quote">%s</div></article>',$image,$row->post_title, get_field('position',$row->ID),$row->post_content);
    } else {
      echo sprintf('<article class="testimonial"><div class="quote">%s</div><div class="name-title"><aside class="img-wrapper">%s</aside><div class="text">%s<span>%s</span></div></div></article>',$row->post_content,$image,$row->post_title, get_field('position',$row->ID));
    }
  }
?>
</div>
<?php //if ($include_controls) : ?>
  <div class="controls controls-<?php echo $scroller_class ?>">
    <span class="prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
    <span class="next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
  </div>
<?php //endif; ?>
