<?php
function _webform_defaults_square_field() {
  return array(
    'name' => '',
    'form_key' => NULL,
    'pid' => 0,
    'weight' => 0,
    'value' => '',
    'mandatory' => 0,
    'extra' => array(
      'field_prefix' => '',
      'field_suffix' => '',
    ),
  );
}

function _webform_theme_square_field() {
  return array(
    'webform_display_square_field' => array(
      'render element' => 'element',
    ),
  );
}

function _webform_edit_square_field($component) {
  $form = array();
  $form['extra']['field_prefix'] = array(
    '#type' => 'textfield',
    '#title' => t('Left'),
    '#default_value' => $component['extra']['field_prefix'],
    '#size' => 60,
    '#required' => TRUE,
    '#maxlength' => 255,
    '#weight' => 1.1,
    '#parents' => array('extra', 'field_prefix'),
    '#description' => t('Text placed to the left of the slider'),
  );
  $form['extra']['field_suffix'] = array(
    '#type' => 'textfield',
    '#title' => t('Right'),
    '#default_value' => $component['extra']['field_suffix'],
    '#size' => 60,
    '#required' => TRUE,
    '#maxlength' => 255,
    '#weight' => 1.2,
    '#parents' => array('extra', 'field_suffix'),
    '#description' => t('Text placed to the right of the slider'),
  );
  return $form;
}

function _webform_render_square_field($component, $value = NULL, $filter = TRUE) {
  $node = isset($component['nid']) ? node_load($component['nid']) : NULL;
  drupal_add_js('https://js.squareup.com/v2/paymentform', 'external');
  drupal_add_js('/'. drupal_get_path('module', 'webform_square_field') . '/js/square.js', array(
    'type' => 'file',
    'cache' => false,
  ));
  drupal_add_css('/'. drupal_get_path('module', 'webform_square_field') . '/css/square.css', array(
    'type' => 'file',
    'cache' => false,
    'preprocess' => false,
  ));

  drupal_add_js('document.addEventListener("DOMContentLoaded", function(event) {
    webformSquareBootstrap("sandbox-sq0idp-ha4W1XSd7_0fV9RzniOAlw", '. $component['nid'] .');
  });', array(  
    'type' => 'inline',
    'scope' => 'footer',
  ));

  $element = array(
    '#type' => 'fieldset',
    '#is_payment' => true,
    '#title' => 'Payment Info',
    '#weight' => $component['weight'],
    '#attributes' => array('class' => array('sq-form-container')),
  );
  $element['sq_card_number'] = array('#markup' => '<div class="sq-input-container"><span class="label">Card Number</span><div id="sq-card-number-'. $component['nid'] .'"></div></div>');
  $element['sq_cvv'] = array('#markup' => '<div class="sq-input-container"><span class="label">CVV</span><div id="sq-cvv-'. $component['nid'] .'"></div></div>');
  $element['sq_postal'] = array('#markup' => '<div class="sq-input-container"><span class="label">Postal</span><div id="sq-postal-code-'. $component['nid'] .'"></div></div>');
  $element['sq_expiration'] = array('#markup' => '<div class="sq-input-container"><span class="label">Expiration Date</span><div id="sq-expiration-date-'. $component['nid'] .'"></div></div>');
  $element['sq_error'] = array('#markup' => '<div id="error-'. $component['nid'] .'"></div>');
  $element['sq_nonce'] = array('#type' => 'hidden', '#id' => 'card-nonce-'. $component['nid'], '#name' => 'nonce');

  return $element;
}

function _webform_display_square_field($component, $value, $format = 'html') {
  return array(
    '#title' => $component['extra']['field_prefix'] .' / '. $component['extra']['field_suffix'],
    '#weight' => $component['weight'],
    '#theme' => 'webform_display_square_field',
    '#theme_wrappers' => $format == 'html' ? array('webform_element') : array('webform_element_text'),
    '#format' => $format,
    '#value' => $value[0],
    '#translatable' => array('title', 'field_prefix', 'field_suffix'),
  );
}

function theme_webform_display_square_field($variables) {
  $element = $variables['element'];
  $value = $element['#value'];
  return trim($value) !== '' ? $value : ' ';
}

function _webform_table_square_field($component, $value) {
  return check_plain(empty($value[0]) ? '' : $value[0]);
}

function _webform_csv_headers_square_field($component, $export_options) {
  $header = array();
  $header[0] = '';
  $header[1] = $component['extra']['field_prefix'];
  $header[2] = $component['extra']['field_suffix'];
  return $header;
}

function _webform_csv_data_square_field($component, $export_options, $value) {
  return !isset($value[0]) ? '' : $value[0];
}