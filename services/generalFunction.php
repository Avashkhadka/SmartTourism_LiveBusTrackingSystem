<?php

function uploadImage($file, $folder, $username, $name)
{
    // File extension
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    // Generate filename
    $filename = strtolower(str_replace(" ", "_", $username));
    $filename .= "_" . $name . "." . $ext;
    $destination = realpath(__DIR__ . "/..") . "/" . $folder . "/" . $filename;
    $destinationdb = $folder . "/" . $filename;
    move_uploaded_file($file['tmp_name'], $destination);
    return $destinationdb;

}