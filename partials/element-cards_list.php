
<div class="container row">
<?php 
  global $item;
  
  //print count($item['cards']);
  $i = 1;
  foreach($item['cards'] as $card) : ?>
    <?php $offset = ""; ?>
    <?php if ($i===1 && count($item['cards'])===2) $offset = "offset-l2" ?>
    <?php if ($i===1 && count($item['cards'])===1) $offset = "offset-l4" ?>
           
    <div class="col s12 m4 <?php echo $offset; ?>">
      <div class="card">
        <div class="card-header">
          <div>
          <h3 class="card-title"><?php echo $card['title'] ?></h3>
          <div class="subtext"><?php echo $card['subtitle'] ?></div>
          </div>
        </div>
        <div class="card-content">
          <?php 
            foreach($card['list'] as $list_item) {  
              echo "<div>" . $list_item['copy'] . "</div>";
            }
          ?>
        </div>
      </div>
    </div>    
    
<?    
    $i++;
  endforeach;
?>
</div>