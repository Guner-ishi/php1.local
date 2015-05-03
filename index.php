<?php

mysql_connect('localhost', 'root', '');
mysql_select_db('php1');

// INSERT INTO gallery (name) VALUES ('');


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
                    imagepng($img, $dir . '/' . $file);
                };

                if ($size['mime'] === "image/jpeg") {
                    echo 'Мануал гавно 2';
                    imagejpeg($img, $dir . '/' . $file);
                };

            };

        } else {
            echo 'Ошибка чтения файла';
        };




$allImg[] = $file;
    };

    return $allImg;
};

$images = getImgByDir($dir);


function dbScan($images) {
  //  return
     //   $a = mysql_fetch_array(mysql_query('SELECT name FROM gallery'));

     $res = mysql_query('SELECT name FROM gallery');
while(false!== ($row = mysql_fetch_array($res))) {
   foreach($images as $k)
   {
       if ($row !== $k){
           $sql = "INSERT INTO gallery (name) VALUES ('$k')";
           mysql_query($sql);
       }

   }
    return $row;

};
}

$imgDB = dbScan($images);
//var_dump($imgDB);
/*
while(false !== $imgDB) {
    var_dump($imgDB . '<br>');
};
*/
/*
$sql = "INSERT INTO gallery (name) VALUES ('$file')";
mysql_query($sql);
*/
//file_put_contents(iconv("utf-8", "cp1251", "текст.txt"), $text ."\n\n", FILE_APPEND);
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


<?php
die;
$sql = 'SELECT * FROM img';
$res = mysql_query($sql);
while(false!== ($row = mysql_fetch_array($res))) {
?>
<img src="/img/<?php echo $row['name'];  ?>" style="max-width: 200px; "/>
<?}?>


</body>
</html>