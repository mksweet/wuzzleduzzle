<article<?php print $attributes; ?>>
  <?php if (!empty($title_prefix) || !empty($title_suffix) || (!$page && $teaser)): ?>
    <a href="<?php print $node_url; ?>" rel="bookmark">
      <?php print theme('image_style', array('path' => $node->field_list_image['und'][0]['uri'], 'style_name' => $field_keystone_image_responsive_['und'][0]['value'], 'attributes' => array('class' => " image-" . $field_keystone_image_responsive_['und'][0]['value']))); ?>
      <header>
        <?php print render($title_prefix); ?>
        <?php if (!$page): ?>
          <h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
      </header>
    </a>
  <?php endif; ?>
  <?php if ($view_mode == 'ref_project'): ?>
    <?php
      print l($node->title, "node/" . $node->nid);
    ?>
  <?php else: ?>
    <?php if( !($teaser)): ?>
      <div class="top-links">
        <div class='next-wrapper'><?php print $next; ?></div>
        <h1 <?php print $title_attributes; ?>><?php print $title; ?></h1>
        <div class='prev-wrapper'><?php print $prev; ?></div>
      </div>
    <?php endif; ?>
    <?php
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_projects_related_projects']);
      hide($content['field_project_related_blog_posts']);
      print render($content);
    ?>
    <?php if( !($teaser)): ?>
      <div class="aside-blocks">
        <?php print render($content['field_project_related_blog_posts']); ?>
        <?php print render($content['field_projects_related_projects']); ?>
      </div>
      <div class="links">
        <div class='next-wrapper'><?php print $next; ?></div>
        <div class='back-to-work-wrapper'><?php print $back_to_work; ?></div>
        <div class='prev-wrapper'><?php print $prev; ?></div>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</article>
