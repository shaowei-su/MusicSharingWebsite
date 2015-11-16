<!DOCTYPE html>
<html>
    <head>
	<title>Music Sharing - Songs</title>
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
	<h2>Music Sharing - Songs</h2>

	<?php
	require_once './dbsetup.php';
	echo <<<EOHTML
	<div class="ui inverted segment">
	<form action="search-songs.php" method="post">

	<select class="ui selection dropdown" name = "type" type = "text">
	<option value="songName">song</option>
	<option value="albumName">album</option>
	<option value="singerName">singer</option>
	</select>

	<div class="ui mini icon input">
	<div class="ui fluid icon input">
	<input type="text" name="searchterm" />
	</div>
	<input type="submit" value="SEARCH"/>
	</div>
	</form>
	</div>
EOHTML;

	try {

		echo '<div class="ui grid">';
		echo '<div class="four wide column"></div>';
		echo '<div class="eight wide column">';
		echo '<table class="ui blue table">';
	    // print column headers
	    echo '<tr>',
	    '<th>Song Name</th>',
	    '<th>Album Name</th>',
	    '<th>Publish Date</th>',
	    '<th>Singer</th>',
	    "</tr>\n";

	    $sql = "SELECT * FROM songs NATURAL LEFT OUTER JOIN albums;";

	    foreach ($db->query($sql) as $row)
	    {
	
         	echo '<tr>';
		   	echo "<td><a href='http://betaweb.csug.rochester.edu/~xxu25/show-songs.php?songname=${row['songName']}&albumname=${row['albumName']}&publishdate=${row['publishDate']}'>
           ${row['songName']}</a></td>";
    		echo "<td><a href='http://betaweb.csug.rochester.edu/~xxu25/show-albums.php?albumname=${row['albumName']}&publishdate=${row['publishDate']}'>
           ${row['albumName']}</a></td>";
        	echo "<td>${row['publishDate']}</td>";
        	echo "<td>${row['singerName']}</td>";
        	echo "</tr>\n";
         
	    }
	  
	    echo '</table>';
		echo '</div>';
		echo '</div>';

	    $db = null;
	}
	catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
	?>
	<div class="ui inverted vertical segment">
	    <form action="insert-songs.html">
		    <div class="ui mini icon input">
		    <input type="submit" value="INSERT">
			</div>
		</form>
	</div>
	<div class="ui inverted vertical segment">
	</div>
	</div>

  </div>
    </body>
</html>
