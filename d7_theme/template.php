<?php

/**
 * @file
 * Process theme data.
 *
**/

/**
 * Creates a simple text rows array from a field collections.
 *
 * This is is leveraged in a field_preprocess function.
 *
 * @param array $variables
 *   An array of variables to pass to the theme template.
 * @param string $field_name
 *   The name of the field being altered.
 * @param array $field_array
 *   Array of fields to be turned into rows in the field collection.
 */
function rows_from_field_collection(&$variables, $field_name, $field_array) {
  $variables['rows'] = array();
  foreach ($variables['element']['#items'] as $key => $item) {
    $entity_id = $item['value'];
    $entity = field_collection_field_get_entity($item);
    $wrapper = entity_metadata_wrapper('field_collection_item', $entity);
    foreach ($field_array as $field) {
      $row[$field] = $wrapper->$field->value();
      $row['fc_id'] = $entity_id;

    }
    $variables['rows'][] = $row;
  }
}

/**
 * Implements template_preprocess_field().
 */
function client_preprocess_field(&$variables) {
  // Create rows from field collections to use in field templates.
  if ($variables['element']['#field_name'] == 'field_grid_items') {
    $variables['theme_hook_suggestions'][] = 'field__grid_items_collected';
    $field_array = array(
      'field_grid_item_headline',
      'field_grid_item_subhead',
      'field_grid_item_text',
      'field_grid_item_link'
    );
    rows_from_field_collection($variables, 'field_grid_items', $field_array);

    // Get the headline & subtitle fields from the fpp so we can use them in the fc template
    $fpid = $variables['element']['#object']->fpid;
    $fpp_loaded = entity_load('fieldable_panels_pane', array($fpid));
    $headline = field_view_field('fieldable_panels_pane', $fpp_loaded[$fpid], 'field_grid_headline', array('label' => 'hidden'), $fpp_loaded[$fpid]->language);
    $subhead = field_view_field('fieldable_panels_pane', $fpp_loaded[$fpid], 'field_grid_subhead', array('label' => 'hidden'), $fpp_loaded[$fpid]->language);
    $subhead = field_view_field('fieldable_panels_pane', $fpp_loaded[$fpid], 'field_grid_cta', array('label' => 'hidden'), $fpp_loaded[$fpid]->language);
    $variables['grid_headline'] = $headline;
    $variables['grid_subhead'] = $subhead;
    $variables['grid_cta'] = $subhead;

  }
}

function client_preprocess_fieldable_panels_pane(&$variables, $hook) {
  $elements = $variables['elements'];

  if ($elements['#bundle'] == 'homepage_banner') {
    $variables['background_url'] = '';
    $fpid = $variables['id'];
    $fpp_loaded = entity_load('fieldable_panels_pane', array($fpid));
    $image_field_items = field_get_items('fieldable_panels_pane', $fpp_loaded[$fpid], 'field_homepage_banner_image');
    if (isset($image_field_items['0']['uri'])) {
      $uri = $image_field_items['0']['uri'];
      $url = file_create_url($uri);
      $variables['background_url'] = $url;
    }
    $variables['video_url'] = '';
    $video_field = field_get_items('fieldable_panels_pane', $fpp_loaded[$fpid], 'field_homepage_banner_video_url');
    if (isset($video_field['0']['safe_value'])) {
      $variables['video_url'] = $video_field['0']['safe_value'];
    }
  }
}

/**
 * Override or insert variables for the page templates.
 */

function client_preprocess_page(&$variables) {

  if (isset($variables['node']->field_banner_image) && count($variables['node']->field_banner_image) > 0) {
    $variables['classes_array'][] = 'banner';
  }

  // Add a variable for checking if we're looking at a panels page.
  $variables['is_panel'] = NULL;
  if (module_exists('page_manager') && count(page_manager_get_current_page())) {
    $variables['is_panel'] = TRUE;
  }

  // Add variables for checking if we should show the title, tabs, footer.
  $variables['show_title'] = TRUE;
  $variables['show_tabs'] = TRUE;
  $variables['show_footer'] = TRUE;

  if (arg(0) == 'tracker') {
    $variables['show_title'] = NULL;
    $variables['show_footer'] = NULL;
  }
  if (arg(0) == 'front' || drupal_is_front_page()) {
    $variables['show_title'] = NULL;
  }
}

function client_field(&$vars) {
  $output = '';

  // Render the items.
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
  }
  $element = $vars['element'];
  $classes = strtolower(str_replace(array(' ', '_'), '-', $element['#title']));
  // Render the top-level wrapper element.
  $tag = $vars['tag'];
  if ($element['#field_name'] == 'title_field' || $element['#field_name'] == 'field_category') {
  	$tag = 'h2';
  }
  if ($element['#field_name'] == 'field_title_1' || $element['#field_name'] == 'field_title_2' || $element['#field_name'] == 'field_title_3') {
  	$tag = 'h3';
  }
  $output = "<$tag class=\"" . $classes . '"' . $vars['attributes'] . '>' . $output . "</$tag>";
  return $output;
}

function client_field__field_question_and_answer(&$vars) {
  $output = '';
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
  }
  $element = $vars['element'];
  $classes = strtolower(str_replace(array(' ', '_'), '-', $element['#title']));
  // Render the top-level wrapper element.
  $tag = 'ol';
  if ($element['#field_name'] == 'field_question' || $element['#field_name'] == 'field_answer') {
    $tag = 'div';
  }
  $output = "<$tag class=\"" . $classes . '"' . $vars['attributes'] . '>' . $output . "</$tag>";
  return $output;
}

function client_views_ajax_data_alter(&$object, &$view) {
  if($view->name == 'voices' && $view->current_display == 'block_2'){
  $commands = array();
  $commands[] = ajax_command_append('.view-id-voices',views_embed_view('social_stream','block_1'));

  // Render the commands into JSON and print them.
  print ajax_render($commands);
  exit;
  }
  // Exit so Drupal doesn't have a chance to build a whole page.
}
