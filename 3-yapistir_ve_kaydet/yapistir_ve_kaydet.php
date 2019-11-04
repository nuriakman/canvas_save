<?php 
/*
    upload_max_filesize = 1000M;
    post_max_size = 1000M;
    memory_limit = 2000M;
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
    <form id="form1" method="post">
   
        <input type="button" name="btnSave" id="btnSave" value="KAYDET" onclick="return ConvertToImage(this)">
        <p>CTRL+V ile resmi yapıştırınız</p>
        <p>
            <canvas id="MyCanvas" width="500" height="200" style="border: 1px solid black;"></canvas>
        </p>
        

        <input type="hidden" name="islem" value="kaydet">
        <input type="hidden" name="MyHiddenImage" id="MyHiddenImage">
        
    </form>

    <script type="text/javascript">
        function ConvertToImage(btnSave) {

            var canvas = document.getElementById('MyCanvas');
            var RESIM  = document.getElementById('MyHiddenImage');
            var dataURL = canvas.toDataURL();

            // var fullQuality   = canvas.toDataURL('image/jpeg', 1.0);
            // var mediumQuality = canvas.toDataURL('image/jpeg', 0.5);
            // var lowQuality    = canvas.toDataURL('image/jpeg', 0.1);

            RESIM.value = dataURL;
            document.forms["form1"].submit();

        };
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