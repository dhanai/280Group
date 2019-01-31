<?php
get_header(); 
$pID = get_the_ID();

?>

<div class="search-page"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php //include(locate_template('partials/masthead-search.php')); ?>


<section id="masthead" class="search-masthead center-align">
  <div class="inner valign-wrapper ">
  <div class="container">
  <h1>Search results for "<?php echo $_GET['s'] ?>"</h1>
  </div>
  </div>
</section>

<main class="content">

  <div class="container">
<!--
          <div class="page-links">
        <a href="/?s=<?php echo $_GET['s'];?>" class="<?php echo ($_GET['post_type']=="" ? 'active': '');?>">All Posts</a>
        <a href="/?s=<?php echo $_GET['s'];?>&post_type=product" class="<?php echo ($_GET['post_type']=="product" ? 'active': '');?>">Products</a>
        <a href="/?s=<?php echo $_GET['s'];?>&post_type=page" class="<?php echo ($_GET['post_type']=="page" ? 'active': '');?>">Articles</a>
        <a href="/?s=<?php echo $_GET['s'];?>&post_type=post" class="<?php echo ($_GET['post_type']=="post" ? 'active': '');?>">Blog Posts</a>
      </div>
-->
    
      


  <?php
  if( have_posts() && isset($_GET['s']) && $_GET['s'] !== ""){
    
    ?>
    <div class="search-results">
    <?php
    
    while( have_posts() ){ the_post();
            
      $post_type = get_post_type();
      
      $description = "";
      
      $words = 25;
      
      switch ($post_type) {
        case 'courses':
            $description = wp_trim_words(get_field('description'), $words);
            break;
        case "products":
            $description = wp_trim_words(get_field('short_description'), $words);
            break;
        case "post":
            $description = wp_trim_words(get_the_content(), $words);
            break;
        case "team_member":
            $description = wp_trim_words(get_the_content(), $words);
            break;
        case "case_studies":
            $description = wp_trim_words(get_field('description'), $words);
            break;         
        case "page":
            $description = wp_trim_words(get_the_content(), $words);
            break;                        
      }
    ?>  
      
      <a href="<?php echo get_the_permalink(); ?>" class="search-result">

        <h3><?php echo get_the_title() ?></h3>

        <div class="description">
        
          <?php echo do_shortcode($description); ?>          
          
        </div>        

      </a>
      
    <?  
    }
  ?>
    
      </div>

      <?php load_more_button(); ?>

  		
  <?php
    
    
    
  } else if (isset($_GET['s'])  && $_GET['s'] !== "") {
    //Has no posts
  ?>
    <div class="no-results">
      Sorry, there no results matching your search.
    </div>
  <?php  
  } // End if Have Posts
  ?>

  </div>
</section>

<?php
get_footer();
?>




