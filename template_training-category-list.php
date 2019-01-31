<?php
/**
 * Glide Theme Page
 *
 * Template Name: Training Category List
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;

?>

<div class="training-category-list"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<?php 

// GET PAGE DATA
$online_courses = $themeCPT->courses('online');
$inperson_courses = $themeCPT->courses('in person');
$private_courses = $themeCPT->courses('on site');  

?>

<main class="content">
    
  <section class="container row list"> 
    
    <?php if (snag_field('course_types') != "") : ?>
      
      <?php foreach (snag_field('course_types') as $list_item) : ?>
      
        <div class="col l4 s12 list-item">
          
          <a href="<?php echo $list_item['button']['url'] ?>" class="card">
            
            <div class="card-header valign-wrapper" style="background-image: url('<?php echo $list_item["background_image"]["sizes"]["medium"] ?>');">
              
              <div class="overlay"></div>
              
              <h3 class="item-title"><?php echo $list_item['title'] ?></h3>
            
            </div>
            
            <?php 
              $icon_id = glide_get_image_id($list_item['icon']['url']);
              $icon = wp_get_attachment_image($icon_id, 'icon-medium');
            ?>
            
            <div class="card-icon valign-wrapper"><?php echo $icon ?></div>
            
            <div class="card-content center-align"><?php echo $list_item['copy'] ?></div>
            
            <div class="card-action center-align">

              <span class="btn"><?php echo $list_item['button']['title'] ?></span>

            </div>
            
          </a>
        
        </div>
  
      <?php endforeach; ?>
  
    <?php endif; ?>

  </section>  
 
  <section class="container row two-column">
    
    <?php if (snag_field('two_column_content_1') != "") : ?>
    
      <div class="col l6 s12 center-align image-wrapper vertical-align">
          
          <?php 
            if (snag_field('two_column_content_1')['image']['url'] !== "") {
              $img_id = glide_get_image_id(snag_field('two_column_content_1')['image']['url']);
              $img = wp_get_attachment_image($img_id, 'square320');
              echo $img;
            }
          ?>
          
      </div>
      
      <div class="col l6 s12 text-wrapper">
      
        <?php echo snag_field('two_column_content_1')['copy'] ?>
      
      </div>
  
    <?php endif; ?>
  
  </section>
  
  <section class="testimonial_single">
  
  <?php if (snag_field('testimonial') != "") : ?>
    <?php $item['testimonial'] = snag_field('testimonial');  ?>
    
    <?php get_template_part( '/partials/element', 'testimonial_single'); ?>
      
  <?php endif; ?>
  
  </section>  
  
  <section class="comparison-table-wrapper container center-align">
    
    <h2><?php echo snag_field('comparison_title'); ?></h2>

    <div class="subtitle"><?php echo snag_field('comparison_subtitle'); ?></div>
        
    <div class="row table-container">

    <div class="col s12">

      <ul class="tabs">

        <li class="tab col s3"><a href="#onlinecourses">Online Courses</a></li>

        <li class="tab col s3"><a href="#inpersoncourses">In-Person Courses</a></li>

      </ul>

    </div>

    <div id="onlinecourses" class="col s12">
     
      <div class="table-wrapper">
        <?php echo do_shortcode( "[mobile-table-message]"); ?>
      <table class="comparison-table comparison-responsive three-column">

        <thead>
  
          <tr>
  
            <th>Course Details</th>
  
            <?php foreach ($online_courses as $course) : ?>
  
              <th>
  
                <?php print $course['short_title'] ?>
  
              </th>
  
            <?php endforeach; ?>
    
          </tr>
  
        </thead>

        <tbody>
          <tr>
            <td>Skill Level</td>
            <?php foreach ($online_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['skill_level'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>This course is for</td>
            <?php foreach ($online_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['this_course_is_for'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Topics Covered</td>
            <?php foreach ($online_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['topics_covered'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Course Format</td>
            <?php foreach ($online_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['course_format'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Time Commitment</td>
            <?php foreach ($online_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['time_commitment'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Certification Exam</td>
            <?php foreach ($online_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['certification_exam'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Price (USD)</td>
            <?php foreach ($online_courses as $course) : ?>
              <td>
              <?php echo do_shortcode( $course['price'] ) ?>
              </td>
            <?php endforeach; ?>
          </tr>
        </tbody>
  
        <tfoot>
          
          <tr>
            
            <td></td>
            
            <?php foreach ($online_courses as $course) : ?>
              
              <td class="center-align">
                
                <?php print sprintf("<a href='%s' class='btn'>Learn More</a>", get_the_permalink($course['id'])); ?>
              
              </td>
            
            <?php endforeach; ?>
          
          </tr>
  
        </tfoot>
      
      </table>
      </div>
      
    </div>
   
    <div id="inpersoncourses" class="col s12">
      
      <table class="comparison-table comparison-responsive">

        <thead>

          <tr>
            <th>Course Details</th>
            
            <?php foreach ($inperson_courses as $course) : ?>
  
              <th class="align-center">
  
                <?php print $course['short_title'] ?>
  
              </th>
  
            <?php endforeach; ?>
    
          </tr>

        </thead>
        <tbody>
          <tr>
            <td>Skill Level</td>
            <?php foreach ($inperson_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['skill_level'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>This course is for</td>
            <?php foreach ($inperson_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['this_course_is_for'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Topics Covered</td>
            <?php foreach ($inperson_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['topics_covered'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Course Format</td>
            <?php foreach ($inperson_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['course_format'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Time Commitment</td>
            <?php foreach ($inperson_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['time_commitment'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <td>Certification Exam</td>
            <?php foreach ($inperson_courses as $course) : ?>
              <td>
              <?php print $course['online_course_comparison_info']['certification_exam'] ?>
              </td>
            <?php endforeach; ?>
          </tr>
          
          <tr>
            
            <td>Price (USD)</td>
            
            <?php foreach ($inperson_courses as $course) : ?>
            
              <td class="center-align">
              
                <?php echo do_shortcode( $course['price'] ) ?>
              
              </td>
            
            <?php endforeach; ?>
          
          </tr>
        
        </tbody>
        
        <tfoot>
          
          <tr>
            
            <td></td>
            
            <?php foreach ($inperson_courses as $course) : ?>
              
              <td class="center-align">

              <?php print sprintf("<a href='%s' class='btn'>Learn More</a>", get_the_permalink($course['id'])); ?>

              </td>

            <?php endforeach; ?>

          </tr>

        </tfoot>

      </table>
      
    </div>
    
  </div>
    
  </section>
  
  <section class="video-section center-align">
    <div class="container">
      <h2><?php echo snag_field('video_title'); ?></h2>
      
      <?php 
        // get iframe HTML
        $iframe = snag_field('video');
        
        
        // use preg_match to find iframe src
        preg_match('/src="(.+?)"/', $iframe, $matches);
        $src = $matches[1];
        
        
        // add extra params to iframe src
        $params = array(
            'controls'    => 1,
            'hd'        => 1,
            'autohide'    => 1,
            'rel' => 0,
        );
        
        $new_src = add_query_arg($params, $src);
        //$iframe = str_replace($src, $new_src, $iframe);
        $iframe = str_replace($src, "", $iframe);
        
        // add extra attributes to iframe html
        $attributes = 'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen';
        
        $iframe = str_replace('></iframe>', ' data-src='.$new_src. " " . $attributes . '></iframe>', $iframe);
        
        // echo $iframe
        echo $iframe;
      
      ?>      
      
      
      
      
      
    </div>
  </section>
  
  <section class="course-cards center-align inperson-course-cards">
    
    <div class="container">
      
      <h2><?php echo snag_field('in_person_title'); ?></h2>
    

        <?php $item = $inperson_courses; ?>

        <?php $icon = assetDir . '/img/icon-course-in-person.png'; ?>

        <?php  get_template_part( '/partials/element-course_cards_acf'); ?>


    </div>

  </section>
  
  <section class="testimonial_single testimonial2">
  
  <?php if (snag_field('testimonial2') != "") : ?>
    <?php $item['testimonial'] = snag_field('testimonial2');  ?>
    
    <?php get_template_part( '/partials/element', 'testimonial_single'); ?>
      
  <?php endif; ?>
  
  </section>    
  
  <section class="course-cards center-align online-course-cards">
    <div class="container">
    <h2><?php echo snag_field('online_title'); ?></h2>
    
      <div class="row">

        <?php $item = $online_courses; ?>

        <?php $icon = assetDir . '/img/icon-computer-course.png'; ?>

        <?php  get_template_part( '/partials/element-course_cards_acf'); ?>

      </div>
    </div>
  </section>
  
  <section class="testimonial_single testimonial3">
  
  <?php if (snag_field('testimonial3') != "") : ?>
    <?php $item['testimonial'] = snag_field('testimonial3');  ?>
    
    <?php get_template_part( '/partials/element', 'testimonial_single'); ?>
      
  <?php endif; ?>
  
  </section>      
  
  <section class="course-cards center-align private-course-cards">
    <div class="container">
    
      <div class="row two-column">
        <div class="col l6 center-align vertical-align">
            <?php 
              if (snag_field('private_intro')['image']['url'] != "") {
                $img_id = glide_get_image_id(snag_field('private_intro')['image']['url']);
                $img = wp_get_attachment_image($img_id, 'square320');
                echo $img;
              }
            ?>
        </div>
        <div class="col l6 text-wrapper">
          <?php echo snag_field('private_intro')['copy']; ?>
        </div>    
      </div>
    
      <div class="row">
          
          <?php $item = $private_courses; ?>

          <?php $icon = assetDir . '/img/icon-courses-private.png'; ?>
  
          <?php  get_template_part( '/partials/element-course_cards_acf'); ?>


      </div>
      
    </div>
  </section>  
 
</main>

<?php
get_footer();
?>
