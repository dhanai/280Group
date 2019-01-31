<?php
/**
 * Glide Theme Homepage
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;
global $glide_acf_fields;
global $course;
  
$course = snag_field('shopify_collection_in_person');
$page_content = snag_field('page_content');

$course_type = snag_field('course_type');
?>

<div class="course-detail"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php  get_template_part( '/partials/masthead'); ?>



<main class="content course-detail-online">

    <div class="page-content">
    
      <div class="sidebar-wrapper">
      <div class="sidebar hide-on-med-and-down">    
  
        <ul class="section table-of-contents">
          
          <?php foreach ($page_content as $section) : ?>
              <li><a href="#<?php print strtolower(str_replace(" ", "_",$section['section_text'])) ?>"><?php print $section['section_text'] ?></a></li>
          <?php endforeach; ?>
          
          <?php if ($course_type === "Online") : ?>
            
            <li class="aux-links">
            
              <?php 
                $variant_id = snag_field('shopify_product');
                $variant_id_decoded = substr(base64_decode( $variant_id ), strrpos(base64_decode( $variant_id ), '/') + 1);
              ?>
              <a href="<?php echo snag_field('shopify_page_link') ?>" class="fallback-button btn" target="_blank">Get Started</a>
              <span id="<?php echo $variant_id_decoded ?>" class="buy-button-container" data-id-variant="<?php echo $variant_id_decoded ?>"></span>
              
              <?php echo snag_field('side_bar_extra_links'); ?>

            </li>
            
          <?php elseif ($course_type === "In Person") : ?>

            <li class="aux-links">
            
              <?php echo snag_field('side_bar_extra_links'); ?>
            
            </li>
          
          <?php endif; ?>
          
        </ul>
        
      </div>
      </div>
      
      <div class="mobile-jump-links hide-on-large-only">
        
        <select id="jumplinks">
          
          <?php foreach ($page_content as $section) : ?>
              <option value="<?php print strtolower(str_replace(" ", "_",$section['section_text'])) ?>"><?php print $section['section_text'] ?></option>
          <?php endforeach; ?>
                    
        </select>
        
      </div>
      
      <?php if ($page_content != "") : ?>
      <?php foreach ($page_content as $section) : ?>
  
        <section  id="<?php print strtolower(str_replace(" ", "_",$section['section_text'])) ?>" class="section scrollspy <?php echo $section['section_background'] ?>">
          <div class="container">
            <h2><?php print $section['title'] ?></h2>
               
            <?php if ($section['detail_elements'] != "") : ?>
            
              <?php foreach ($section['detail_elements'] as $element) : ?>
    
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
      var vID = parseInt($(this).attr('data-id-variant'));
      
      ui.createComponent('product', {
        //id: vID+'a',
        id: vID,
        node: document.getElementById(this.id),
        options: {
          product: {
            iframe: true,
            buttonDestination: 'modal',
            text: {
              button: "Get Started",
            },
            width: '200px',
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
                'width': '200px',
                'padding': '12px 10px',
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
    
    $("#jumplinks").on("change", function() {
      console.log($(this).val());
      var element = document.getElementById($(this).val());
      element.scrollIntoView(true);
      
    }) 
     
    $('.sidebar').stickybits({stickyBitStickyOffset: 170});
  
  })

  /* Light YouTube Embeds by @labnol */
  /* Web: http://labnol.org/?p=27941 */

  document.addEventListener("DOMContentLoaded",
      function() {
          var div, n,
              v = document.getElementsByClassName("youtube-player");
          for (n = 0; n < v.length; n++) {
              div = document.createElement("div");
              div.setAttribute("data-id", v[n].dataset.id);
              div.innerHTML = labnolThumb(v[n].dataset.id);
              div.onclick = labnolIframe;
              v[n].appendChild(div);
          }
      });

  function labnolThumb(id) {
      var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
          play = '<div class="play"></div>';
      return thumb.replace("ID", id) + play;
  }

  function labnolIframe() {
      var iframe = document.createElement("iframe");
      var embed = "https://www.youtube.com/embed/ID?autoplay=1";
      iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
      iframe.setAttribute("frameborder", "0");
      iframe.setAttribute("allowfullscreen", "1");
      this.parentNode.replaceChild(iframe, this);
  }

</script>





