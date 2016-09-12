<?php
  $post_data = $_POST['data'];
if (!empty($post_data)) {
    $filename = $post_data;
    $handle = fopen($filename, "a");
    fwrite($handle, '');
    fclose($handle);
}
?>