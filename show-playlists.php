<?php
// File: show-team.php
// Purpose: demonstrate GET parameter, DB fetch and FORMS processing
// Modified: 2015-03-31
?>

<!DOCTYPE html>
<html>
    <head>
	<title>Show Playlists</title>
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
	          	<a class="item" href="../~xxu25/list-songs.php">Song</a>
	            <a class="item" href="list-playlists.php">Playlist</a>
	            <a class="item" href="../~xxu25/list-albums.php">Album</a>
	            <a class="item" href="../~ssu9/list-concerts.php">Concert</a>
	          </div>
	        </div>
	      </div>
	    </div>
	<div class="center aligned ui inverted header">
	<h2>Show Playlists</h2>

	<?php
	if (isset($_GET["playlistName"])&&isset($_GET["username"]))
	{
	    $playlistName = $_GET["playlistName"];
	    $username = $_GET["username"];
	    $playlistName_safe = htmlspecialchars($playlistName);
	    $username_safe = htmlspecialchars($username);
	    require_once './dbsetup.php';
	    $stmt = $db->prepare('SELECT * FROM playlists WHERE playlistName = :playlistName AND username = :username;');
	    $params = array(':playlistName' => $playlistName_safe, ':username' => $username_safe);
	    $stmt->execute($params);
	    $row = $stmt->fetch(PDO::FETCH_ASSOC); // there should be only 0 or 1 result
	    if (!$row)
	    {
		echo "<p>No playlist found with id $playlistName_safe and $username_safe.</p>";
	    }
	    else
	    {
		echo '<div class="ui grid">';
		echo '<div class="four wide column"></div>';
		echo '<div class="eight wide column">';
		echo "<p>Here are the details for the playlist with id $playlistName_safe and $username_safe:</p>";
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

	    try {
				echo '<div class="ui grid">';
				echo '<div class="four wide column"></div>';
				echo '<div class="eight wide column">';
			    // print column headers
			    echo '<table class="ui blue table">';
			    echo '<tr>',
			    '<th>Song Name</th>',
			    "</tr>\n";

			    $querySong = "SELECT * FROM playlistContent";
			    foreach ($db->query($querySong) as $srow)
			    {
           			if($srow['publisher']==$username_safe && $srow['playlistName']==$playlistName_safe){
		         	echo '<tr>';
				   	echo "<td><a href='http://betaweb.csug.rochester.edu/~xxu25/show-songs.php?songname=${srow['songName']}&albumname=${srow['albumName']}&publishdate=${srow['publishDate']}'>
          				${srow['songName']}</a></td>";  
		        	echo "</tr>\n";
		         }
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
	    }

	}
	else
	{
	    echo <<<EOHTML
	    <form action="show-playlists.php" method="get">
		<label>Please enter the playlistName and username:</label>
		<input type="text" name="playlistName"/>
		<input type="text" name="username"/>
		<br> <br>
		<input type="submit" />
	    </form>
EOHTML;
	}
	?>
	<div class="ui inverted vertical segment">
	</div>
	<div class="ui inverted vertical segment">
	</div>
	<div class="ui inverted vertical segment">
	</div>
	</div>

  </div>
    </body>
</html>
