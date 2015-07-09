<article<?php print $attributes; ?>>
  <?php if (!empty($title_prefix) || !empty($title_suffix) || (!$page && $teaser)): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
    </header>
  <?php endif; ?>

  <?php if ($view_mode == 'ref_article'): ?>
    <?php
      print l($node->title, "node/" . $node->nid);
    ?>
    <div class="submitted"><?php print $date . ' / ' . render($content['field_authors']); ?></div>
  <?php else: ?>
    <?php if( !($teaser)): ?>
      <div class="submitted"><?php print $date . ' / ' . render($content['field_authors']); ?></div>
      <h1<?php print $title_attributes; ?>><?php print $title; ?></h1>
      <?php print $tag_list; ?>
    <?php endif; ?>
    <div<?php print $content_attributes; ?>>
      <?php
        hide($content['comments']);
        hide($content['links']);
        hide($content['field_tags']);
        hide($content['field_authors']);
        print render($content);
      ?>
    </div>
  <?php endif; ?>
</article>

