<?php
/**
 * Glide Theme - CPT Page for training locations
 */


get_header(); 
?>
<style type="text/css">

.acf-map {
  width: 100%;
  height: 400px;
  border: #ccc solid 1px;
  margin: 20px 0;
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>
<?php 

global $pID;
global $glide_acf_option_fields;

$location = get_field('shopify_collection_location');

?>


<div class="courses-page inperson-courses-calendar"><!-- PAGE IDENTIFIER TAG -->


<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<?php 

//GET DATA FOR PAGE
$responsearray = $shopifyApi->getInPersonCourses();
$locations = $themeCPT->trainingLocations($location);
$courses = $themeCPT->courses('in person');


?>

<main class="content">
  
  <section class="container list-container">

    <table id="course-table" class="compact"  style="width:100%">
      <thead>
        <tr>
          <th>Dates</th>
          <th>Location</th>
          <th>Course</th>
          <th class="actions-column">Registration</th>
        </tr>
      </thead>    
    <tbody>
    
  <?php 
    
  function search_cpt_array($array, $key, $val) {
    foreach ($array as $item) {
        if (is_array($item) && search_cpt_array($item, $key, $val)) return $item;
        if (isset($item[$key]) && $item[$key] == $val) return $item;
    }
    return "";
  }
  
  function return_link_from_array($array, $classes="", $text="") {
    if (is_array($array)) return sprintf("<a href='%s' class='%s'>%s</a>", $array['link'], $classes, ($text !== "" ? $text :$array['title']));
    else return "";
  }
  
    foreach($responsearray["data"]["shop"]["collectionByHandle"]["products"]["edges"] as $row) {
      
      $fallback_link = $row['node']['onlineStoreUrl'];
      
      foreach ($row['node']['variants'] as $variant) {
        
        foreach ($variant as $item) {
          
          $product_id = $item['node']['product']['id']; 
          $product_id_decoded = substr(base64_decode( $product_id ), strrpos(base64_decode( $product_id ), '/') + 1);
          $product_title = $item['node']['product']['title'];
          $variant_id = $item['node']['id']; 
          $variant_id_decoded = substr(base64_decode( $variant_id ), strrpos(base64_decode( $variant_id ), '/') + 1);
          $time_stamp = $item['node']['sku'];
          $matching_location = "";
          $matching_course = ""; 
          
          foreach ($item['node']['product']['collections']['edges'] as $collection) {
            if ($matching_course === "") $matching_course = search_cpt_array($courses, "course_collection_id", $collection['node']['id']);
            if ($matching_location === "") $matching_location = search_cpt_array($locations, "location_collection_id", $collection['node']['id']);
          }
          //if ($matching_location['shopify_collection_location'] !== $location) continue;
    
          $rowString = "";
          $rowString .= "<tr>";
          $rowString .= "<td data-sort=".$time_stamp."><span class='sold-out'>Sold Out</span>".$item['node']['title']."</td>";
          $rowString .= "<td>".return_link_from_array($matching_location)."</td>";
          //$rowString .= "<td>".$product_title."</td>";
          $rowString .= "<td>";
          $rowString .= return_link_from_array($matching_course);
          $rowString .= "</td>";
        
          //$rowString .= "<td><div id='sb-".$variant_id_decoded."'class='buy-button-container' data-id-product='".$product_id_decoded."' data-id-variant='".$variant_id_decoded."'>".return_link_from_array($matching_course, "btn btn-secondary", "Course Info")."</div></td>";
          $rowString .= "<td><div id='sb-".$variant_id_decoded."'class='buy-button-container' data-id-product='".$product_id_decoded."' data-id-variant='".$variant_id_decoded."'>".return_link_from_array($matching_course, "btn btn-secondary", "Course Info")."<a href='".$fallback_link."?variant=".$variant_id_decoded."' class='fallback-button btn' target='_blank'>Register</a></div></td>";
          $rowString .= "</tr>";
            
          if ($time_stamp !== "" && $time_stamp >= time()  && $matching_course !== "" && $matching_location !== "") {
            print $rowString;
          }
        }
      }
    }
    
    
  ?> 
          </tbody>
    </table>

  </section>
 
  <section class="map-section">
    <?php $location = get_field('venue_location',$pID); 
    if( !empty($location) ):
?>
<div class="acf-map">
  <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
</div>
<?php endif; ?>
 
    <?php //print_r($location);  ?>
 
  </section>
 
  <section class="faq-section">
    
    <div class="container">
      
      <h2 class="center-align"><?php echo snag_field('faq_title'); ?></h2>

      <div class="copy"><?php echo snag_field('faq'); ?></div>
    </div>    
    
  </section> 
 
  
  <section class="course-cards center-align">
    
    <div class="container">
      <h2><?php echo snag_field('course_cards_title'); ?></h2>
    <?php $item = snag_field('course_cards'); ?>

    <?php if ($item != "") : ?>

      <?php  get_template_part( '/partials/element', 'course_cards'); ?>
    
    <?php endif; ?>
    </div>    
    
  </section>
  
  
  <div class="text-section">

    <div class="container center-align">

      <h2><?php echo $glide_acf_option_fields['training_locations_footer_message_title']; ?></h2>
      
      <div class="copy"><?php echo $glide_acf_option_fields['training_locations_footer_message_copy']; ?></div>
      
      <?php echo build_acf_button($glide_acf_option_fields['training_locations_footer_message_button'], 'btn'); ?>
      
    </div>    
    
  </div>
</main>

<?php
get_footer();
?>


<script>
  var courses;
  $(document).ready(function() {
  
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
        id: [$(this).attr('data-id-product')],
        variantId: vID,      
        node: document.getElementById(this.id),
        options: {
          product: {
            iframe: false,
            buttonDestination: 'modal',
            text: {
              button: "Register",
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
                $(component.node).css('display','inline-block').find('a.fallback-button').hide();
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
      
      var item = $(this);
      setTimeout(function(){
        if (item.find("button").is(":disabled")) {
          item.parent().parent().find('.sold-out').show();  
        }
      }, 2000);
             
     
    })  
*/
    
    $.extend( true, $.fn.dataTable.defaults, {
        "searching": false,
        "info":     false,
        "pageLength": 20,
        "paging": false,
        "lengthChange": false,
        "order": [[ 0, 'asc' ]]
    } );
    
    $('#course-table').DataTable();
    
    $('#course-table').on('page.dt', function () {
      $("html, body").animate({ scrollTop: 0 }, "fast");
    } )
    
  
  })


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT9WWycVW1AivP7Z4lQld7FwC8b14oSM0"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param $el (jQuery element)
*  @return  n/a
*/

function new_map( $el ) {
  
  // var
  var $markers = $el.find('.marker');
  
  
  // vars
  var args = {
    zoom    : 16,
    center    : new google.maps.LatLng(0, 0),
    mapTypeId : google.maps.MapTypeId.ROADMAP
  };
  
  
  // create map           
  var map = new google.maps.Map( $el[0], args);
  
  
  // add a markers reference
  map.markers = [];
  
  
  // add markers
  $markers.each(function(){
    
      add_marker( $(this), map );
    
  });
  
  
  // center map
  center_map( map );
  
  
  // return
  return map;
  
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param $marker (jQuery element)
*  @param map (Google Map object)
*  @return  n/a
*/

function add_marker( $marker, map ) {

  // var
  var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

  // create marker
  var marker = new google.maps.Marker({
    position  : latlng,
    map     : map
  });

  // add to array
  map.markers.push( marker );

  // if marker contains HTML, add it to an infoWindow
  if( $marker.html() )
  {
    // create info window
    var infowindow = new google.maps.InfoWindow({
      content   : $marker.html()
    });

    // show info window when marker is clicked
    google.maps.event.addListener(marker, 'click', function() {

      infowindow.open( map, marker );

    });
  }

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param map (Google Map object)
*  @return  n/a
*/

function center_map( map ) {

  // vars
  var bounds = new google.maps.LatLngBounds();

  // loop through all markers and create bounds
  $.each( map.markers, function( i, marker ){

    var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

    bounds.extend( latlng );

  });

  // only 1 marker?
  if( map.markers.length == 1 )
  {
    // set center of map
      map.setCenter( bounds.getCenter() );
      map.setZoom( 16 );
  }
  else
  {
    // fit to bounds
    map.fitBounds( bounds );
  }

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type  function
*  @date  8/11/2013
*  @since 5.0.0
*
*  @param n/a
*  @return  n/a
*/
// global var
var map = null;

$(document).ready(function(){

  $('.acf-map').each(function(){

    // create map
    map = new_map( $(this) );

  });

});

})(jQuery);
</script>




