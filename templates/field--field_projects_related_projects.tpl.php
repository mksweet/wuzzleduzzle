<aside class="project-related-projects">
<?php if (!$hide_label): ?>
<h2><?php print $label; ?></h2>
<?php endif; ?>
<?php if (count($items)): ?>
<ul>
<?php foreach ($items as $delta => $item): ?>
<li>
<?php print render($item); ?>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</aside>
