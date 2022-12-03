<?php

if (isset($_FILES['photo'])){
    $file = $_FILES['photo'];

    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'png');

    if (in_array($file_ext, $allowed)){
        if ($file_error===0){

            $file_name_new = uniqid('image',true) . '.' . $file_ext;
            $file_destination = '../source/uploads/' . $file_name_new;

           move_uploaded_file($file_tmp, $file_destination);

        }
    }
}