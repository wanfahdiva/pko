<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PKO - Beda Jadwal</title>
  <link rel="shortcut icon" href="../vendor/images/ifsu.png" />
  <link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One" rel="stylesheet">
  <link rel="stylesheet" href="../vendor/css/style_back.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <p id="offscreen-text" class="offscreen-text"></p>
  <p id="text" class="text"></p>

  <svg id="svg">
  </svg>

  <input type="text" class="input" , id="input" hidden />
  <!-- partial -->
  <script src='../vendor/gsap/CSSPlugin.min.js'></script>
  <script src='../vendor/gsap/EasePack.min.js'></script>
  <script src='../vendor/gsap/TweenLite.min.js'></script>
  <script src="../vendor/js/script_beda.js"></script>
  <script type="text/javascript">
    setTimeout(function() {
      window.location.href = '../halaman_login';
    }, 6000);
  </script>

</body>

</html>