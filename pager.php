<?php
//Change content based on the navigation options, and the page selected, 0=index, 1=tutorials, 2=snippets
if(!isset($_GET['p'])){
  echo "<article class=\"entry\">";
  $articleQuery = $db->prepare("Select * From Pages Where PageID = 3");
  $articleQuery->execute();
  $row = $articleQuery->fetch();
  $dirtyArticle = $parsedown->text($row['PageSummary']);
  $cleanArticle = $HTMLpurifier->purify($dirtyArticle);
  echo $cleanArticle;
  echo "</article>";
}else{
  switch ($_GET['p']) {
    case 'Tutorials':
      $pageId = "1";
      require("tutorials.php");
      break;
    case 'Snippets':
      $pageId = "2";
      require("snippets.php");
      break;
    case 'privacy':
      $pageId = "privacy";
      require("privacy.html");
      break;
      
    default:
      echo "<article class=\"entry\">";
      $articleQuery = $db->prepare("Select * From Pages Where PageID = 3");
      $articleQuery->execute();
      $row = $articleQuery->fetch();
      $dirtyArticle = $parsedown->text($row['PageSummary']);
      $cleanArticle = $HTMLpurifier->purify($dirtyArticle);
      echo $cleanArticle;
      echo "</article>";
      break;
  }
}
?>