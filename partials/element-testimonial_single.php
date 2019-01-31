<div class="single-scroll">
<?php 
  global $item;

  $rows = $item['testimonial'];
  
  foreach ($rows as $row) {
   
    $img_id = get_the_post_thumbnail_url($row->ID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($row->ID)) : "";
    $image = wp_get_attachment_image($img_id, 'testimonial-logo');
    
    echo sprintf('<article class="testimonial"><div class="quote">%s</div><div class="name-title"><aside class="img-wrapper">%s</aside><div class="text">%s<span>%s</span></div></div></article>',$row->post_content,$image,$row->post_title, get_field('position',$row->ID));
    
  }
  
  if (isset($item['button']) && $item['button'] != "") {
    echo build_acf_button($item['button'], 'btn');
  }
  
?>
</div>