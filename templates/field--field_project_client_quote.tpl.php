<div class="client-quote">
<?php if (!$hide_label): ?>
<h2><?php print $label; ?></h2>
<?php endif; ?>
<?php if (count($items)): ?>
  <?php foreach ($items as $delta => $item): ?>
    <?php print render($item); ?>
  <?php endforeach; ?>
<?php endif; ?>
</div>
