<!DOCTYPE html>
<html>
    <head>
	<title>Show Songs</title>
	<style>
	    .centered {
		text-align: center;
	    }
	    TABLE {
		border-collapse: collapse;
	    }
	    TH {
		vertical-align: top;
		padding: 4px;
	    }
	    TD {
		vertical-align: top;
		border: 1pt solid grey;
		padding: 4px;
	    }
	    TD.firstrow {
		border-top: 2pt solid grey;
		border-color: green grey grey grey;
	    }
	</style>
	<link rel="stylesheet" type="text/css" href="dist/semantic.css">
    <link rel="stylesheet" type="text/css" href="homepage.css">
    </head>

<body id="home">
	  <div class="ui inverted masthead segment">
	    <div class="ui page grid">
	      <div class="column">
	        <div class="ui inverted blue menu">
	          <div class="header item"><a href="../~ssu9/index.php">Music Sharing</a></div>

	          <div class="right menu">
	          	<a class="item" href="list-songs.php">Song</a>
	            <a class="item" href="../~lwang65/list-playlists.php">Playlist</a>
	            <a class="item" href="list-albums.php">Album</a>
	            <a class="item" href="../~ssu9/list-concerts.php">Concert</a>
	          </div>
	        </div>
	      </div>
	    </div>
	<div class="center aligned ui inverted header">
	<h2>Show Songs</h2>

	<?php
	if ((isset($_GET["songname"])&&isset($_GET["albumname"]) && isset($_GET["publishdate"])) ||
		(isset($_POST["songname"])&&isset($_POST["albumname"]) && isset($_POST["publishdate"])))
	{
		if (isset($_GET["songname"])&&isset($_GET["albumname"]) && isset($_GET["publishdate"])){
			$songName = $_GET["songname"];
	    	$albumName = $_GET["albumname"];
	    	$publishDate = $_GET["publishdate"];
		}
		else {
			$songName = $_POST["songname"];
	    	$albumName = $_POST["albumname"];
	    	$publishDate = $_POST["publishdate"];
		}
	    $songName_safe = htmlspecialchars($songName);
	    $albumName_safe = htmlspecialchars($albumName);
	    $publishDate_safe = htmlspecialchars($publishDate);
	    require_once ('./dbsetup.php');
	    $stmt = $db->prepare('SELECT * FROM songs WHERE songName = :songName AND albumName = :albumName AND publishDate = :publishDate;'
	    );
	    $params = array(':songName' => $songName_safe, ':albumName' => $albumName_safe, ':publishDate'=>$publishDate_safe);
	    $stmt->execute($params);
	    $row = $stmt->fetch(PDO::FETCH_ASSOC); // there should be only 0 or 1 result
	    if (!$row)
	    {
		echo "<p>No song found with name $songName_safe, album $albumName_safe and publish date $publishDate_safe.</p>";
	    }
	    else
	    {
	    	$duration = $row['duration'];
	    	$genre = $row['genre'];
	    	$composer = $row['composer'];
	    	$wordauthor = $row['wordAuthor'];
			echo '<div class="ui grid">';
			echo '<div class="four wide column"></div>';
			echo '<div class="eight wide column">';
			echo "<p>Here are the details for the song with name $songName_safe, album $albumName_safe and publish date $publishDate_safe.</p>";
			echo '<table class="ui blue table">';
		foreach ($row as $attribute => $value)
		{
		    echo '<tr>',
		    '<td>', htmlspecialchars($attribute), '</td>',
		    '<td>', htmlspecialchars($value), '</td>',
		    '</tr>';
		}
		echo '</table>';
		echo '</div>';
		echo '</div>';
	    }
	     echo <<<EOHTML
       		<br> 
       		<br>
       		<div class="ui inverted vertical segment">
		    <form action="update-songs.php" method="post">
		    <div class="ui mini icon input">
		    	<input name="edit" type="submit" value="Edit"/>
		    </div>
		    	<input type = "hidden" name = "songname" value = "$songName_safe"/>
		    	<input type = "hidden" name = "albumname" value = "$albumName_safe"/>
		    	<input type = "hidden" name = "publishdate" value = "$publishDate_safe"/>
		    	<input type = "hidden" name = "duration" value = "$duration"/>
	    		<input type = "hidden" name = "genre" value = "$genre"/>
	    		<input type = "hidden" name = "composer" value = "$composer"/>
	    		<input type = "hidden" name = "wordauthor" value = "$wordauthor"/>
		    </form>
		    </div>

EOHTML;
	}

	else
	{
	    echo <<<EOHTML
	
         <form action="show-songs.php" method="get">
         <label>Please enter the song name </label>
		<input type="text" name="songname" />
         <label>album name </label>
		<input type="text" name="albumname" />
     	<label>publish date </label>
		<input type="text" name="publishdate" />
   <br> <br>
   	<input type="submit" />
    </form>
    
EOHTML;
	}
	?>
	<div class="ui inverted vertical segment">
	</div>
	</div>

  </div>
    </body>
</html>
