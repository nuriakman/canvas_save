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
		<title>cropper.js example</title>
		<!-- Import the library js file -->
		<!-- You might want to use "cropper_jsmin.js" on an actual site -->
		<script type="text/javascript" src="cropper.js"></script>
	</head>
	<body>




    <form id="form1" method="post">
   
        <input type="button" name="btnSave" id="btnSave" value="KAYDET" onclick="return ConvertToImage(this)">
        <p>CTRL+V ile resmi yapıştırınız</p>
        <p>
			<!-- A canvas which cropper will draw on -->
			<canvas id="MyCanvas" width="500" height="200" style="border: 1px solid black;" >Your browser does not support canvas.</canvas>
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
				};
				
				reader.readAsDataURL(file); // this loads the file as a data url calling the function above once done
			}
			
		</script>
		
		<br />
		<!-- Below are a series of inputs which allow file selection and interaction with the cropper api -->
		<input type="file" id="fileInput" onchange="handleFileSelect()" />
		<input type="button" onclick="cropper.startCropping()" value="Start cropping" />
		<input type="button" onclick="cropper.getCroppedImageSrc()" value="Crop" />
		<input type="button" onclick="cropper.restore()" value="Restore" />
		
	</body>
</html>