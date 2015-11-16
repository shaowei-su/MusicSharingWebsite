<html>  
<head>  
    <title> Playlists insert </title>
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
<h2> Playlists - new playlist entry results</h2>  
  <?php  
    
      if($_POST["cancel"]) {
        header("Location: http://betaweb.csug.rochester.edu/~lwang65/list-playlists.php");
      }else if(empty($_POST['playlistName']) || empty($_POST['createDate']) || empty($_POST['username'])) {
        echo 'Illegal input patterns! Please double check them';
      } else {
          //create short variable names  
          $playlistName= $_POST['playlistName'];  
          $createDate = $_POST['createDate'];  
          $username = $_POST['username'];  
                   
          require_once './dbsetup.php';

          $stmt = $db->prepare("INSERT INTO  playlists (playlistName, createDate, username) VALUES (:playlistName, :createDate, :username)");
          $stmt->bindParam(':playlistName', $playlistName, PDO::PARAM_STR, 100);
          $stmt->bindParam(':createDate', $createDate, PDO::PARAM_STR, 100);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR, 100);
        
          try {
              if($stmt->execute()) {
                echo '1 row been inserted';
                header("Location: http://betaweb.csug.rochester.edu/~lwang65/list-playlists.php");
              } else {
                echo 'The insertion failed';
              }
          } catch (PDOException $e) {
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