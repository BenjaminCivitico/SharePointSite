<?php
require("Connections/connect.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SharePoint - Benjamin Civitico</title>
  <meta name="author" content="Benjamin Civitico">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link rel="stylesheet" href="style/prism.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
  <link rel="stylesheet" href="style.css" type="text/css">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106967798-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-106967798-2');
  </script>
  </head>
  <body>
    <div class="Content">
      <header class="pageHeader">
        <?php require("header.php"); ?>
      </header>
      <div class="pageBody">
        <div class="pageContent">
          <?php

          //$query = $db->prepare("Select * From Articles Where ArticleID = ?");
          //$query->execute(array());
          //$result = $query;
          echo "TODO: Fill in stuff here!";

          ?>
        </div>
      </div>
      <div class="pageFooter">
        <?php require("footer.php"); ?>
      </div>
    </div>
    <script type="text/javascript">
      (function (){
        var headerText;
        headerText = document.querySelector(".headerText");
        headerText.addEventListener("scroll", function(){
          console.log(headerText.scrolltop);
          console.log("test");
          return true;
        });
      }).call(this);

      (function() {
        var dotsMenu;
        var fullMenu;
        dotsMenu = document.querySelector(".dots");
        fullMenu = document.querySelector(".fullMenu")
        dotsMenu.addEventListener("click", function() {
          fullMenu.classList.toggle("show");
          return dotsMenu.classList.toggle("on");
        });

      }).call(this);
    </script>
  </body>
</html>