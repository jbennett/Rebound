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
?>