
<?php
/**
 * Theme Name: Nature Nates
 * Version: 1.0
 * Author: Glide Design
 * Default content theme 
 */

get_header(); 
$pID = get_the_ID();
the_post();
?>

<div class="default-page"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<section class="content">

  <div class="container skinny">
  <?php
  the_content();
  ?>

  </div>
</section>

<?php
get_footer();
?>

