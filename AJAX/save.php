<?php
//error_reporting(E_ALL);
//var_dump($_SERVER);

if (!empty($_POST)) {
    $post_data = $_POST['data'];
    $post_document = $_POST['document'];
    $filename = $post_document;
    $data = "\n" . $post_data;
    $handle = fopen($filename, "a");
    fwrite($handle, $data);
    fclose($handle);
}
?>