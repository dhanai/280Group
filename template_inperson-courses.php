<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: In-Person Courses
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>

<div class="courses-page inperson-courses toolkit-page"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php  get_template_part( '/partials/masthead'); ?>

<?php
  $courses = $themeCPT->courses('in person');
?>

<main class="content">
    
  <section class="comparison-chart container center-align">



  <div class="table-wrapper">
    <table class="comparison-responsive">
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
            <?php echo do_shortcode( $course['price']) ?>
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

  <?php $page_content = snag_field('toolkit_page_content'); ?>
 
  <?php if ($page_content != "") : ?>
    <?php foreach ($page_content as $section) : ?>
    
      <section  class="section <?php echo $section['section_background'] ?> bottom-border-<?php echo $section['bottom_border'] ?>">
        
        <div class="container">
          <h2 class="section-title"><?php print $section['title'] ?></h2>
             
          <?php if ($section['toolkit_elements'] != "") : ?>
          
            <?php foreach ($section['toolkit_elements'] as $element) : ?>
    
              <?php 
                global $item; 
                global $include_controls;
                $item = $element;
                $include_controls = true;
              ?>
    
              <div class="detail-element <?php print $element['acf_fc_layout'] ?>">
                
                <?php  get_template_part( '/partials/element', $element['acf_fc_layout']); ?>
              
              </div>
    
            <?php endforeach; ?>
          
          <?php endif; ?>          
          
        </div>
        
      </section>
    
    <?php endforeach; ?>
  <?php endif; ?>

</main>

<?php
get_footer();
?>