<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * WD Theme.
 */

/**
 * Implements hook_omega_theme_libraries_info().
 */
function wuzzleduzzle_omega_theme_libraries_info($theme) {
  $path = drupal_get_path('theme', 'wuzzleduzzle');

  $libraries['selectnav'] = array(
    'name' => t('Selectnav'),
    'description' => t("selectnav.js library"),
    'package' => t('wuzzleduzzle'),
    'files' => array(
      'js' => array(
        $path . '/js/selectnav/selectnav.min.js' => array(
          'group' => JS_THEME,
          'weight' => -100,
          'every_page' => TRUE,
        ),
      ),
    ),
  );

  $libraries['responsive'] = array(
    'name' => t('Responsive Libs'),
    'description' => t('Responsive libraries and plugins'),
    'package' => t('wuzzleduzzle'),
    'files' => array(
      'js' => array(
        $path . '/js/jquery.resizeend.js' => array(
          'group' => JS_THEME,
          'weight' => -101,
          'every_page' => TRUE,
        ),
        $path . '/js/jquery.matchmedia.js' => array(
          'group' => JS_THEME,
          'weight' => -100,
          'every_page' => TRUE,
        ),
      ),
    ),
  );

  $libraries['wuzzleduzzle_frontend'] = array(
    'name' => t('WD Theme Frontend'),
    'description' => t('wuzzleduzzle frontend magic'),
    'package' => t('wuzzleduzzle'),
    'files' => array(
      'js' => array(
        $path . '/js/wuzzleduzzle_frontend.js' => array(
          'group' => JS_THEME,
          'weight' => 100,
          'every_page' => TRUE,
        ),
      ),
    ),
  );

  $libraries['imgsizer'] = array(
    'name' => t('ImgSizer'),
    'description' => t('Image sizer plugin'),
    'package' => t('wuzzleduzzle'),
    'files' => array(
      'js' => array(
        $path . '/js/imgsizer.js' => array(
          'group' => JS_THEME,
          'weight' => 80,
          'every_page' => TRUE,
        ),
      ),
    ),
  );

  $libraries['superfish'] = array(
    'name' => t('Superfish'),
    'description' => t('Superfish dropdown menus'),
    'package' => t('wuzzleduzzle'),
    'files' => array(
      'js' => array(
        $path . '/js/superfish.js' => array(
          'group' => JS_THEME,
          'weight' => 90,
          'every_page' => TRUE,
        ),
      ),
    ),
  );


  return $libraries;
}

/**
 * Implements template_preprocess_page
 */
function wuzzleduzzle_preprocess_page(&$vars) {
  drupal_add_js('jQuery.extend(Drupal.settings, { "pathToTheme": "/' . path_to_theme() . '/" });', 'inline');
  $vars['breadcrumb'] = '';
  if ($vars['node']->type == 'project') {
    $vars['title'] = '';
  }
  if ($vars['node']->type == 'article') {
    $vars['title'] = '';
  }
  unset($vars['feed_icons']);
}

/**
 * Implements theme_menu_link().
 *
 * Add special style to WD site menu
 */
function wuzzleduzzle_menu_link($vars) {
  $element = $vars['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  if ($vars['element']['#theme'] == 'menu_link__main_menu') {
    $element['#localized_options']['html'] = TRUE;
    $output = l('<span>' . $element['#title'] . '</span>', $element['#href'], $element['#localized_options']);
  }
  else {
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  }
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

