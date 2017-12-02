<?php
	//if we dont have an article ID then load the list of articles.
	if(!isset($_GET['a'])){
		$query = $db->prepare("Select * From Articles Where ArticleTypeID = 1");
		$query->execute();
		$result = $query;
		foreach ($result as $row) {
			echo "<a href=\".?p=1&a=".$row["ArticleID"]."\"><div class=\"article\">";
			echo "<h1>".$row["ArticleTitle"]."</h1>";
			$dirtyArticle = $parsedown->text(substr($row["ArticleText"], 0, 150))."<p>...(more)</p>";
			$cleanArticle = $HTMLpurifier->purify($dirtyArticle);
			echo $cleanArticle;
			echo "</div></a>";
		}
	}else{
		echo "<article class=\"entry\">";
		$articleQuery = $db->prepare("Select * From Articles Where ArticleID = ?");
		$articleQuery->execute(array($_GET['a']));
		$row = $articleQuery->fetch();
		$articleID = $row['ArticleID'];
		$dirtyArticle = $parsedown->text("#".$row['ArticleTitle']."\r\n".$row['ArticleText']);
		$cleanArticle = $HTMLpurifier->purify($dirtyArticle);
		echo $cleanArticle;
		/* Uncomment this section to display tags at the bootom
		echo "<div class=\"tags\">";
		$tagQuery = $db->prepare("Select * From ArticleTags Where ArticleID = ?");
		$tagQuery->execute(array($articleID));
		$tagResult = $tagQuery;
		foreach($tagResult as $row){
			$tagID = $row['TagID'];
			$query = $db->prepare("Select * From Tags Where TagID = ?");
			$query->execute(array($tagID));
			$row = $query->fetch();
			echo $row['TagTitle'];
		}
		echo"</div>";
		*/
		echo"</article>";
	}
?>