<?php
/**
 * @file
 * Field template for the field_grid_items field collection.
 */
?>

<div class="grid-items">

  <?php $count = '0'; ?>
  <?php foreach($rows as $row): ?>
    <div class="grid-item">
      <div class="grid-item-inner">
        <h3><?php print $row['field_grid_item_headline']; ?></h3>
        <h4><?php print $row['field_grid_item_subhead']; ?></h4>
        <?php if (is_array($row['field_grid_item_link'])): ?>
          <div class="grid-item-cta">
            <?php $fc_id = $row['fc_id']; ?>
            <?php $fc_loaded = entity_load('field_collection_item', array($fc_id)); ?>
            <?php $cta_field = field_view_field('field_collection_item', $fc_loaded[$fc_id], 'field_grid_item_link'); ?>
            <?php print render($cta_field); ?>
          </div>
        <?php endif; ?>
        <div class="grid-item-hover">
          <div class="text">
            <?php print $row['field_grid_item_text']['safe_value']; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

</div>
