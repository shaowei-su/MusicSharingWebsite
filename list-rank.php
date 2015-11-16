<!DOCTYPE html>
<html>
    <head>
	<title>Music Sharing - Rank</title>
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

    <body>
	<h2>Music Sharing - Rank</h2>

	<?php
	require_once './dbsetup.php';

	try {

	    echo '<table>';
	    // print column headers
	    echo '<tr>',
	    '<th>Rank</th>',
	    '<th>Song Name</th>',
	    '<th>Album Name</th>',
	    '<th>Publish Date</th>',
	    '<th>Score</th>',
	    "</tr>\n";
     	
	    $sql = " (SELECT songName, albumName, publishDate, avgScore FROM (SELECT * FROM songs NATURAL LEFT OUTER JOIN
                    (SELECT songName, albumName, publishDate, AVG(score) AS avgScore FROM scores GROUP BY songName, albumName,                            publishDate)AvgS)TT
                            WHERE avgScore IS NOT NULL ORDER BY avgScore DESC)
                           ";
        $rank = 1;
	    foreach ($db->query($sql) as $row)
	    {
	    	echo '<tr>';
	    	echo "<td>$rank</td>";
		    echo "<td><a href='http://betaweb.csug.rochester.edu/~xxu25/show-songs.php?songname=${row['songName']}&albumname=${row['albumName']}&publishdate=${row['publishDate']}'>
           		${row['songName']}</a></td>";
    		echo "<td><a href='http://betaweb.csug.rochester.edu/~xxu25/show-albums.php?albumname=${row['albumName']}&publishdate=${row['publishDate']}'>
           		${row['albumName']}</a></td>";
       		echo "<td>${row['publishDate']}</td>";
       		echo "<td>${row['avgScore']}</td>";
		    echo "</tr>\n";
		    $rank = $rank + 1;

	    }
	  
	    echo '</table>';

	    $db = null;
	}
	catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
	?>

    </body>
</html>
