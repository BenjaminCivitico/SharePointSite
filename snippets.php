<?php
	//if we dont have a snippet ID then load the list of snippets.
	if(!isset($_GET['a'])){
		$query = $db->prepare("Select * From Snippets Where ArticleTypeID = 2");
		$query->execute();
		$result = $query;
		foreach ($result as $row) {
			echo "<a href=\".?p=2&a=".$row["SnippetID"]."\"><div class=\"article\">";
			echo "<h1>".$row["SnippetTitle"]."</h1>";
			$dirtyArticle = $parsedown->text(substr($row["SnippetText"], 0, 150))."<p>...(more)</p>";
			$cleanArticle = $HTMLpurifier->purify($dirtyArticle);
			echo $cleanArticle;
			echo "</div></a>";
		}
	}else{
		echo "<article class=\"entry\">";
		$articleQuery = $db->prepare("Select * From Snippets Where SnippetID = ?");
		$articleQuery->execute(array($HTMLpurifier->purify($_GET['a'])));
		$row = $articleQuery->fetch();
		$articleID = $row['SnippetID'];
		$dirtyArticle = $parsedown->text("#".$row['SnippetTitle']."\r\n".$row['SnippetText']."\r\n ##Reference \r\n".$row['SnippetRef']);
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