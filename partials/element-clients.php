<?php 
  global $item;
  $rows = $item['clients_list'];
?>
<?php  
  
  foreach ($rows as $row) {
    $img_id = get_the_post_thumbnail_url($row->ID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($row->ID)) : "";
    $image = wp_get_attachment_image($img_id, 'client-logo');
    echo '<span class="wrapper">';
    echo $image;
    echo "</span>";
  }
?>

<?php

if (isset($item['button']) && $item['button'] != "") {
  echo "<div>";
  echo build_acf_button($item['button'], 'btn');
  echo "</div>";
} 
  
?>


