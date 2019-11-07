<?php
/*
    upload_max_filesize = 1000M;
    post_max_size = 1000M;
    memory_limit = 2000M;

    KAYNAK: https://www.cssscript.com/tag/image-cropping/
    
*/

if (isset($_POST["islem"])) {
    $upload_dir = "./";  //implement this function yourself
    $img = $_POST['MyHiddenImage'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . "image_name.png";
    $success = file_put_contents($file, $data);

    echo "<h1>Yüklenen Resim:</h1><img src='$file' border='1'>";
    die("<p>Tamam</p>");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>

    <link src="croppr.css" rel="stylesheet" />
    <script src="croppr.js"></script>

</head>

<body>


    <img src="../valiler/vali4.jpg" id="croppr" />

    <input type="button" value="CROP" onclick="CROPLA()">

    <script>
        var croppr = new Croppr('#croppr', {
            aspectRatio: 0,
            maxSize: {
                width: 500,
                height: 500
            },
            minSize: {
                width: 150,
                height: 150
            },
            startSize: {
                width: 50,
                height: 50,
                unit: '%'
            },
        });

        function CROPLA() {
            var value = croppr.getValue();
            alert(value)
        }
    </script>

</body>

</html>