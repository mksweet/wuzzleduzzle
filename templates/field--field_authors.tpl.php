<?php
foreach ($items as $delta => $item) {
  $sep = (count($items) == ($delta+1)) ? '' : ', ';
  print render($item) . $sep;
}
?>
