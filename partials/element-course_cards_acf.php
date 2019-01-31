<?php 
  global $item;
  global $icon;
  $rows = $item;
?>

<div class="row">

  <?php foreach ($rows as $row) : ?>
      
    <div class="col l6 s12">

      <div class="card">

        <div class="card-header">

          <img src="<?php echo $icon ?>"><h3><a href="<?php echo get_the_permalink($row['id']) ?>"><?php echo $row['title'] ?></a></h3>

        </div>

        <div class="card-content">
          
          <?php echo $row['description']; ?>
          
        </div>
        
        <div class="card-action">
        
          <?php if ($row['price'] != "") : ?>
            
            <b><?php echo do_shortcode( $row['price']) ?> per person (price in USD)</b>
          
          <?php endif; ?>
          
          <a href="<?php echo get_the_permalink($row['id']) ?>" class="btn">View Curriculum</a>
          
        </div>

      </div>

    </div>

    <?php endforeach; ?>
    
  </div>

