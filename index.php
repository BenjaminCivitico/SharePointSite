<?php
//ini_set('display_errors', 'On');
require_once("Connections/connect.php");
require_once("Plugins/Parsedown/parsedown.php");
require_once("Plugins/htmlpurifier-4.9.3/library/HTMLPurifier.auto.php");
$parsedown = new Parsedown();
$HTMLPurifierConfig = HTMLPurifier_Config::createDefault();
$HTMLpurifier = new HTMLPurifier($HTMLPurifierConfig);
$pageId = "0";
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
  	<div class="content">
  		<header class="pageHeader">
        <?php require("header.php"); ?>
      </header>
      <div class="nonHeader">
    		<div class="pageBody">
          <div class="pageContent">
            <div class="container">
              <?php
              //Change content based on the navigation options, and the page selected, 0=index, 1=tutorials, 2=snippets
              if(!isset($_GET['p'])){
                echo "<article class=\"entry\">";
                $indexMD = fopen("MarkDown/home page.md", r) or die("Please navigate this site using one of the links above!");
                echo $parsedown->text(fread($indexMD, filesize("Markdown/home page.md")));
                fclose($indexMD);
                echo "</article>";
              }else{
                switch ($_GET['p']) {
                  case '1':
                    $pageId = "1";
                    require("tutorials.php");
                    break;
                  case '2':
                    $pageId = "2";
                    require("snippets.php");
                    break;
                  
                  default:
                    echo "home page content";
                    break;
                }
              }
              ?>
            </div>
          </div>
        </div>
    		<div class="pageFooter">
          <?php require("footer.php");?>
        </div>
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
    <script src="js/prism.js"></script>
  </body>
</html>