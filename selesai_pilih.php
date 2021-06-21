<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PKO - Selesai Pilih</title>
  <link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One" rel="stylesheet">
  <link rel="stylesheet" href="vendor/css/style_back.css">
  <link rel="shortcut icon" href="vendor/images/ifsu.png" />

</head>

<body>
  <!-- partial:index.partial.html -->
  <p id="offscreen-text" class="offscreen-text"></p>
  <p id="text" class="text"></p>

  <svg id="svg">
  </svg>

  <input type="text" class="input" , id="input" hidden />
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/plugins/CSSPlugin.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/easing/EasePack.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenLite.min.js'></script>
  <script src="vendor/js/script_text.js"></script>
  <script type="text/javascript">
    setTimeout(function() {
      window.location.href = 'halaman_login';
    }, 4900);
  </script>
</body>

</html>