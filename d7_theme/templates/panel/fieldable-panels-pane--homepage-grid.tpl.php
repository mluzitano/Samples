<div class="homepage-grid region-highlighted <?php print $classes; ?>"<?php print $attributes; ?>>
  <section class="homepage-grid-inner">
  <?php if (isset($content['field_homepage_grid_headline'])): ?>
    <h1><?php print render($content['field_homepage_grid_headline']); ?></h1>
  <?php endif; ?>

  <?php if (isset($content['field_grid_items'])): ?>
    <?php print render($content['field_grid_items']); ?>
  <?php endif; ?>

  <?php if (isset($content['field_grid_cta'])): ?>
    <div class="button-wrapper call-to-action">
      <?php print render($content['field_grid_cta']); ?>
    </div>
  <?php endif; ?>
  </section>
</div>
