<?php
/**
 * Glide Theme Page
 *
 * Template Name: Events
 */

get_header(); 

global $pID;
global $glide_acf_option_fields;

?>

<div class="events-calendar"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<?php 

//GET DATA FOR PAGE
$events = $themeCPT->events();

?>

<script type='text/javascript'>
  var courses_array;
  <?php
    $js_array = json_encode($courses);
    echo "var courses_array = ". $js_array . ";\n";
  ?>
</script>

<section class="content">

  <div class="container list-container">

    <table id="course-table" class="compact"  style="width:100%">
  
      <thead>
  
        <tr>
  
            <th>Date</th>
            <th>Time</th>
            <th>Title</th>
            <th>Location</th>
            <th class="actions-column">Registration</th>
  
        </tr>
  
      </thead>    
  
      <tbody>
  
  <?php 
  
  foreach($events as $row) {
    
    $time = $location = "";
    if (isset($row['time'])) $time = $row['time'];
    if (isset($row['location'])) $location = $row['location'];
    
    $rowString = "";
    $rowString .= "<tr>";
    $rowString .= "<td data-sort=".strtotime($row['date']).">".$row['date']."</td>";
    $rowString .= "<td>". $time  ."</td>";  
    $rowString .= "<td>". $row['title'] ."</td>";  
    $rowString .= "<td>". $location ."</td>";  
    $rowString .= "<td><a href='". $row['registration_link'] ."' target='_blank' class='btn'>Register</a></td>";
    $rowString .= "</tr>";

    echo $rowString;

  }
  
  ?> 
      
      </tbody>
  
    </table>

  </div>
  
  
</section>

<?php
get_footer();
?>


<script>
  var courses;
  $(document).ready(function() {
  
    $.extend( true, $.fn.dataTable.defaults, {
        "info":     false,
        "pageLength": 100,
        "lengthChange": false,
        "searching": false,
        "paging": false,
        "order": [[ 0, 'asc' ]],
    } );
    
    var dataTable = $('#course-table').DataTable();
    
  })


</script>





