
<?php 
  global $item;

  $rows = $item['videos'];
  
  foreach ($rows as $row) {
    //print $row['video'];

    // get iframe HTML
    $iframe = $row['video'];
    
    
    // use preg_match to find iframe src
    preg_match('/src="(.+?)"/', $iframe, $matches);
    $src = $matches[1];

    //YouTube Video ID
    $id = str_replace("https://www.youtube.com/embed/", "", $src);
    $arr = explode("?", $id, 2);
    $id = $arr[0];

    //echo '<div class="col-6"><div class="youtube-player" data-id="'.$id.'"></div></div>';
    
    
    // add extra params to iframe src
    $params = array(
        'controls'    => 1,
        'hd'        => 1,
        'autohide'    => 1,
        'rel' => 0,
    );
    
    $new_src = add_query_arg($params, $src);
    //$iframe = str_replace($src, $new_src, $iframe);
    $iframe = str_replace($src, "", $iframe);
    
    // add extra attributes to iframe html
    $attributes = 'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen';
    
    $iframe = str_replace('></iframe>', ' data-src='.$new_src. " " . $attributes . '></iframe>', $iframe);
    
    // echo $iframe
    echo $iframe;
  }
?>