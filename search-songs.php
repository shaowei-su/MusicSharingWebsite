<?php
//this page is going to list all the concerts searched by users
//referenced on http://blog.csdn.net/m6830098/article/details/8780104
?>
<html>
<head>
    <title> Songs Search Results </title>
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
      <h2> Songs Search Results</h2>
      <?php
          /* check if the user has input enough data*/
          if (!empty($_POST["type"])) {
              $type = $_POST['type'];
              $term = $_POST['searchterm'];
              require_once './dbsetup.php';
              $term = mysql_real_escape_string($term); // santinize the data
              $term = htmlentities($term);
              $results = $db->query("SELECT * FROM songs NATURAL LEFT OUTER JOIN albums WHERE $type LIKE '%$term%'");
              /* check if the result if empty*/
              if ($results->rowCount() == 0)
              {
                  echo "<p>No song found with $term.</p>";
              }
              else 
              {
                  echo '<div class="ui grid">';
                  echo '<div class="four wide column"></div>';
                  echo '<div class="eight wide column">';
                  echo '<table class="ui blue table">';
                  echo '<tr>',
                  '<th>Song Name</th>',
                  '<th>Album Name</th>',
                  '<th>Publish Date</th>',
                  '<th>Singer</th>',
                  "</tr>\n";
                  foreach ($results as $row)
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
              }

          } else {
            echo 'Not enough info! Please try again' ;
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