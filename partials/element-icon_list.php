<?php 
  global $item;
  //print_r($item['content']);
  $rows = $item['content'];
?>

<ul class="<?php echo (isset($item['style']) ? $item['style'] : ''); ?>">

<?php  
  $img_size = "large";
  if (isset($item['style']) && $item['style']==="small_style") $img_size = "medium";
  
  foreach ($rows as $row) {
    echo "<li>";
    echo sprintf("<div class='icon-wrapper valign-wrapper'><img src='%s' class='icon'></div>",$row['icon']['sizes']['icon-'.$img_size]);
    echo sprintf("<h3>%s</h3>",$row['title']);
    echo (isset($row['subtitle']) ? sprintf("<span class='subtext'>%s</span>",$row['subtitle']) : '');
    echo sprintf("<div class='copy'>%s</div>",$row['copy']);
    echo "</li>";
  }
?>

</ul>