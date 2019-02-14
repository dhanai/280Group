<?php
/**
 * The template for displaying the footer
 */

global $glide_acf_option_fields;
global $glide_acf_fields;
global $pID;

?>

<div class="container back-to-top-wrapper">
  <div id="back_to_top"><a href="#top"><span>&#8593;</span> Back to Top</a></div>  
</div>

<div id="footer-cta">
  <div class="container center-align">
    
    <?php $cta_links = $glide_acf_option_fields['cta_links'] ?>
    <?php if ($cta_links != "") : ?>
      
      <?php foreach ($cta_links as $link) : ?>
        <a href="<?php print $link['link']['url'] ?>" target="<?php print $link['link']['target'] ?>">
          <?php if ($link['image'] != "") : ?>
            <div class="img-wrapper valign-wrapper"><img src="<?php print $link['image']['sizes']['cta-icon'] ?>"></div>
          <?php endif; ?>
          <span><?php print $link['link']['title'] ?></span>
        </a>
      <?php endforeach; ?>
      
    <?php endif; ?>
      
  </div>
  
</div>


</div> <!-- CLOSING THE PAGE IDENTIFIER TAG -->

<footer>

  <div class="container row">
    
    <div class="col s12">
      
      <?php wp_nav_menu( array( 'theme_location' => 'footer-nav', 'menu_class' => 'footer-nav') );  ?>
      
      <div class="row">
        <div class="col l6 s12 left-align form-wrapper"><?php echo $glide_acf_option_fields['form'] ?></div>
        <div class="col l6 s12 right-align social-container">
          
          <?php $socials = $glide_acf_option_fields['footer_social_links'] ?>
          <?php if ($socials != "") : ?>
            <?php foreach ($socials as $social) : ?>
              <a href="<?php echo $social['link']['url'] ?>" target="<?php echo $social['link']['target'] ?>" alt="<?php echo $social['link']['title'] ?>">
                <i class="fab <?php echo $social['icon'] ?>"></i>
              </a>
            <?php endforeach; ?>
            
          <?php endif; ?>          
          
          
          
        </div>
      </div>
      
    </div>

  </div>
  
  <div class="legal-wrapper center-align">
      
    <div class="row container">
      <div class="col l6 s12 left-align"><?php wp_nav_menu( array( 'theme_location' => 'legal-nav', 'menu_class' => 'legal-nav', ) );  ?></div>
      <div class="col l6 s12 right-align social-container">
        
        <div class="copyright">
          <? echo do_shortcode(get_field('footer_legal_text','option'))?>
        </div>

      </div>
    </div>
  </div>  

  <div class="hidden-button-wrapper" style="position: relative;">

  <div class="hidden-shopify-button" style="display: block;"></div>

  </div>


</footer>

<div id="start-here-modal" class="modal">
  
  <div class="modal-content">
    
    <a href="#!" class="modal-close">&#10005;</a>
    
    <div class="row">

      <?php $cards = $glide_acf_option_fields['start_here_cards']; ?>
      
      <?php if ($cards != "") : ?>

        <?php foreach ($cards as $item) : ?>
                                
          <div class="col l4 s12">
            
            <a href="<?php echo $item['button']['url'] ?>" class="card">
            
              <div class="card-header valign-wrapper">
            
                <h4><?php echo $item['title'] ?></h4>
            
              </div>
              
              <div class="card-footer center-align">
              
                <span class="btn"><?php echo $item['button']['title'] ?></span>
              
              </div>
            
            </div>
          
          </a>                                  
                                
        <?php endforeach; ?>

      <?php endif; ?>
      
    </div>

  </div>

</div>

<div id="start-here-modal-minimal" class="modal">
  
  <div class="modal-content">
  
    <a href="#!" class="modal-close">&#10005;</a>
  
    <div class="row">

      <?php $cards = $glide_acf_option_fields['start_here_cards']; ?>
      
      <?php if ($cards != "") : ?>
      
        <?php $i = 1; ?>        
      
        <?php foreach ($cards as $item) : ?>
          
          <?php if ($i == 1) { $i++; continue;} ?>
          
          <div class="col l6 s12">
  
            <a href="<?php echo $item['button']['url'] ?>" class="card">
  
              <div class="card-header valign-wrapper">
  
              <h4><?php echo $item['title'] ?></h4>
  
              </div>
  
              <div class="card-footer center-align">
  
                <span class="btn"><?php echo $item['button']['title'] ?></span>
  
              </div>
  
            </a>
  
          </div>                                  
          <?php $i++; ?>                
        <?php endforeach; ?>
      <?php endif; ?>
      
    </div>
  </div>
</div>

<?php wp_footer() ?>

<Script>
$(document).ready(function(){
/*

  var client = ShopifyBuy.buildClient({
    domain: 'the-280-group.myshopify.com',
    apiKey: 'fc7518a103bd7a7c7eb727ff68d0a1c5',
    appId: '6'
  });
  
  var ui = ShopifyBuy.UI.init(client);
  
  
  
  $.each($('.hidden-shopify-button'), function(){
  
    try {
      var pass = false;
      
      ui.createComponent('product', {
        id: 7933049797,
        node: document.getElementById(this.id),
        options: {
          product: {
            buttonDestination: "cart",
            iframe: true,
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
              quantityInput: false,
              button: false,
              buttonWithQuantity: false,
              description: false,
            },
            layout: "horizontal",
            classes: {
              footer: 'product-footer',
            },
            events: {
              'afterRender': function (component) {
                pass = true;
              },
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
      
      if (!pass) throw "buy button error";
    }
    catch(err) {
        console.log(err);
    }  
  
             
  })  
*/
  

});    
</script>  

</body>
</html>
<script type ="text/javascript">
jQuery(document).ready(function(){

// Select and loop the container element of the elements you want to equalise
jQuery('.row').each(function(){  
  
  // Cache the highest
  var highestBox = 0;
  
  // Select and loop the elements you want to equalise
  jQuery('.product-wrapper', this).each(function(){
    
    // If this box is higher than the cached highest then store it
    if(jQuery(this).height() > highestBox) {
      highestBox = jQuery(this).height(); 
    }
  
  });  
        
  // Set the height of all those children to whichever was highest 
  jQuery('.product-wrapper',this).height(highestBox);
                
}); 

});
</script>