<?php 
  global $clients;

  foreach ($clients as $item) {
    $img_id = get_the_post_thumbnail_url($item->ID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($item->ID)) : "";
    $image = wp_get_attachment_image($img_id, 'client-logo');
    print sprintf('<span class="wrapper">%s</span>',$image);
  }
  
?>