<?php
//this page is going to list all the concerts in the database
?>
<!DOCTYPE html>
<html>
    <head>
	<title>Music Sharing - Concerts</title>
	<link rel="stylesheet" type="text/css" href="dist/semantic.css">
    <link rel="stylesheet" type="text/css" href="homepage.css">
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
    </head>


<body id="home">
  <div class="ui inverted masthead segment">
    <div class="ui page grid">
      <div class="column">
        <div class="ui inverted blue menu">
          <div class="header item"><a href="index.php">Music Sharing</a></div>

          <div class="right menu">
            <a class="item" href="../~xxu25/list-songs.php">Song</a>
            <a class="item" href="../~lwang65/list-playlists.php">Playlist</a>
            <a class="item" href="../~xxu25/list-albums.php">Album</a>
            <a class="item" href="list-concerts.php">Concert</a>

          </div>
        </div>
    </div>
  </div>

	<div class="center aligned ui inverted header">
	<h2>Music Sharing - Concerts</h2>
	<div class="ui inverted segment">
    <form action = "./search-concerts.php" method = "post" >

      <select class="ui selection dropdown" name = "searchtype" type = "text">
         <option value = "singerName "> Singer </option>
         <option value = "location" > Location </option>
         <option value = "title"> Title </option>
      </select>

      <div class="ui mini icon input">
      	<div class="ui fluid icon input">
      <input name = "searchterm" type = "text">
        </div>
      <input type = "submit" value = "SEARCH">
      </div> 

    </form>
	</div>

    <br>
    <br>

	<?php
		require_once './dbsetup.php';
		echo '<div class="ui grid">';
		echo '<div class="four wide column"></div>';
		echo '<div class="eight wide column">';
		echo '<table class="ui blue table">';
		echo '<tr>',
		'<th>Title</th>',
		'<th>heldDate</th>',
		'<th>location</th>',
		'<th>singer</th>',
		"</tr>\n";
		$sql = "SELECT * FROM concerts";
		foreach ($db->query($sql) as $row)
		{

	        echo '<tr>';
	        echo "<td><a href='http://betaweb.csug.rochester.edu/~ssu9/show-concerts.php?title=${row['title']}&heldDate=${row['heldDate']}'> ${row['title']}</a></td>";
	        echo "<td>${row['heldDate']}</td>";
	        echo "<td>${row['location']}</td>";
		    echo "<td><a href='http://betaweb.csug.rochester.edu/~ssu9/find-singers.php?singerName=${row['singerName']}'>${row['singerName']}</a></td>";              
	        echo "</tr>\n";
	    }
		echo '</table>';
		echo '</div>';
		echo '</div>';
	
    ?>
    <br>
	    <div class="ui inverted vertical segment">
		    <form action="./insert-concerts.html">
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
