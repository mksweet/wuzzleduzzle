<?php

function wuzzleduzzle_preprocess_node(&$vars) {
  if (variable_get('node_submitted_' . $node->type, TRUE)) {
    $vars['submitted'] = t('!datetime / !username', array('!username' => $vars['name'], '!datetime' => $vars['date']));
  }
  else {
    $vars['display_submitted'] = FALSE;
    $vars['submitted'] = 'not submitted';
    $vars['user_picture'] = '';
  }
  // Add a readmore link variable to use in teasers.
  $attributes = array('title' => t('Read the whole entry'));
  $attributes['class'][] = 'readmore';
  $vars['readmore'] = l(t('Read More'), 'node/' . $vars['nid'], array('attributes' => $attributes));

  // Project Nodes.
  if ($vars['type'] == 'project') {
    if ($vars['teaser']) {
      $vars['attributes_array']['class'][] = $vars['field_keystone_image_position_cl']['und'][0]['value'];
      // Necessary for views_infinite_scroll to work.
      $vars['attributes_array']['class'][] = 'views-row';
    } else {
      // Flippy pagers.
      $pager = $vars['elements']['flippy_pager']['#list'];
      if ($pager['next']) {
        $vars['prev'] = l($pager['next']['title'] . " &rarr;", 'node/' . $pager['next']['nid'], array('html' => true, 'attributes' => array('class' => 'next')));
      }
      if ($pager['prev']) {
        $vars['next'] = l("&larr; " . $pager['prev']['title'], 'node/' . $pager['prev']['nid'], array('html' => true, 'attributes' => array('class' => 'prev')));
      }
      // Back to work link.
      $vars['back_to_work'] = l('Back to Work', 'work', array('attributes' => array('class' => 'back-to-work')));
    }
  }

  // News Nodes.
  if ($vars['type'] == 'article') {
    $tags = array();
    foreach ($vars['field_tags'] as $tag) {
      $tag_link = l($tag['taxonomy_term']->name, 'taxonomy/term/' . $tag['tid']);
      $tags[] = $tag_link;
    }
    $vars['tag_list'] = '<div class="tags">' . implode(" / ", $tags) . '</div>';
  }
}
