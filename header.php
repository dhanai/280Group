<?php
/**
 * Glide Theme 
 *
 * Header
 */
global $glide_acf_option_fields;
global $pID;
global $glide_acf_fields;

$pID = get_the_ID();
if (is_home()) $pID = get_option( 'page_for_posts' );
$glide_acf_option_fields = get_fields('option');
$glide_acf_fields = get_fields($pID);
$lightDark = (snag_field('mh_background') ? 'dark-header': 'light-header' );
if (is_front_page() || is_404()) $lightDark = "dark-header";
if (is_search() || is_home()) $lightDark = "light-header";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui" />
	
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Open+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> -->
  <!-- CSS  -->
  <link href="<?php echo assetDir?>/css/bundle.min.css?v=<?php echo ASSET_VERSION?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  

  <script>
   // This is for identifying the Browser type in the HTML tag 	    
    var doc = document.documentElement;
    doc.setAttribute('data-useragent', navigator.userAgent);
    doc.setAttribute("data-platform", navigator.platform );
  </script>	
   
	<?php wp_head() ?>

</head>

<body <?php body_class(array($pID, $lightDark))?>>

<section id="hello-bar" class="center-align closed">
  <div class="inner"><?php echo $glide_acf_option_fields['hello_content'] ?></div>
  <span class="hello-close"><img src="<?php print assetDir ?>/img/icon-close.svg"></span>
</section>
<?php get_search_form();?>
<header class="main valign-wrapper">

  <nav class="valign-wrapper row">

    <div class="logo-wrapper col s6 m8 l2 valign-wrapper">
      <div class="inner left-align full-width">
        <a href="/"><img src="<?php print assetDir ?>/img/logo.svg" class="logo light-logo"><img src="<?php print assetDir ?>/img/logo-dark.svg" class="logo dark-logo"></a>
      </div>
    </div>

    <div class="nav-wrapper col l8 center-align hide-on-med-and-down">
      <?php wp_nav_menu( array( 'theme_location' => 'main-nav', 'container' => '', 'menu_class' => 'main-nav nav-list', 'menu_id' => 'main-nav') );  ?>
    </div>
    
    <div class="search-wrapper col s3 m2 l2 center-align valign-wrapper">
      <div class="center-align full-width">
      <?php wp_nav_menu( array( 'theme_location' => 'cta-nav', 'container' => '', 'menu_class' => 'cta-nav nav-list  hide-on-med-and-down', 'menu_id' => 'cta-nav') );  ?>
      <i class="fa fa-search" id="header-search" aria-hidden="true"></i>
      <a href="https://shop.280group.com/cart" target="_blank"><img src="<?php print assetDir ?>/img/shopping-cart.png" class="cart-icon cart-icon-light"><img src="<?php print assetDir ?>/img/shopping-cart-dark.png" class="cart-icon cart-icon-dark"></a>
      </div>
    </div>
    
    <div class="mobile-nav-icon-wrapper col s2 m1 center-align hide-on-large-only valign-wrapper">
      <a href="#" ><i class="fas fa-bars"></i></a>
      <!-- data-target="slide-out" class="sidenav-trigger show-on-large" -->
    </div>
   
  </nav>
  
  <?php wp_nav_menu( array( 'theme_location' => 'mobile-nav', 'container' => false, 'menu_class' => 'sidenav mobile-nav', 'menu_id' => 'slide-out') );?>
      
      
</header>

