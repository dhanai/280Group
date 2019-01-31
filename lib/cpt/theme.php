<?php
class ThemeCPT
{
    /**
     * The API URL base.
     * 
     * @var string
     */
    //private $base;

    /**
     * Initializes properties.
     */
    public function __construct()
    {
      
    }

    /**
     * Returns the Courses of the type specified
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function courses($type)
    {
      $args = array(
        'post_type' => 'courses',
        'meta_key'		=> 'course_type',
      	'meta_value'	=> $type
      );
    
      $courses = array();
      $query = new WP_Query( $args );
    
      if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
          $fields['shopify_collection_location'] = get_field('shopify_collection_location', get_the_ID());
          $fields['online_course_comparison_info'] = get_field('online_course_comparison_info', get_the_ID());
          $fields['course_collection_id'] = get_field('shopify_collection_in_person', get_the_ID());
          $fields['price'] = get_field('price', get_the_ID());
          $fields['short_title'] = get_field('short_title', get_the_ID());
          $fields['description'] = get_field('description', get_the_ID());
          $fields['id'] = get_the_ID();
          $fields['title'] = get_the_title();
          $fields['link'] = get_permalink();
          array_push( $courses, $fields );
        endwhile;
      endif;
      
      return $courses;
    }



    /**
     * Returns the Online Course CPT Full
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function onlineCoursesFull()
    {
      
      $args = array(
        'post_type' => 'courses',
        'meta_key'		=> 'course_type',
      	'meta_value'	=> 'online'
      );
    
      $courses = array();
      $query = new WP_Query( $args );
    
      if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
          $fields = get_fields(get_the_ID());
          $fields['id'] = get_the_ID();
          $fields['title'] = get_the_title();
          $fields['link'] = get_permalink();
          array_push( $courses, $fields );
        endwhile;
      endif;
      
      return $courses;
    }
    
    /**
     * Returns the Online Course CPT Partial
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function onlineCoursesPartial()
    {
      
      $args = array(
        'post_type' => 'courses',
        'meta_key'		=> 'course_type',
      	'meta_value'	=> 'online'
      );
    
      $courses = array();
      $query = new WP_Query( $args );
    
      if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
          $fields['shopify_collection_location'] = get_field('shopify_collection_location', get_the_ID());
          $fields['online_course_comparison_info'] = get_field('online_course_comparison_info', get_the_ID());
          $fields['short_title'] = get_field('short_title', get_the_ID());
          $fields['description'] = get_field('description', get_the_ID());
          $fields['id'] = get_the_ID();
          $fields['title'] = get_the_title();
          $fields['link'] = get_permalink();
          array_push( $courses, $fields );
        endwhile;
      endif;
      
      return $courses;
    }


    /**
     * Returns the In Person Course CPT Partial
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function inPersonCoursesPartial()
    {
      
      $args = array(
        'post_type' => 'courses',
        'meta_key'		=> 'course_type',
      	'meta_value'	=> 'in person'
      );
    
      $courses = array();
      $query = new WP_Query( $args );
    
      if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
          $fields['shopify_collection_location'] = get_field('shopify_collection_location', get_the_ID());
          $fields['online_course_comparison_info'] = get_field('online_course_comparison_info', get_the_ID());
          $fields['course_collection_id'] = get_field('shopify_collection_in_person', get_the_ID());
          $fields['short_title'] = get_field('short_title', get_the_ID());
          $fields['description'] = get_field('description', get_the_ID());
          $fields['id'] = get_the_ID();
          $fields['title'] = get_the_title();
          $fields['link'] = get_permalink();
          array_push( $courses, $fields );
        endwhile;
      endif;
      
      return $courses;
    }


    /**
     * Returns the Private Course CPT Partial
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function privateCoursesPartial()
    {
      
      $args = array(
        'post_type' => 'courses',
        'meta_key'		=> 'course_type',
      	'meta_value'	=> 'on site'
      );
    
      $courses = array();
      $query = new WP_Query( $args );
    
      if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
          $fields['shopify_collection_location'] = get_field('shopify_collection_location', get_the_ID());
          $fields['online_course_comparison_info'] = get_field('online_course_comparison_info', get_the_ID());
          $fields['short_title'] = get_field('short_title', get_the_ID());
          $fields['description'] = get_field('description', get_the_ID());
          $fields['id'] = get_the_ID();
          $fields['title'] = get_the_title();
          $fields['link'] = get_permalink();
          array_push( $courses, $fields );
        endwhile;
      endif;
      
      return $courses;
    }


    /**
     * Returns the In Person Course CPT Partial
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function trainingLocations($location = "")
    {
      
      // Get the Training Locations from Courses CPT
      $args = array(
        'post_type' => 'training_locations',
        'posts_per_page' => -1,
        'meta_key' => 'shopify_collection_location',
        'meta_value' => $location
      );

      $locations = array();
      $query = new WP_Query( $args );
      
      if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
          $fields = [];
          $fields['id'] = get_the_ID();
          $fields['location_collection_id'] = get_field('shopify_collection_location', get_the_ID());
          $fields['title'] = get_the_title();
          $fields['link'] = get_permalink( );
          array_push( $locations, $fields );
        endwhile;
      endif;
      
      return $locations;
    }
    
    /**
     * Returns the Events CPT
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function events()
    {
      
      // Get the Training Locations from Courses CPT
      $args = array(
        'post_type' => 'events',
      );

      $events = array();
      $query = new WP_Query( $args );
      
      if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
        
          if (strtotime(get_field('date', get_the_id())) <= time()) continue;
        
          $fields = get_fields(get_the_ID());
          $fields['title'] = get_the_title();
          array_push( $events, $fields );
        endwhile;
      endif;
      
      return $events;
    }



    /**
     * Conditionally updates error message text.
     * 
     * @param string $message The existing error message.
     * 
     * @return string The updated error message.
     */
    private function filterErrorMessage($message)
    {
        
    }

    /**
     * Logs a new error.
     * 
     * @param mixed $message The error message.
     */
    private function logError($message)
    {

    }
}
