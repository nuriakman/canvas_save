<?php 
/*
    upload_max_filesize = 1000M;
    post_max_size = 1000M;
    memory_limit = 2000M;

    KAYNAK: https://www.cssscript.com/tag/image-cropping/
    
*/

    if(isset($_POST["islem"])) {
        $upload_dir = "./";  //implement this function yourself
        $img = $_POST['MyHiddenImage'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $upload_dir."image_name.png";
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

    <link   src="croppr.css" rel="stylesheet"/>
    <script src="croppr.js"></script>

</head>
<body>


    <img src="../valiler/vali4.jpg" id="croppr"/>

<script>
    
    var croppr = new Croppr('#croppr', {
        // options 
    });

    // Protip: You can also pass an Element object instead of a selector    


//    var value = croppr.getValue();
    // data = {x: 20, y: 20: width: 120, height: 120}    

</script>

</body>
</html>