<?php 
  global $item;
  $table_fields = $item['table_fields']; 
?>


    <table>
      <tbody>
        <?php foreach ($table_fields as $row) : ?>
          <tr>
  
          <?php foreach ($row['columns'] as $cell) : ?>
            <td><?php echo $cell['copy'] ?></td>
          <?php endforeach; ?>
          </tr>              
          
        <?php endforeach; ?>
      </tbody>
    </table>