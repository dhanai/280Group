<?php
/**
 * Glide Theme 
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;
global $glide_acf_fields;

?>

<div class="product-detail"><!-- PAGE IDENTIFIER TAG -->

<main class="content container row">

  <div class="sidebar col l4 s12 center-align">    
    <?php
      //echo $img_id;
       $image = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'medium' );
      //$img_id = get_the_post_thumbnail_url($pID)!="" ? glide_get_image_id(get_the_post_thumbnail_url($pID)) : "";
      //$image = wp_get_attachment_image($img_id, 'product-detail');
    ?>
    
    <?php echo '<img src="'.$image[0].'">'; ?>
    
    <?php if (snag_field('type') == "template") : ?>
      <h2><?php echo snag_field('price'); ?></h2>
    
      <?php 
        $product_id = snag_field('shopify_toolkit_product'); 
        $product_id_decoded = substr(base64_decode( $product_id ), strrpos(base64_decode( $product_id ), '/') + 1);      
      ?>
      
      
      <a href="<?php echo snag_field('shopify_page_link') ?>" class="fallback-button btn" target="_blank">Buy Now</a>
      <?php echo "<div id='sb-".$product_id_decoded."' class='buy-button-container' data-id-product='".$product_id_decoded."' ></div>"; ?>
      
      <div class="shopify-btn-holder"></div>
      
    <?php else : ?>

      <h2><?php echo snag_field('price'); ?></h2>

      <?php if (snag_field('product_link') != "") : ?>
      
        <?php echo build_acf_button(snag_field('product_link'), 'btn'); ?>      
        
      <?php endif; ?>

    <?php endif; ?>
    
    

  </div>
      
  <div class="col l8 s12 page-content">
    
    <h1><?php echo get_the_title(); ?></h1>

    <div class="subtitle"><?php echo snag_field('subtitle'); ?></div>
    
    <div class="prod-content"><?php echo snag_field('product_content'); ?></div>
    
  </div>

</main>

<?php
get_footer();
?>

<script>
  var courses;
  $(document).ready(function() {

    $('.scrollspy').scrollSpy();
    
/*
    var client = ShopifyBuy.buildClient({
      domain: 'the-280-group.myshopify.com', // ex 'storename.myshopify.com'
      apiKey: 'fc7518a103bd7a7c7eb727ff68d0a1c5',
      appId: '6'
    });
    var ui = ShopifyBuy.UI.init(client);
    
    $.each($('.buy-button-container'), function(){
      var pID = parseInt($(this).attr('data-id-product'));
      
      ui.createComponent('product', {
        id: pID,
        node: document.getElementById(this.id),
        options: {
          product: {
            iframe: true,
            buttonDestination: 'modal',
            text: {
              button: "Buy Now",
            },
            contents: {
              img: false,
              imgWithCarousel: false,
              title: false,
              variantTitle: false,
              price: false,
              options: false,
              quantity: false,
              quantityIncrement: false,
              quantityDecrement: false,
              quantityInput: true,
              button: true,
              buttonWithQuantity: false,
              description: false,
            },
            events: {
              'afterRender': function (component) {
                $(component.node).css('display','inline-block').prev('a.fallback-button').hide();
              },
            },
          styles: {
            button: {
              'color': '#fff',
              'background-color': '#faad3e',
              'font-family': "Arial",
              'font-weight': "900",
              'font-size': '18px',
              ":hover": {
                'background-color': '#faad3e',
              },
              ":active": {
                'background-color': '#faad3e',
              },
              ":focus": {
                'background-color': '#faad3e',
              }
            }
          }            
          },
modalProduct: {
            iframe: false,
            contents: {
              img: true,
              imgWithCarousel: false,
              title: true,
              variantTitle: false,
              price: true,
              options: true,
              quantity: true,
              quantityIncrement: true,
              quantityDecrement: true,
              quantityInput: true,
              button: false,
              buttonWithQuantity: true,
              description: true,              
            },
          },  
          
          cart: {
            iframe: true,
            startOpen: false,
            popup: false,
            contents: {
              title: true,
              lineItems: true,
              footer: true,
            },
            
          }
        }
      });           
  
    })  
*/
    
  
  })


</script>





