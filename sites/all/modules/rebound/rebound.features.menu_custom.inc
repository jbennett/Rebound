<?php
/**
 * @file
 * rebound.features.menu_custom.inc
 */

/**
 * Implements hook_menu_default_menu_custom().
 */
function rebound_menu_default_menu_custom() {
  $menus = array();

  // Exported menu: main-menu.
  $menus['main-menu'] = array(
    'menu_name' => 'main-menu',
    'title' => 'Main menu',
    'description' => 'The <em>Main</em> menu is used on many sites to show the major sections of the site, often in a top navigation bar.',
  );
  // Exported menu: menu-footer-3rd-column.
  $menus['menu-footer-3rd-column'] = array(
    'menu_name' => 'menu-footer-3rd-column',
    'title' => 'Footer Other Links',
    'description' => '',
  );
  // Exported menu: menu-footer-about-us.
  $menus['menu-footer-about-us'] = array(
    'menu_name' => 'menu-footer-about-us',
    'title' => 'Footer About Us',
    'description' => '',
  );
  // Exported menu: menu-footer-programs-services.
  $menus['menu-footer-programs-services'] = array(
    'menu_name' => 'menu-footer-programs-services',
    'title' => 'Footer Programs & Services',
    'description' => '',
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Footer About Us');
  t('Footer Other Links');
  t('Footer Programs & Services');
  t('Main menu');
  t('The <em>Main</em> menu is used on many sites to show the major sections of the site, often in a top navigation bar.');


  return $menus;
}
