<?php
require(__DIR__.'/../../../libraries/square-api/autoload.php');

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
  $form['extra']['price'] = array(
    '#type' => 'textfield',
    '#title' => t('Price'),
    '#description' => t('The price of an individual fundraiser item in dollars.'),
    '#default_value' => $component['extra']['price'],
    '#size' => 60,
    '#required' => TRUE,
    '#maxlength' => 255,
  );
  // $form['extra']['multiple'] = array(
  //   '#type' => 'select',
  //   '#title' => t('Allow Multiple'),
  //   '#description' => t('Allow the user to purchase more than one item.'),
  //   '#default_value' => $component['extra']['multiple'],
  //   '#options' => array(
  //     0 => t('No'),
  //     1 => t('Yes'),
  //   ),
  // );
  $form['extra']['choices'] = array(
    '#type' => 'textfield',
    '#title' => t('Allow Options'),
    '#description' => t('Number of options the user has to select between.'),
    '#default_value' => $component['extra']['choices'] || 1,
  );
  $form['extra']['choice_label'] = array(
    '#type' => 'textfield',
    '#title' => t('Label for Choices'),
    '#description' => t('Label to use options, ie House #1.'),
    '#default_value' => $component['extra']['choice_label'],
  );
  $form['extra']['sq_app_id'] = array(
    '#type' => 'textfield',
    '#title' => t('Square App ID'),
    '#default_value' => $component['extra']['sq_app_id'],
  );
  $form['extra']['sq_access_token'] = array(
    '#type' => 'textfield',
    '#title' => t('Square Access Token'),
    '#default_value' => $component['extra']['sq_access_token'],
  );
  $form['extra']['sq_location_id'] = array(
    '#type' => 'textfield',
    '#title' => t('Location ID'),
    '#default_value' => $component['extra']['sq_location_id'],
  );
  return $form;
}

function _webform_render_square_field($component, $value = NULL, $filter = TRUE) {
  if ($value['sq_nonce']) {
    return _webform_render_square_field_view($component, $value, $filter); 
  } else {
    return _webform_render_square_field_edit($component, $value, $filter);
  }
}

function _webform_render_square_field_view($component, $value = NULL, $filter = TRUE) {
  if ($component['extra']['choices'] == 1) {
    $quantity = isset($value['quantity']) ? $value['quantity'] : 1;
  } else {
    if (isset($value['quantity'])) {
      $value['quantity'] = json_decode($value['quantity_array']);
    } else {
      $value['quantity'] = array();
    }

    $quantity = array_sum($value['quantity']);
  }
  
  $price = $component['extra']['price'];
  $subtotal = $price * $quantity;

  drupal_add_css('/'. drupal_get_path('module', 'webform_square_field') . '/css/square.css', array(
    'type' => 'file',
    'cache' => false,
    'preprocess' => false,
  ));

  $element = array(
    '#type' => 'fieldset',
    '#is_payment' => true,
    '#title' => 'Payment Info',
    '#weight' => $component['weight'],
    '#attributes' => array('class' => array('sq-form-container')),
  );
  if ($component['extra']['choices'] == 1) {
    $element['quantity'] = array(
      '#type' => 'textfield',
      '#title' => t('Quantity'),
      '#value' => $value['quantity'],
      '#disabled' => true,
    );
  } else {
    $element['quantity'] = array();
    for ($i = 1; $i <= $component['extra']['choices']; $i++) {
      $element['quantity'][] = array(
        '#type' => 'textfield',
        '#title' => t("{$component['extra']['choice_label']} #{$i}"),
        '#value' => $value['quantity'][$i - 1],
        '#disabled' => true,
      );
    }
  }

  $element['total'] = array(
    '#type' => 'textfield',
    '#title' => 'Total',
    '#value' => '$'. $subtotal,
    '#disabled' => true,
  );
  $element['sq_nonce'] = array(
    '#type' => 'hidden',
    '#value' => $value['sq_nonce'],
  );
  $element['sq_transaction_id'] = array(
    '#type' => 'hidden',
    '#value' => $value['sq_transaction_id'],
  );

  return $element;
}

function _webform_render_square_field_edit($component, $value = NULL, $filter = TRUE) {
  $price = $component['extra']['price'];
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

  drupal_add_js("document.addEventListener('DOMContentLoaded', function(event) {
    webformSquareBootstrap('{$component['extra']['sq_app_id']}', '{$component['nid']}', '{$price}');
  });", array(  
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


  if ($component['extra']['choices'] == 1) {
    $quantity = 1;
    $element['quantity'] = array(
      '#type' => 'textfield',
      '#title' => t('Quantity'),
      '#attributes' => array(
        ' type' => 'number', // leave space
        'step' => '1',
        'class' => array('sq-quantity-select'),
      ),
      '#default_value' => 1,
      '#size' => 60,
      '#required' => TRUE,
      '#maxlength' => 4,
    );
  } else {
    $quantity = 0;
    $element['quantity'] = array();
    for ($i = 1; $i <= $component['extra']['choices']; $i++) {
      $element['quantity'][] = array(
        '#type' => 'textfield',
        '#title' => t("{$component['extra']['choice_label']} #{$i}"),
        '#attributes' => array(
          ' type' => 'number', // leave space
          'step' => '1',
          'class' => array('sq-quantity-select'),
        ),
        '#default_value' => 0,
        '#size' => 60,
        '#required' => TRUE,
        '#maxlength' => 4,
      );
    }
  }

  $subtotal = $price * $quantity;
  $element['sq_pricing'] = array('#markup' => '<div class="sq-input-container" id="sq-card-price-'. $component['nid'] .'">Your total is: $'. $subtotal .'.</div>');
  $element['sq_card_number'] = array('#markup' => '<div class="sq-input-container"><span class="label">Card Number</span><div id="sq-card-number-'. $component['nid'] .'"></div></div>');
  $element['sq_cvv'] = array('#markup' => '<div class="sq-input-container"><span class="label">CVV</span><div id="sq-cvv-'. $component['nid'] .'"></div></div>');
  $element['sq_postal'] = array('#markup' => '<div class="sq-input-container"><span class="label">Postal</span><div id="sq-postal-code-'. $component['nid'] .'"></div></div>');
  $element['sq_expiration'] = array('#markup' => '<div class="sq-input-container"><span class="label">Expiration Date</span><div id="sq-expiration-date-'. $component['nid'] .'"></div></div>');
  $element['sq_error'] = array('#markup' => '<div id="error-'. $component['nid'] .'"></div>');
  $element['sq_nonce'] = array(
    '#type' => 'hidden',
    '#default_value' => $value['sq_nonce'],
    '#attributes' => array('id' => 'card-nonce-'. $component['nid']), 
  );
  $element['sq_transaction_id'] = array(
    '#type' => 'hidden',
    '#default_value' => $value['sq_transaction_id'],
  );

  return $element;
}



function _webform_submit_square_field($component, $value) {
  if (is_null($value['sq_transaction_id'])) { return $value; }
  
  if ($component['extra']['choices'] == 1) {
    $quantity = $value['quantity'];
  } else {
    $quantity = array_sum($value['quantity']);
    $value['quantity_array'] = json_encode($value['quantity']);
  }
  $amount = $component['extra']['price'] * $quantity;

  if (is_null($value['sq_guid'])) {
    $value['sq_guid'] = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
  }

  $accessToken = $component['extra']['sq_access_token'];
  $locationId = $component['extra']['sq_location_id'];
  SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($component['extra']['sq_access_token']);
  $api = new \SquareConnect\Api\TransactionsApi();
  $chargeRequest = new \SquareConnect\Model\ChargeRequest();
  $chargeRequest->setCardNonce($value['sq_nonce']);
  $chargeRequest->setIdempotencyKey( $value['sq_guid']);
  $chargeRequest->setAmountMoney($amount); // convert to pennies

  $requestBody = array (
    "card_nonce" => $value['sq_nonce'],
    "amount_money" => array (
      "amount" => $amount * 100,
      "currency" => "CAD"
    ),
    "idempotency_key" => $value['sq_guid'],
  );
  
  try {
    // $chargeResult = $api->charge($component['extra']['sq_location_id'], $requestBody);
    // $value['sq_transaction_id'] = $chargeResult->getTransaction()->getId();
  } catch(Exception $e) {
    dpm($e);
  }

  return $value;
}

function _webform_display_square_field($component, $value, $format = 'html') {
  $value = _square_decode_values($values);
  $element = array(
    '#weight' => $component['weight'],
  );
  
  $element['quantity'] = array(
    '#title' => 'Quantity',
    '#theme' => 'webform_display_square_field',
    '#theme_wrappers' => $format == 'html' ? array('webform_element') : array('webform_element_text'),
    '#format' => $format,
    '#value' => _square_get_quantity($value),
  );
  $element['sq_nonce'] = array(
    '#title' => 'sq_nonce',
    '#theme' => 'webform_display_square_field',
    '#theme_wrappers' => $format == 'html' ? array('webform_element') : array('webform_element_text'),
    '#format' => $format,
    '#value' => $value['sq_nonce'],
  );
  $element['sq_transaction_id'] = array(
    '#title' => 'Transaction Id',
    '#theme' => 'webform_display_square_field',
    '#theme_wrappers' => $format == 'html' ? array('webform_element') : array('webform_element_text'),
    '#format' => $format,
    '#value' => $value['sq_transaction_id'],
  );

  return $element;
}

function _square_decode_values($values) {
  if (isset($values['quantity_array']) && is_string($values['quantity_array'])) {
    $values['quantity_array'] = json_decode($values['quantity_array']);
  }

  return $values;
}

function _square_encode_values($values) {
  if (isset($values['quantity_array']) && is_array($values['quantity_array'])) {
    $values['quantity_array'] = json_encode($values['quantity_array']);
  }

  return $values;
}

function _square_get_quantity($values) {
  if (isset($value['quantity_array'])) {
    return array_sum($value['quantity_array']);
  } else {
    return array_sum($value['quantity']);
  }
}

function theme_webform_display_square_field($variables) {
  $element = $variables['element'];
  $value = $element['#value'];
  return trim($value) !== '' ? $value : ' ';
}

function _webform_table_square_field($component, $value) {
  dpm($value);
  return check_plain(empty($value[0]) ? '' : $value[0]);
}

function _webform_csv_headers_square_field($component, $export_options) {
  $header = array();
  $header[0] = 'asd';
  $header[1] = 'Square dToken';
  return $header;
}

function _webform_csv_data_square_field($component, $export_options, $value) {
  return !isset($value[0]) ? '' : $value[0];
}