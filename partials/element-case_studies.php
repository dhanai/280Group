<?php 
  global $item;
  $rows = $item['studies'];
  
?>

<div class="row">

<?php  
  
  foreach ($rows as $row) {
    $img_id = get_the_post_thumbnail_url($row->ID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($row->ID)) : "";
    $image = wp_get_attachment_image($img_id, 'testimonial-logo');

    echo "<div class='col l6 ".(count($rows) == 1 ? 'push-l3' : '')."'>";
    echo "<div class='card'>";
    echo $image;
    
    //echo sprintf("<h3>%s</h3>",get_the_title($row->ID));
    echo sprintf("<p>%s</p>",get_field('description',$row->ID));

    echo sprintf('<a href="%s" class="btn btn-link" target="_blank">Read Story</a>',get_field('document',$row->ID)['url']);

    echo "</div></div>";
  }
  
  
  
?>

</div>

<?php
  
if (isset($item['button'])) {
  echo build_acf_button($item['button'], 'btn');
} 
  
?>