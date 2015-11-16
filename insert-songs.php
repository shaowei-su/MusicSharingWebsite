<html>  
<head>  
    <title> Songs insert </title>
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
<h2> Songs - new song entry results</h2>  
  <?php  
    
    if($_POST["cancel"]) {
        header("Location: http://betaweb.csug.rochester.edu/~xxu25/list-songs.php");
      }else if (empty($_POST["albumname"]) || empty($_POST["publishdate"]) || empty($_POST["songname"]) || empty($_POST["duration"])){
      echo 'Illegal input patterns! Please double check them';
    }
    else {
      $songname = $_POST["songname"];
      $duration = $_POST["duration"];
      $genre = $_POST["genre"];
      $composer = $_POST["composer"];
      $wordauthor = $_POST["wordauthor"];
      $albumname = $_POST["albumname"];
      $publishdate = $_POST["publishdate"];
      
      require_once ('./dbsetup.php');

      $stmt = $db->prepare("INSERT INTO songs VALUES 
                    (:songname, :duration, :genre, :composer, :wordauthor, :albumname, :publishdate)");    
      $stmt->bindParam(':songname', $songname, PDO::PARAM_STR, 40);
      $stmt->bindParam(':duration', $duration, PDO::PARAM_STR, 40);
      $stmt->bindParam(':genre', $genre, PDO::PARAM_STR, 20);
      $stmt->bindParam(':composer', $composer, PDO::PARAM_STR, 40);
      $stmt->bindParam(':wordauthor', $wordauthor, PDO::PARAM_STR, 40);
      $stmt->bindParam(':albumname', $albumname, PDO::PARAM_STR, 40);
      $stmt->bindParam(':publishdate', $publishdate, PDO::PARAM_STR, 20);

      try {
        if ($stmt->execute()){
          echo 'Song inserted';
          header("Location: http://betaweb.csug.rochester.edu/~xxu25/show-songs.php?songname=$songname&albumname=$albumname&publishdate=$publishdate");
        }
        else {
          echo 'Insertion failed';
        }
      }
      catch (PDOException $e) {
              echo $e->getMessage();
            }
    } 
  ?> 
    <div class="ui inverted vertical segment">
    </div>
    <div class="ui inverted vertical segment">
    </div>
    <div class="ui inverted vertical segment">
    </div>
    <div class="ui inverted vertical segment">
    </div> 
</body>  
</html>