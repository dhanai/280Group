<div class="row">
<?php 
  global $item;

  foreach($item['cards'] as $card) : ?>

    <div class="col s12 m4">
      <div class="card">
        <div class="card-content">
          <h3 class="card-title"><?php echo $card['title'] ?></h3>
          <div class="subtext"><?php echo $card['subtitle'] ?></div>
          <div class="copy"><?php echo $card['copy'] ?></div>
        </div>
        <div class="card-action">
          <b><?php echo do_shortcode($card['cta_text']) ?></b>
          <?php echo build_acf_button($card['link'], 'btn btn-link'); ?>
        </div>
      </div>
    </div>

<?php endforeach; ?>
</div>