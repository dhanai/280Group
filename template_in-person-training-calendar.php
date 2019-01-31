<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: In Person Training Calendar
 */

get_header(); 

global $pID;
global $glide_acf_option_fields;

?>

<div class="courses-page inperson-courses-calendar"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>

<?php 

//GET DATA FOR PAGE
$responsearray = $shopifyApi->getInPersonCourses();
$locations = $themeCPT->trainingLocations();
$courses = $themeCPT->courses('in person');


?>

<script type='text/javascript'>
  var courses_array;
  <?php
    $js_array = json_encode($courses);
    echo "var courses_array = ". $js_array . ";\n";
  ?>
</script>

<section class="content">

  <section class="list-filters center-align">
    
    <div class="container left-align">Filter By: <span class="select-boxes"></span> </div>
    
  </section>
    

  <div class="container list-container">

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
        
        if (isset($_GET['course_id'])) {
          if ($matching_course['course_collection_id'] != $_GET['course_id']) { continue; }  
        }
          
        $rowString = "";
        $rowString .= "<tr>";
        $rowString .= "<td data-sort=".$time_stamp."><span class='sold-out'>Sold Out</span>".$item['node']['title']."</td>";
        $rowString .= "<td class='location-column' data-filter='".$matching_location['title']."'>".return_link_from_array($matching_location)."</td>";
        $rowString .= "<td  data-filter='".$matching_course['title']."'>";
        $rowString .= return_link_from_array($matching_course);
        $rowString .= "</td>";
      
        $rowString .= "<td><div id='sb-".$variant_id_decoded."'class='buy-button-container' data-id-product='".$product_id_decoded."' data-id-variant='".$variant_id_decoded."'>".return_link_from_array($matching_course, "btn btn-secondary", "Course Info")."<a href='".$matching_location['link']."' class='btn btn-secondary'>Venue Info</a><a href='".$fallback_link."?variant=".$variant_id_decoded."' class='fallback-button btn' target='_blank'>Register</a></div></td>";
        $rowString .= "</tr>";
  
        if ($time_stamp !== "" && $time_stamp >= time() && $matching_course !== "") {
          print $rowString;
        }
      }
    
    }
  }
  
  
  ?> 
      
      </tbody>
  
    </table>

  </div>
  
  <div class="text-section">

    <div class="container center-align">

      <h2><?php echo snag_field('text_title'); ?></h2>
      
      <div class="copy"><?php echo snag_field('text_copy'); ?></div>
      
      <?php echo build_acf_button(snag_field('button'), 'btn'); ?>
      
    </div>    
    
  </div>
  
  
</section>

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
        //id: [$(this).attr('data-id-product')]+"a",
        variantId: vID,      
        node: document.getElementById(this.id),
        options:  {
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
            },
          },
          option: {
            templates: {
              option: "<div class={{data.classes.option.option}}>\n    <label class=\"{{data.classes.option.label}} {{#data.onlyOption}}{{/data.onlyOption}}\">{{data.name}}</label>\n      <div class=\"{{data.classes.option.wrapper}}\">\n      <select class=\"{{data.classes.option.select}}\" name=\"{{data.name}}\">\n        {{#data.values}}\n          <option {{#selected}}selected{{/selected}} value=\"{{name}}\">{{name}}</option>\n        {{/data.values}}\n      </select>\n      <svg class=\"{{data.classes.option.selectIcon}}\" viewBox=\"0 0 24 24\"><path d=\"M21 5.176l-9.086 9.353L3 5.176.686 7.647 12 19.382 23.314 7.647 21 5.176z\"></path></svg>\n    </div>\n  </div>"

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
        "searching": true,
        "info":     false,
        "pageLength": 12,
        "lengthChange": false,
        "pagingType": "numbers",
        //"scrollX": true,
        "order": [[ 0, 'asc' ]],
    } );
    
    var dataTable = $('#course-table').DataTable({
      initComplete: function () {
        
        this.api().columns(1).every( function () {
          
          var column = this;
          var select = $('<select class="browser-default"><option value="">Location</option></select>').appendTo( $(".list-filters .select-boxes") ).on( 'change', function () {
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );
            column.search( val ? '^'+val+'$' : '', true, false ).draw();
          });
          
          column.data().unique().sort().each( function ( d, j ) {
              d = d.replace(/<(.|\n)*?>/g, '');
              select.append( '<option value="'+d+'">'+d+'</option>' )
          } );
        });
        
        /*
this.api().columns(2).every( function () {
          
          var column = this;
          var select = $('<select class="browser-default"><option value="">Course</option></select>').appendTo( $(".list-filters .select-boxes") ).on( 'change', function () {
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );
            column.search( val ? '^'+val+'$' : '', true, false ).draw();
          });
          
          column.data().unique().sort().each( function ( d, j ) {
              d = d.replace(/<(.|\n)*?>/g, '');
              select.append( '<option value="'+d+'">'+d+'</option>' );
          } );
        });
*/
        
      }
      
      
    });
    
    $('#course-table').on('page.dt', function () {
      $("html, body").animate({ scrollTop: 0 }, "fast");
    } )
    
  })


</script>





