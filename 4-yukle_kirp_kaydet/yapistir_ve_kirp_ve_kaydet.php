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
    <script type="text/javascript" src="cropper.js"></script>
</head>
<body>

    <form id="form1" method="post">
   
        <input type="button" name="btnSave" id="btnSave" value="KAYDET" onclick="return ConvertToImage(this)">
        <p>CTRL+V ile resmi yapıştırınız veya yüklemek için dosya seçiniz...</p>

        <!-- A canvas which cropper will draw on -->
        <canvas id="MyCanvas" name="MyCanvas" width="500" height="300" style="border: 1px solid grey;" >Modern bir tarayıcı edinin</canvas>

        <p>
            <!-- Below are a series of inputs which allow file selection and interaction with the cropper api -->
            <input type="file" id="fileInput" onchange="handleFileSelect()" />
            <input type="button" onclick="cropper.startCropping()" value="Start cropping" />
            <input type="button" onclick="cropper.getCroppedImageSrc()" value="Crop" />
            <input type="button" onclick="cropper.restore()" value="Restore" />
        </p>

        <input type="hidden" name="islem" value="kaydet">
        <input type="hidden" name="MyHiddenImage" id="MyHiddenImage">

    </form>

    <script type="text/javascript">
        function ConvertToImage(btnSave) {
            var canvas = document.getElementById('MyCanvas');
            var RESIM  = document.getElementById('MyHiddenImage');
            var dataURL = canvas.toDataURL();
            RESIM.value = dataURL;
            document.forms["form1"].submit();
        };
    </script>



    <script type="text/javascript">
        cropper.start(document.getElementById("MyCanvas"), 1); // initialize cropper by providing it with a target canvas and a XY ratio (height = width * ratio)
                    
        function handleFileSelect() {
            // this function will be called when the file input below is changed
            var file = document.getElementById("fileInput").files[0];  // get a reference to the selected file
            
            var reader = new FileReader(); // create a file reader
            // set an onload function to show the image in cropper once it has been loaded
            reader.onload = function(event) {
                var data = event.target.result; // the "data url" of the image
                cropper.showImage(data); // hand this to cropper, it will be displayed

                //var canvas = document.getElementById('MyCanvas');


            };
            
            reader.readAsDataURL(file); // this loads the file as a data url calling the function above once done
        }
        
    </script>
    

</body>
</html>


<script>
/**
 * This handler retrieves the images from the clipboard as a blob and returns it in a callback.
 * 
 * @see http://ourcodeworld.com/articles/read/491/how-to-retrieve-images-from-the-clipboard-with-javascript-in-the-browser
 * @param pasteEvent 
 * @param callback 
 */
function retrieveImageFromClipboardAsBlob(pasteEvent, callback){
    if(pasteEvent.clipboardData == false){
        if(typeof(callback) == "function"){
            callback(undefined);
        }
    };

    var items = pasteEvent.clipboardData.items;

    if(items == undefined){
        if(typeof(callback) == "function"){
            callback(undefined);
        }
    };

    for (var i = 0; i < items.length; i++) {
        // Skip content if not image
        if (items[i].type.indexOf("image") == -1) continue;
        // Retrieve image on clipboard as blob
        var blob = items[i].getAsFile();

        if(typeof(callback) == "function"){
            callback(blob);
        }
    }
}

window.addEventListener("paste", function(e){

    // Handle the event
    retrieveImageFromClipboardAsBlob(e, function(imageBlob){
        // If there's an image, display it in the canvas
        if(imageBlob){
            var canvas = document.getElementById("MyCanvas");
            var ctx = canvas.getContext('2d');
            
            // Create an image to render the blob on the canvas
            var img = new Image();

            // Once the image loads, render the img on the canvas
            img.onload = function(){
                // Update dimensions of the canvas with the dimensions of the image
                canvas.width = this.width;
                canvas.height = this.height;

                // Draw the image
                ctx.drawImage(img, 0, 0);
            };

            // Crossbrowser support for URL
            var URLObj = window.URL || window.webkitURL;

            // Creates a DOMString containing a URL representing the object given in the parameter
            // namely the original Blob
            img.src = URLObj.createObjectURL(imageBlob);
        }
    });
}, false);    

</script>