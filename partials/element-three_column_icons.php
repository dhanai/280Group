<?php 
  global $item;
  //print_r($item['content']);
  $rows = $item['content'];
?>

<div class="row">

<?php  
  
  foreach ($rows as $row) {
    echo "<div class='col l4 s12'>";
    echo sprintf("<div class='icon-wrapper valign-wrapper'><img src='%s' class='icon'></div>",$row['icon']['sizes']['icon-xlarge']);
    echo sprintf("<h3>%s</h3>",$row['title']);
    echo (isset($row['subtitle']) ? sprintf("<span class='subtext'>%s</span>",$row['subtitle']) : '');
    echo sprintf("<div class='copy'>%s</div>",$row['copy']);
    echo "</div>";
  }
?>

</div>