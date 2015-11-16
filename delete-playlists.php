<html>  
<head>  
    <title> Playlists Delete </title>  
</head>  
  
<body>  
<h1> Playlists - Playlists entry results</h1>  
  <?php  
    
      if(empty($_POST['playlistName']) || empty($_POST['username'])) {
       echo 'Illegal input patterns! Please double check them';
      } else {
          //create short variable names  
          $playlistName = $_POST['playlistName'];  
          $username = $_POST['username'];  
                   
          require_once './dbsetup.php';

          $stmt = $db->prepare("DELETE FROM playlists WHERE playlistName = :playlistName and username = :username");
          $stmt->bindParam(':playlistName', $playlistName, PDO::PARAM_STR, 100);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR, 100);
          
          try {
              if($stmt->execute()) {
                echo '1 row been deleted';
                  header("Location: http://betaweb.csug.rochester.edu/~lwang65/list-playlists.php");
              } else {
                echo 'The delete failed';
              }
          } catch (PDOException $e) {
              echo $e->POSTMessage();
          }
                     
      }
   
  ?>  
</body>  
</html>