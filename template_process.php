<?php
/**
 * Glide Theme Homepage
 *
 * Template Name: Process/Framework
 */


get_header(); 

global $pID;
global $glide_acf_option_fields;
global $glide_acf_fields;

$page_content = snag_field('list_items');

?>




<div class="toolkit-page process-framework"><!-- PAGE IDENTIFIER TAG -->

<!-- MASTHEAD -->
<?php include(locate_template('partials/masthead.php')); ?>


<main class="content">

  <div class="intro-content  center-align">
    
    <div class="container skinny">
      <?php echo snag_field('intro_content'); ?>
    </div>
  </div>


  <div class="interactive-process container hide-on-med-and-down">
    <h2>Learn About Our Product Management Process</h2>

    <div class="subtitle">Hover over each block for more info.</div>
    
    <div class="table-container">
      <table cellspacing=0 cellpadding=0>
        <tr><td colspan=8 class="title"><h3>Optimal Product Process (OPP)</h3></td></tr>
        <tr class="subtitles">
          <td colspan=3>STRATEGY</td>
          <td colspan=5>EXECUTION</td>
        </tr>      
        <tr class="subtitles-brackets">
          <td colspan=3></td>
          <td colspan=5></td>
        </tr>
        <tr>
          <td colspan=3 class="bdr-left bdr-right"></td>
          <td colspan=5 class="bdr-right"></td>
        </tr>
        <tr>
          <td rowspan=4 class="descriptor right-line">Product Management</td>
          <td colspan=2 class="med-blue tooltip" title="The <b>Business Case Document</b> captures the reasoning for initiating a project and determines if the effort should proceed based on profitability and strategic fit.">
            Business Case Document
          </td>
          <td colspan=4></td>
        </tr>
        <tr>
          <td colspan=2 class="med-blue  tooltip" title="The <b>Market Needs Document</b> describes the business or consumer challenges to be solved through an analysis of market needs, user personas and usage scenarios. The OPP Market Needs Document is the equivalent of a Market Requirements Document (MRD).">
            Market Needs Document
          </td>
          <td colspan=4></td>
        </tr>
        <tr>
          <td colspan=2 class="med-blue tooltip" data-position="right" title="The <b>Product Description Document</b> includes the whole solution’s feature set, expected usage, technology and delivery requirements as well as the initial scoping of development costs. The OPP Product Description Document is the equivalent of a Product Requirements Document (PRD).">
            Product Description Document
          </td>
          <td colspan=4></td>
        </tr>
        <tr>
          <td colspan=2 class="med-blue tooltip" data-position="right" title="The <b>Roadmap Document</b> shows the long-term product strategy and includes a set of releases based on scoping, features and business objectives.">
            Roadmap Document
          </td>
          <td class="lt-blue tooltip" data-position="bottom" title="The <b>Beta Plan</b> outlines a program for real-world testing in order to gather early customer feedback, collect testimonials/reviews and ensure the product is ready for launch.">
            Beta Plan
          </td>
          <td colspan=4></td>
        </tr>     
        <tr>
          <td class="descriptor">
            Product Marketing
          </td>
          <td colspan=2 class="med-blue tooltip" data-position="right" title="The <b>Market Strategy Document</b> includes long-term objectives in the marketplace, product positioning and messaging to be conveyed to target markets.">
            Market Strategy Document
          </td>
          <td></td>
          <td class="lt-blue tooltip" data-position="top" title="The <b>Launch Plan</b> specifies programs and tactics for achieving agreed upon goals when the product is released into the marketplace.">
            Launch Plan
          </td>
          <td class="lt-blue tooltip" data-position="top" title="The <b>Marketing Plan</b> includes follow-on marketing programs, budgets, timelines and activities that will support sales, lead generation and reaching new customers in the marketplace.">
            Marketing
          </td>
          <td class="lt-blue tooltip" data-position="top" title="The <b>End of Life Plan</b> specifies how to discontinue or replace a product in the marketplace so that current customers have a smooth transition and the company avoids negative consequences.">
            End of Life
          </td>
          <td></td>
        </tr>
        <tr class="medium">
          <td class="descriptor">
            Exit Criteria
          </td>
          <td class="dark-blue tooltip" data-position="top" title="The company agrees to provide the funding and resources to proceed in to the <b>Plan</b> phase and gain a deeper understanding of the key parameters of proceeding with the project.">
            Approval to fund business planning
            </td>
          <td class="dark-blue tooltip" data-position="top" title="The company agrees the opportunity is viable, profitable and enough of a strategic fit to move into the <b>Develop</b> phase and fully fund product development.">
            Approval to fund development
          </td>
          <td class="dark-blue tooltip" data-position="top" title="Key stakeholders and the development team agree that the product is ready to move in to the <b>Qualify</b> phase for beta testing with real customers.">
            Product ready for field testing
          </td>
          <td class="dark-blue tooltip" data-position="top" title="Key stakeholders and the product team review the beta program and agree that the product fulfills the overall quality levels necessary to move into the <b>Launch</b> phase and release the product into the marketplace.">
            Product and organization ready
          </td>
          <td class="dark-blue tooltip" data-position="top" title="The company reviews the product launch and agrees to move into the <b>Maximize</b> phase and spend additional resources if necessary to achieve longer-term revenue, profit and strategic goals.">
            On-going marketing ready
          </td>
          <td class="dark-blue tooltip" data-position="top" title="The company reviews the product’s strategic importance and performance in the marketplace to determine if it should be updated by returning to the <b>Conceive</b> phase or discontinued and move into the <b>Retire</b> phase.">
            New version or retire completely
          </td>
          <td></td>
        </tr>
        <tr class="large">
          <td class="descriptor">Phases and Activities</td>
          <td class="med-blue tooltip" data-position="top" title="In the <b>Conceive</b> phase a company is generating new ideas in order to evaluate and prioritize them to determine whether to move forward and spend time/resources.">
  
            <b>Conceive</b>
            
            <p>Discover opportunities</p>
  
            <p>Validate product market fit</p>
            
            <p>Develop preliminary documents</p>
  
          </td>
          <td class="med-blue tooltip" data-position="top" title="In the <b>Plan</b> phase all critical questions about strategy and business are addressed before receiving full funding and moving into development.">
            <b>Plan</b>
            
            <p>Create roadmap and strategy</p>
  
            <p>Finish business plans</p>
  
            <p>Deliver final documents</p>
              
          </td>
          <td class="lt-blue tooltip" data-position="top" title="In the <b>Develop</b> phase the product team creates a product that will be “above the bar” in terms of what must be delivered to customers in order to achieve the company’s profitability/strategic goals.">
            <b>Develop</b>
            
            <p>Solidify develop plans</p>
  
            <p>Finish beta plan</p>
            
            <p>Final feature list</p>
            
          </td>
          <td class="lt-blue tooltip" data-position="top" title="In the <b>Qualify</b> phase the product team runs internal and external beta testing to determine if the product meets the required level of quality to fulfill the overall product objectives in the eyes of the customer. ">
            <b>Qualify</b>
            
            <p>Run beta/pilot program</p>
  
            <p>Finish launch plan</p>
  
            <p>Test messaging and positioning</p>
            
          </td>
          <td class="lt-blue tooltip" data-position="top" title="In the <b>Launch</b> phase a company officially releases a product into the marketplace and implements launch and marketing programs to generate initial awareness around the new product.">
            <b>Launch</b>
            
            <p>Release product, gather feedback</p>
  
            <p>Finish marketing plan</p>
              
            <p>Perform post mortem</p>
              
          </td>
          <td class="lt-blue tooltip" data-position="top" title="In the <b>Maximize</b> phase Product Marketing implements new marketing programs to generate more interest, supports sales and ensure that the product is as successful as possible.">
            <b>Maximize</b>
            
            <p>Run/monitor marketing</p>
  
            <p>Support sales</p>
            
            <p>Plan EOL and next release</p>
            
          </td>
          <td class="lt-blue tooltip" data-position="top" title="In the <b>Retire</b> phase a company determines how to effectively discontinue a product and support current customers by communicating end-of-life and providing a replacement product or sunset plan.">
            <b>Retire</b>
            
            <p>Communicate EOL</p>
  
            <p>Plan sunset or replacement</p>
            
            <p>Perform post mortem</p>
            
          </td>
  
        </tr>
  
        <tr>
          
          <td></td>
          
        </tr>
  
  
        <tr class="footer-title-bracket-container">
          
          <td></td>
          
          <td colspan=6 class="footer-title-bracket"></td>
          
          <td></td>
  
        </tr> 
  
        <tr>
          
          <td></td>
          
          <td colspan=6 class="tooltip footer-title" data-position="top" title="Product Management and Engineering work together in the Plan, Develop and Qualify phases. When doing Agile development (rather than waterfall/phase-gate) the company goes through the Plan, Develop and Qualify phases much more rapidly with a smaller set of features for each sprint.">
            PM + Engineering (Agile, Hybrid, Waterfall)
          </td>
          
          <td></td>
  
        </tr> 
  
        <tr>
          
          <td class="floating-content tooltip" data-position="left" title="<b>Development: Agile, Hybrid, Waterfall</b><br><p>The Optimal Product Process allows companies to do the business and strategy work regardless of the development methodology being used.</p><b>Documentation: None, Lightweight, Formal</b><br><p>The Optimal Product Process allows documentation to be very formal in circumstances where a company culture or team requires extensive written documentation for each phase.</p><b>Maturity: Startup, Small/Medium, Enterprise</b><br><p>Regardless of the size and complexity of a company, the same questions in each of the phases and core documents need to be addressed.</p>">
          
          <p>The OPP framework is completely customizable and flexible, making it easily adopted by any company regardless of size, maturity, or development methodology.</p>
  
          <p>
          Development - Agile, Hybrid, Waterfall<br>
          Documentation - None, Lightweight, Formal<br>
          Maturity - Startup, Small/Medium, Enterprise<br>
          </p>
          
          </td>
          
        </tr>
        
      </table>
    
    </div> 
   
    
    
  </div>
 

 
  <?php $page_content = snag_field('toolkit_page_content'); ?>
 
  <?php if ($page_content != "") : ?>
    <?php foreach ($page_content as $section) : ?>
    
      <section  class="section <?php echo $section['section_background'] ?> bottom-border-<?php echo $section['bottom_border'] ?>">
        
        <div class="container">
          <h2 class="section-title"><?php print $section['title'] ?></h2>
             
          <?php if ($section['toolkit_elements'] != "") : ?>
          
            <?php foreach ($section['toolkit_elements'] as $element) : ?>
    
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
 
 
     
</main>

<?php
get_footer();
?>



