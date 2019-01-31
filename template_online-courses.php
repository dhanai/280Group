<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: Online Courses
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>

<div class="courses-page online-courses"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php  get_template_part( '/partials/masthead'); ?>

<?php
  // Get the Online Courses
  $courses = $themeCPT->courses('online');  
?>

<main class="content">
  
  <section class="comparison-chart container center-align">
    
    <div class="table-wrapper">
      <?php echo do_shortcode( "[mobile-table-message]"); ?>
      
    <table class="comparison-responsive three-column">
      
      <thead>
        <tr>
          <th>Course Details</th>
          <?php foreach ($courses as $course) : ?>
            <th>
            <a href="<?php echo get_the_permalink($course['id']) ?>"><?php print $course['short_title'] ?></a>
            </th>
          <?php endforeach; ?>
  
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Skill Level</td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print $course['online_course_comparison_info']['skill_level'] ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td>This course is for</td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print $course['online_course_comparison_info']['this_course_is_for'] ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td>Topics Covered</td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print $course['online_course_comparison_info']['topics_covered'] ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td>Course Format</td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print $course['online_course_comparison_info']['course_format'] ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td>Time Commitment</td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print $course['online_course_comparison_info']['time_commitment'] ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td>Certification Exam</td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print $course['online_course_comparison_info']['certification_exam'] ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td>Price (USD)</td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print do_shortcode( "[online_price]" ) ?>
            </td>
          <?php endforeach; ?>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <?php foreach ($courses as $course) : ?>
            <td>
            <?php print sprintf("<a href='%s' class='btn'>Learn More</a>", get_the_permalink($course['id'])); ?>
            </td>
          <?php endforeach; ?>
        </tr>
      </tfoot>
    
    </table>
    </div>
     
  </section>

  <section class="course-cards center-align">
    <div class="container">
    <h2>Online Product Management Courses</h2>
    
      <div class="row">
        <?php  foreach ($courses as $course) : ?>
          
            <div class="col l6">
            <div class="card">
              <div class="card-header">
                <img src="<?php echo assetDir ?>/img/icon-computer-course.png"><h3><a href="<?php echo get_the_permalink($course['id']) ?>"><?php echo $course['title'] ?></a></h3>
              </div>
              <div class="card-content">
                <?php echo $course['description']; ?>
              </div>
              <div class="card-action">
                <b><?php echo do_shortcode( "[online_price]") ?> per person (price in USD)</b>
                <a href="<?php echo get_the_permalink($course['id']) ?>" class="btn">View Curriculum</a>
              </div>
            </div>
            </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  
  <section class="testimonial-scroller center-align">
    <h3><?php echo 	snag_field('testimonials_section_title'); ?></h3>
    
    <?php
      global $item; 
      $item['testimonials'] = snag_field('testimonials');
    ?>

    <div class="controls">
      <span class="prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
      <span class="next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
    </div>
    
    <?php  get_template_part( '/partials/element', 'testimonial_multiple'); ?>
    
  </section>

</main>

<?php
get_footer();
?>