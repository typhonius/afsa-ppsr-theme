<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

/*
 * Re-theme output of task field in releases into a table.
 */

function ppsr_theme_preprocess_paragraphs_items(&$variables) {
  if ($variables['field_name'] == 'field_task'){
    $rows = [];
    $header = [];
    foreach ($variables['element'] as $element) {

      if (is_array($element) && isset($element['entity'])){
        $key = key($element['entity']['paragraphs_item']);
        $item = $element['entity']['paragraphs_item'][$key];
        $task_name = (isset($item['field_task_name']['0']['#markup']) ? check_markup($item['field_task_name']['0']['#markup']) : '');
        $planned_date = (isset($item['field_planned_date']['0']['#markup']) ? $item['field_planned_date']['0']['#markup'] : '');
        $field_status = (isset($item['field_status']['0']['#markup']) ? check_markup($item['field_status']['0']['#markup']) : '');
        $row = array(
          '0' => $task_name,
          '1' => $planned_date,
          '2' => $field_status,
        );

        array_push($rows, $row);

        if (empty($header)) {
          $header['0'] = t($item['field_task_name']['#title']);
          $header['1'] = t($item['field_planned_date']['#title']);
          $header['2'] = t($item['field_status']['#title']);
        }
      }

    }

    $variables['content'] = theme('table', array(
        'header' => $header,
        'rows' => $rows,
    ));
  }
}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function ppsr_theme_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  ppsr_theme_preprocess_html($variables, $hook);
  ppsr_theme_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function ppsr_theme_preprocess_html(&$variables, $hook) {
  drupal_add_css('//fonts.googleapis.com/css?family=Oswald:300,400,700', 'external');
  drupal_add_library('system', 'ui.accordion');
  drupal_add_js('jQuery(document).ready(function(){jQuery(".accordion").accordion({autoHeight: false, collapsible: true, active: false})});','inline');
}
/* -- Delete this line if you want to use this function
function ppsr_theme_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function ppsr_theme_preprocess_page(&$variables, $hook) {
  if(drupal_is_front_page()) {
    drupal_add_js(drupal_get_path('theme','ppsr_theme') . '/js/news-feed.js', array('scope' => 'footer'));
    drupal_add_js('google.load("feeds", "1");', 'inline');
    drupal_add_js('window.onload=function() {rssfeedsetup()}','inline');
  }
}
/* -- Delete this line if you want to use this function
function ppsr_theme_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function ppsr_theme_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // ppsr_theme_preprocess_node_page() or ppsr_theme_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function ppsr_theme_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function ppsr_theme_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function ppsr_theme_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
