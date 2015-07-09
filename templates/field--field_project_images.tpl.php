<?php if ($element['#view_mode'] == 'teaser'): ?>
<?php
if (count($items)) {
  print render($items[0]);
}
?>
<?php else: ?>
<?php foreach ($items as $delta => $item) : ?>
  <?php print render($item); ?>
  <?php print render($item); ?>
<?php endforeach; ?>
<?php endif; ?>
