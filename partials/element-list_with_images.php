<div class="container">
<?php 
  global $item;

  foreach($item['list'] as $list_item) {
    $img = sprintf("<img src='%s'>",$list_item['image']['sizes']['square215']);
    print sprintf('<div class="row"><div class="col l4 s12">%s</div><div class="col l8 s12 valign-wrapper"><div><h3>%s</h3><div class="copy">%s</div></div></div></div>', $img, $list_item['title'], $list_item['copy']);
  }
  
?>
</div>