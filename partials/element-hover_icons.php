<?php 
  global $item;
  $icons = $item['icons'];
?>
<div class="row">
<?php  
  
  foreach ($icons as $icon) {
    echo "<div class='col l2 s6 item'>";
    echo sprintf("<div class='icon-wrapper valign-wrapper'><img src='%s' class='icon'></div>",$icon['icon']['sizes']['icon-large']);
    echo sprintf("<h4>%s</h4>",$icon['title']);
    echo (isset($icon['subtitle']) ? sprintf("<span class='subtext'>%s</span>",$icon['subtitle']) : '');
    echo sprintf("<div class='copy'><div class='close-hover'>&#10005;</div><h5>%s</h5>%s</div>",$icon['title'],$icon['copy']);
    echo "</div>";
  }
?>
</div>