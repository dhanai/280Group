<?php 
  global $item;
  $table = $item['comparison_table']; 
?>

  <div class="table-wrapper">
    <table class="comparison-table comparison-responsive three-column">
      <thead>
        <tr>
          <th></th>
            <?php foreach ($table['table_headers'] as $header) : ?>
              <th><?php echo $header['title']; ?></th>
            <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($table['comparison_fields'] as $comparison) : ?>
          <tr>
            <td class="descriptor"><?php echo $comparison['descriptor']; ?></td>
  
          <?php foreach ($comparison['fields'] as $field) : ?>
            <td><?php echo $field['copy'] ?></td>
          <?php endforeach; ?>
          </tr>              
          
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>