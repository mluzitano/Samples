<div style="background-image: url(<?php print $background_url; ?>)" class="homepage-banner <?php print $classes; ?>"<?php print $attributes; ?>>

  <div class="left">
    <h1><a class="video-text colorbox-load" href="<?php print $video_url; ?>?rel=0&wmode=transparent&autoplay=true&width=1200&height=675&iframe=true"><?php print render($content['field_homepage_banner_headline'])?></a></h1>
  </div>
  <?php if (isset($content['field_homepage_banner_video_url'])): ?>
    <div class="video-link-container">
      <a class="video colorbox-load" href="<?php print $video_url; ?>?rel=0&wmode=transparent&autoplay=true&width=1200&height=675&iframe=true"><span class="play-button-container"><span class="container-inner"><i class="fa fa-5x fa-youtube-play"></i></span></span></a>
    </div>
  <?php endif; ?>

</div>
