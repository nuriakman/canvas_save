<?php 
    if(isset($_POST["islem"])) {
        $upload_dir = "./";  //implement this function yourself
        $img = $_POST['my_hidden_img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $upload_dir."image_name.png";
        $success = file_put_contents($file, $data);
        
        echo "<h1>Yüklenen Resim:</h1><img src='$file' border='1'>";
        die("<p>Tamam</p>");
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title></title>
    <style type="text/css">
        body
        {
            font-family: Arial;
            font-size: 10pt;
        }
    </style>
</head>
<body>
    <form id="form1" method="post">
    
        <div class="tools">
            <a href="#colors_sketch" data-tool="marker">Marker</a>
            <a href="#colors_sketch" data-tool="eraser">Eraser</a>
        </div>
        
        <br />
        <canvas id="colors_sketch" width="500" height="200" style="border: 1px solid black;"></canvas>
        <br />
        <br />
        
        <input type="hidden" name="islem" value="kaydet">
        <input type="hidden" name="my_hidden_img" id="my_hidden_img">
        <input type="button" name="btnSave" id="btnSave" value="KAYDET" onclick="return ConvertToImage(this)">
        
    </form>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/mobomo/sketch.js/master/lib/sketch.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            $('#colors_sketch').sketch();
            $(".tools a").eq(0).attr("style", "color:#000");
            $(".tools a").click(function () {
                $(".tools a").removeAttr("style");
                $(this).attr("style", "color:#000");
            });
        });
        function ConvertToImage(btnSave) {
            // document.getElementById('my_hidden').value = canvas.toDataURL('image/png');
            // document.forms["form1"].submit();

            var base64 = $('#colors_sketch')[0].toDataURL();
            $("[id*=my_hidden_img]").val(base64);
            
            // AJAX veya submit
            document.forms["form1"].submit();
        };
    </script>

</body>
</html>
