<?php foreach ($rows as $id => $row): ?>
  <?php if ($classes_array[$id]) { print '<div class="' . $classes_array[$id] .'">'; } ?>
    <?php print $row; ?>
  <?php if ($classes_array[$id]) { print '</div>'; } ?>
<?php endforeach; ?>
