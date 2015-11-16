<!DOCTYPE html>
<html>
    <head>
	<title>Update Albums</title>
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
	<h2>Update Albums</h2>

	<?php
      if($_POST["cancel"]) {
        header("Location: http://betaweb.csug.rochester.edu/~xxu25/list-albums.php");
      } else if (isset($_POST["albumname"])&&isset($_POST["publishdate"])) {
			$albumName = $_POST["albumname"];
			$publishDate = $_POST["publishdate"];
			$briefInfo = $_POST["briefinfo"];
			$singerName = $_POST["singername"];
			$singerBirthday = $_POST["singerbirthday"];
			echo <<<EOHTML
			<form  action = "update-albums.php"  method = "post">
				<input type = "hidden" name = "albumnamePre" value = "$albumName"/>
		    	<input type = "hidden" name = "publishdatePre" value = "$publishDate"/>  
			  <div class="ui inverted segment">
			  <div class="ui grid">
			  <div class="four wide column"></div>
			  <div class="eight wide column">  
		       <table class="ui blue table"> 
		           <tr>   
		                <td>Album Name </td>  
		                <td><input type  = "text" name = "albumnameUp" value = "$albumName" maxlength = "100" size = "30"> </td>  
		           </tr>  
		           <tr>  
		                <td>Publish Date </td>  
		                <td><input type = "date" name = "publishdateUp" value = "$publishDate" size = "30"> </td>  
		           </tr>  
		           <tr>  
		                <td>briefInfo </td>  
		                <td><input type  = "text" name = "briefinfoUp" value = "$briefInfo" maxlength = "400" size = "30"> </td>  
		           </tr>
		           <tr>  
		                <td>Singer Name </td>  
		                <td><input type  = "text" name = "singernameUp" value = "$singerName" maxlength = "40" size = "20"> </td>  
		           </tr>
		           <tr>  
		                <td>Singer Birthday </td>  
		                <td><input type = "date" name = "singerbirthdayUp" value = "$singerBirthday" size = "30"> </td>  
		           </tr>    
		           <tr>  
		             <td colspan = "2"><input type = "submit" value = "SAVE" name = "save"></td>
		             <td colspan = "2"><input type = "submit" value = "CANCEL" name = "cancel"></td>  
		           </tr>  
		     </table>  
  			</form>
EOHTML;

		}

		else if (empty($_POST["albumnameUp"]) || empty($_POST["publishdateUp"])){
			echo 'Illegal input patterns! Please double check them';
		}
		else {
			$albumnameUp = $_POST["albumnameUp"];
			$publishdateUp = $_POST["publishdateUp"];
			$briefinfoUp = $_POST["briefinfoUp"];
			$singernameUp = $_POST["singernameUp"];
			$singerbirthdayUp = $_POST["singerbirthdayUp"];
			$albumnamePre = $_POST["albumnamePre"];
			$publishdatePre = $_POST["publishdatePre"];
			require_once ('./dbsetup.php');

			$stmt = $db->prepare("UPDATE albums SET albumName = :albumnameUp, publishDate = :publishdateUp, 
				briefInfo = :briefinfoUp, singerName = :singernameUp, singerBirthday = :singerbirthdayUp
				WHERE albumName = :albumnamePre AND publishDate = :publishdatePre");
			
			$stmt->bindParam(':albumnameUp', $albumnameUp, PDO::PARAM_STR, 40);
			$stmt->bindParam(':publishdateUp', $publishdateUp, PDO::PARAM_STR, 20);
			$stmt->bindParam(':briefinfoUp', $briefinfoUp, PDO::PARAM_STR, 400);
			$stmt->bindParam(':singernameUp', $singernameUp, PDO::PARAM_STR, 40);
			$stmt->bindParam(':singerbirthdayUp', $singerbirthdayUp, PDO::PARAM_STR, 20);
			$stmt->bindParam(':albumnamePre', $albumnamePre, PDO::PARAM_STR, 40);
			$stmt->bindParam(':publishdatePre', $publishdatePre, PDO::PARAM_STR, 20);

			try {
				if ($stmt->execute()){
					echo 'Album updated';
					header("Location: http://betaweb.csug.rochester.edu/~xxu25/show-albums.php?albumname=$albumnameUp&publishdate=$publishdateUp");
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
