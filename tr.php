<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
        img { width: 300px; float: left; margin: 6px 6px 6px 0; }
    </style>
</head>
<body>

<?php

$dir = __DIR__ . '/images';

function getFileExt($filePath) {
    return pathinfo($filePath);
};

function getImgByDir($dir) {

    $files = scandir($dir);
    $allImg = [];

    foreach ($files as $file) {

        if ('.' == $file || '..' == $file) {
            continue;
        };

        if ( !is_file( $dir . '/' . $file ) ) {
            continue;
        };

        $raw = file_get_contents($dir . '/' . $file);

        if ($raw) {

            $img = imagecreatefromstring($raw);

            if ( false != $img ) {

                    header('Content-Type: image/png');
                    imagepng($img);
                    imagedestroy($img);

                //$allImg[] = $file;
                //var_dump($img);

            } else {
                echo 'Тип файла не поддерживается';
            };

        } else {
            echo 'Ошибка чтения файла';
        };



    };

    return $allImg;
};

$images = @getImgByDir($dir);

?>

<form action="/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit">
</form>

<?php foreach ($images as $img): ?>
<img src="/images/<?php echo $img; ?>" >
<?php endforeach; ?>

</body>
</html>