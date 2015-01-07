<?php
function rebound_preprocess_html(&$vars) {
    $path = drupal_get_path_alias($_GET['q']);
    $aliases = explode('/', $path);

    foreach($aliases as $alias) {
        $vars['classes_array'][] = drupal_clean_css_identifier($alias);
    } 
}

function rebound_preprocess_page(&$variables)
{
    $googleMapsAPIKey = 'AIzaSyDtKJS-x4DNQEvl6lMYmk0iMkgPYpuh3to';
    drupal_add_js("https://maps.googleapis.com/maps/api/js?key=$googleMapsAPIKey", 'external');    
}

function rebound_form_alter(&$form, $form_state, $form_id) {
    if ($form_id == 'webform_client_form_70')
    {
        $form['submitted']['email']['#attributes']['placeholder'] = 'Email Address';
        $form['submitted']['email']['#attributes']['required'] = 'required';
        $form['submitted']['antispam']['#attributes']['required'] = 'required';
    }
    else if ($form_id == 'user_login')
    {
        $form['name']['#description'] = '';
        $form['pass']['#description'] = '';
    }
}

function rebound_webform_date(&$variables)
{
    if ($variables['element']['year']['#type'] == 'textfield')
    {
        $variables['element']['year']['#attributes']['placeholder'] = 'Year';
    }
    return theme_webform_date($variables);
}

function rebound_form_webform_client_form_alter(&$form){
    foreach ($form['submitted'] as &$field){
        if (is_array($field) && isset($field['#required']) && $field['#required'] == 1){
            $field['#attributes']['required'] = 'required';
        }
    }
}
?>