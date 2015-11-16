<?php
//this php file is used to show details about certain concert
?>

<!DOCTYPE html>
<html>
    <head>
	<title>Show Concerts</title>
	<link rel="stylesheet" type="text/css" href="dist/semantic.css">
    <link rel="stylesheet" type="text/css" href="homepage.css">
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
	<h2>Show Concerts</h2>

	<?php
	if (isset($_GET["title"]) && isset($_GET["heldDate"]))
	{   
	    $title = $_GET["title"];
	    $heldDate = $_GET["heldDate"];
	    $title_safe = htmlspecialchars($title);
	    $heldDate_safe = htmlspecialchars($heldDate);
	    require_once './dbsetup.php';
	    $stmt = $db->prepare('SELECT * FROM concerts WHERE title = :title AND heldDate = :heldDate;');
	    $params = array(':title' => $title, ':heldDate' => $heldDate);
	    $stmt->execute($params);
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    if (!$row)
	    {
		echo "<p>No concert found with $title_safe.</p>";
	    }
	    else
	    {
	    echo '<div class="ui grid">';
		echo "<p>Here is the concert $title_safe</p>";
		echo '<div class="four wide column"></div>';
		echo '<div class="eight wide column">';
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
	}
	else
	{
	    echo <<<EOHTML
	    <form action="show-concerts.php" method="get">
		<label>Please enter the concert title:</label>
		<input type="text" name="title"/>
		<br> <br>
		<label>Please enter the concert date:</label>
		<input type="text" name="heldDate"/>
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
	</div>
	</div>
    </body>
</html>
