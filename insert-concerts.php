<html>  
<head>  
    <title> Concerts insert </title> 
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
<h2> Concerts - new concert entry results</h2>  
  <?php  
      if($_POST["cancel"]) {
        header("Location: http://betaweb.csug.rochester.edu/~ssu9/list-concerts.php");
      }
      else if(empty($_POST['title']) || empty($_POST['heldDate']) || empty($_POST['location']) || empty($_POST['avgPrice']) || empty($_POST['briefInfo']) || empty($_POST['singerName']) || empty($_POST['singerBirthday'])) {
        echo 'Illegal input patterns! Please double check them';
      } else {
          //create short variable names  
          $title = $_POST['title'];  
          $heldDate = $_POST['heldDate'];  
          $location = $_POST['location'];  
          $avgPrice = $_POST['avgPrice'];
          $briefInfo = $_POST['briefInfo'];
          $singerName = $_POST['singerName'];
          $singerBirthday = $_POST['singerBirthday'];            
          require_once './dbsetup.php';

          $stmt = $db->prepare("INSERT INTO  concerts (title, heldDate, location, avgPrice, briefInfo, singerName, singerBirthday) VALUES (:title, :heldDate, :location, :avgPrice, :briefInfo, :singerName, :singerBirthday)");
          $stmt->bindParam(':title', $title, PDO::PARAM_STR, 100);
          $stmt->bindParam(':heldDate', $heldDate, PDO::PARAM_STR, 20);
          $stmt->bindParam(':location', $location, PDO::PARAM_STR, 100);
          $stmt->bindParam(':avgPrice', $avgPrice, PDO::PARAM_INT); 
          $stmt->bindParam(':briefInfo', $briefInfo, PDO::PARAM_STR, 200);
          $stmt->bindParam(':singerName', $singerName, PDO::PARAM_STR, 40);
          $stmt->bindParam(':singerBirthday', $singerBirthday, PDO::PARAM_STR, 20);
          try {
              if($stmt->execute()) {
                echo '1 row been inserted';
                header("Location: http://betaweb.csug.rochester.edu/~ssu9/show-concerts.php?title=$title&heldDate=$heldDate");
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
</div>
</div>
</body>  
</html>