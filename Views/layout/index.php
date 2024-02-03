<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="/js/script.js"></script>
    <link rel="stylesheet" href="/css/style.css" />
    <title>UTS WEB2</title>
  </head>
  <body class="font-pop relative bg-white">
    <div class="flex">
        <?php
          require_once "sidebar.php";
          require_once $content;
        ?>
    </div>
  </body>
</html>

    