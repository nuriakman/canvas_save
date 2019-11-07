
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript" charset="utf-8"></script>

<img class="orig-img" src="" alt="ORJ" />
<button>resize</button>
<img class="dest-img" src="" alt="DEST" />

<script>
    

function cropImage(origImg, targetWidth, targetHeight, xOffest, yOffset) {
  var resizeCanvas = document.createElement('canvas');
  
  resizeCanvas.width = targetWidth;
  resizeCanvas.height = targetHeight;
  resizeCanvas.getContext('2d').drawImage(origImg, xOffest, yOffset, origImg.width, origImg.height);
  return resizeCanvas.toDataURL();
}

function run() {
  $(document).ready(function() {
    console.log($('.orig-img'));
    $('.orig-img')[0].src="../valiler/vali1.jpg";
    $('.dest-img')[0].src="../valiler/vali1.jpg";

    $('button').click(function() {
      var image = new Image();
      image.onload = function() {
          var croppedimage = cropImage(image, 300, 300, -50, -150);
          $('.dest-img')[0].src = croppedimage;
      };
      image.src = "../valiler/vali1.jpg";
    });
  });
}

run();

</script>