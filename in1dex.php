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

                $size = getimagesize($dir . '/' . $file);
                if ($size['mime'] === "image/gif") {
                    echo 'Мануал гавно';
                    imagegif($img, $dir . '/' . $file);
                };

                if ($size['mime'] === "image/png") {
                    echo 'Мануал гавно 1';
                };

                if ($size['mime'] === "image/jpeg") {
                    echo 'Мануал гавно 2';
                };

            };

        } else {
            echo 'Ошибка чтения файла';
        };

    };

    return $allImg;
};

$images = getImgByDir($dir);

?>

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

<form action="/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit">
</form>

<?php foreach ($images as $img): ?>
<img src="/images/<?php echo $img; ?>" >
<?php endforeach; ?>

</body>
</html>