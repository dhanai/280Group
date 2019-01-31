
<div class="container row list"> 
<?php 
  global $item;
  
  //print count($item['cards']);
  $i = 1;
  foreach($item['cards'] as $card) : ?>
           
    <div class="col l4 list-item">
      <div class="card">
          <div class="card-header valign-wrapper" style="background-image: url('<?php echo $card["background_image"]["sizes"]["medium"] ?>');">
            <div class="overlay"></div>
            <h3 class="item-title"><?php echo $card['title'] ?></h3>
          </div>
          <?php 
            $icon_id = glide_get_image_id($card['icon']['url']);
            $icon = wp_get_attachment_image($icon_id, 'icon-medium');
          ?>
          
          <div class="card-icon valign-wrapper"><?php echo $icon ?></div>
          <div class="card-content center-align">
            <?php echo $card['copy'] ?>
          </div>
          
          <div class="card-action center-align">
            <?php echo build_acf_button($card['button'],'btn') ?>
          </div>
          
        </div>
    </div>    
    
<?    
    $i++;
  endforeach;
?>
</div>