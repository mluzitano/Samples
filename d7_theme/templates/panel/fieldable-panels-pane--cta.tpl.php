<div class="fpp-cta <?php print $classes; ?>"<?php print $attributes; ?>>

<?php if(isset($content['field_cta_link'])): ?>
  <div class="call-to-action">
    <?php print render($content['field_cta_link']); ?>
  </div>
<?php endif; ?>

</div>
