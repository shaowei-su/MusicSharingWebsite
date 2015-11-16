<?php
//this page is going to list all the concerts in the database
?>
<!DOCTYPE html>
<html>
    <head>
	<title>Music Sharing - Playlists</title>
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
	<h2>Music Sharing - Playlists</h2>

    <?php
	    require_once './dbsetup.php';


		echo '<div class="ui grid">';
		echo '<div class="four wide column"></div>';
		echo '<div class="eight wide column">';
		echo '<table class="ui blue table">';
		echo '<tr>',
		'<th>playlistName</th>', 
		'<th>username</th>', 
		'<th>Delete</th>',
		"</tr>\n";

		$sql = "SELECT * FROM playlists";
		foreach ($db->query($sql) as $row)
		{
	            $playlistName =  $row["playlistName"];
	            $username = $row["username"];
	            echo '<tr>';
	            echo "<td><a href='http://betaweb.csug.rochester.edu/~lwang65/show-playlists.php?playlistName=${row['playlistName']}&username=${row['username']}'> 
	            ${row['playlistName']}</a></td>";
				echo "<td><a href='http://betaweb.csug.rochester.edu/~lwang65/find-playlists.php?username=${row['username']}'> 
	            ${row['username']}</a></td>";
	            echo "<td>";	 			
	            echo '<form action="http://betaweb.csug.rochester.edu/~lwang65/delete-playlists.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this playlist?\');">';
	 			echo '<input type="hidden" name="playlistName" value="' . $playlistName . '" >';
	 			echo '<input type="hidden" name="username" value="' . $username . '">';
	 			echo '<input type="submit" name="submit" value="Delete" />';
	 			echo '</form>';
				echo "</td>";
	            
	         
	          
    
            echo "</tr>\n";


    }
	    echo '</table>';
		echo '</div>';
		echo '</div>';

    
   ?>

	<div class="ui inverted vertical segment">
	    <form action="insert-playlists.html">
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
