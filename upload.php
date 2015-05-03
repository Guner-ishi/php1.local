<?php

$formUpload = 'image';

if (!empty($_FILES)) {

    if ( isset($_FILES[$formUpload]) ) {

        if ( 0 == $_FILES[$formUpload]['error'] && $_FILES[$formUpload]['size'] > 0 ) {

            $newImageFolder = __DIR__ . '/images/' . basename($_FILES[$formUpload]['name']);

            move_uploaded_file($_FILES[$formUpload]['tmp_name'], iconv("utf-8", "cp1251",$newImageFolder));



        };

    };

};



header('Location: /index.php');
