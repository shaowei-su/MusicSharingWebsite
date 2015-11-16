<!DOCTYPE html>
<html>
    <head>
	<title>Update Songs</title>
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
	<h2>Update Songs</h2>

	<?php
	
	if($_POST["cancel"]) {
        header("Location: http://betaweb.csug.rochester.edu/~xxu25/list-songs.php");
      } else if (isset($_POST["albumname"])&&isset($_POST["publishdate"])&&isset($_POST["songname"])) {
			$songName = $_POST["songname"];
			$duration = $_POST["duration"];
			$genre = $_POST["genre"];
			$composer = $_POST["composer"];
			$wordAuthor = $_POST["wordauthor"];
			$albumName = $_POST["albumname"];
			$publishDate = $_POST["publishdate"];
			echo <<<EOHTML
			<form  action = "update-songs.php"  method = "post">
				<input type = "hidden" name = "songnamePre" value = "$songName"/>
				<input type = "hidden" name = "albumnamePre" value = "$albumName"/>
		    	<input type = "hidden" name = "publishdatePre" value = "$publishDate"/>  
				  <div class="ui inverted segment">
				  <div class="ui grid">
				  <div class="four wide column"></div>
				  <div class="eight wide column">  
			       <table class="ui blue table"> 
		        	<tr>  
                    <td>Song Name </td>  
                    <td><input type  = "text" name = "songnameUp" value = "$songName" maxlength = "40" size = "30"> </td>  
	               </tr>
	               <tr>  
	                    <td>Duration </td>  
	                    <td><input type  = "time" name = "durationUp" step="1" value = "$duration"> </td>  
	               </tr>
	               <tr>  
	                    <td>Genre </td>  
	                    <td><input type = "text" name = "genreUp" value = "$genre" maxlength = "20" size = "20"> </td>  
	               </tr>
	               <tr>   
	                    <td>Composer </td>  
	                    <td><input type  = "text" name = "composerUp" value = "$composer" maxlength = "40" size = "30"> </td>  
	               </tr>  
	               <tr>  
	                    <td>Word Author </td>  
	                    <td><input type = "text" name = "wordauthorUp" value = "$wordAuthor" maxlength = "40" size = "30"> </td>  
	               </tr>
		           	<tr>   
		                <td>Album Name </td>  
		                <td><input type  = "text" name = "albumnameUp" value = "$albumName" maxlength = "100" size = "30"> </td>  
		           	</tr>  
		           	<tr>  
		                <td>Publish Date </td>  
		                <td><input type = "date" name = "publishdateUp" value = "$publishDate" size = "30"> </td>  
		           	</tr> 
		           	<tr>  
		             <td colspan = "2"><input type = "submit" value = "SAVE" name = "save"></td>
		             <td colspan = "2"><input type = "submit" value = "CANCEL" name = "cancel"></td>  
		           	</tr>  
		     </table>  
  			</form>
EOHTML;
		}

		else if (empty($_POST["albumnameUp"]) || empty($_POST["publishdateUp"]) || empty($_POST["songnameUp"]) || empty($_POST["durationUp"])){
			echo 'Illegal input patterns! Please double check them';
		}
		else {
			$songnameUp = $_POST["songnameUp"];
		    $durationUp = $_POST["durationUp"];
		    $genreUp = $_POST["genreUp"];
		    $composerUp = $_POST["composerUp"];
		    $wordauthorUp = $_POST["wordauthorUp"];
		    $albumnameUp = $_POST["albumnameUp"];
      		$publishdateUp = $_POST["publishdateUp"];
      		$songnamePre = $_POST["songnamePre"];
      		$albumnamePre = $_POST["albumnamePre"];
			$publishdatePre = $_POST["publishdatePre"];
			require_once ('./dbsetup.php');

			$stmt = $db->prepare("UPDATE songs SET songName = :songnameUp, duration = :durationUp, genre = :genreUp,
				composer = :composerUp, wordAuthor = :wordauthorUp, albumName = :albumnameUp, publishDate = :publishdateUp
				WHERE songName = :songnamePre AND albumName = :albumnamePre AND publishDate = :publishdatePre");
			
			$stmt->bindParam(':songnameUp', $songnameUp, PDO::PARAM_STR, 40);
		    $stmt->bindParam(':durationUp', $durationUp, PDO::PARAM_STR, 40);
		    $stmt->bindParam(':genreUp', $genreUp, PDO::PARAM_STR, 20);
		    $stmt->bindParam(':composerUp', $composerUp, PDO::PARAM_STR, 40);
		    $stmt->bindParam(':wordauthorUp', $wordauthorUp, PDO::PARAM_STR, 40);
		    $stmt->bindParam(':albumnameUp', $albumnameUp, PDO::PARAM_STR, 40);
		    $stmt->bindParam(':publishdateUp', $publishdateUp, PDO::PARAM_STR, 20);
			$stmt->bindParam(':songnamePre', $songnamePre, PDO::PARAM_STR, 40);
			$stmt->bindParam(':albumnamePre', $albumnamePre, PDO::PARAM_STR, 40);
			$stmt->bindParam(':publishdatePre', $publishdatePre, PDO::PARAM_STR, 20);

			try {
				if ($stmt->execute()){
					echo 'Song updated';
					header("Location: http://betaweb.csug.rochester.edu/~xxu25/show-songs.php?songname=$songnameUp&albumname=$albumnameUp&publishdate=$publishdateUp");
				}
				else {
					echo 'Update failed';
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
   </div>  
 </div>
 </div> 
    </body>
</html>
