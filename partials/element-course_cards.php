<?php 
  global $item;
  //print_r($item['content']);
  $rows = $item;
?>

<div class="row">

  <?php foreach ($rows as $row) : ?>
      
    <div class="col s12 m6">
      
      <div class="card">
        
        <div class="card-header">
          
          <h3 class="card-title"><a href="<?php echo get_the_permalink( $row->ID) ?>"><?php echo get_the_title($row->ID); ?></a></h3>
          
        </div>
        
        <div class="card-content">
          
          <div class="copy"<?php echo get_field('description',$row->ID) ?></div>
        
        </div>
        
        <div class="card-action">
          
          <b><?php echo do_shortcode( get_field('price',$row->ID)) ?> per person (price in USD)</b>
          
          <a href="<?php echo get_the_permalink( $row->ID) ?>" class="btn">View Curriculum</a>
        
        </div>
      
      </div>
    
    </div>

    <?php endforeach; ?>
    
  </div>

