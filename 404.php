<?php
/**
 * The template for displaying 404 pages (not found)
 Template Name: 404 Page
**/

get_header(); ?>

<div class="four-oh-four default">
<div id="masthead" class="center-align has-background">
<div class="overlay"></div>
<?php $title = get_field('mh_title',13652); ?>
<h1><?php echo $title;?></h1>
</div>
<!-- CONTENT -->
<div id="breadcrumbs" class="above">
	<div class="container">
   <?php bcn_display();?> 
 </div></div>
<section class="content">
    <div class="container row">
        <div class="skinny">
        		<?php $my_postid = 13652;//This is page id or post id
				$content_post = get_post($my_postid);
				$content = $content_post->post_content;
				$content = apply_filters('the_content', $content);
				echo $content;
				?>
               <!--  <p><h4>The page you were looking for couldn't be found. Please try again by using the navigation above.</h4>
            	</p>
              <a href="javascript:history.go(-1);">Go back</a> -->
        </div>
    </div>
</section>
    
</div>


<?php get_footer() ?>