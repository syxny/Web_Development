<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Songs</title>
    <link rel="stylesheet" type="text/css" href="includes/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>
    <div class="page-container">
        <?php 
    require_once 'includes/login.php';

    echo "<div class='content-wrap'>";
    include 'includes/navbar.html';
    include 'includes/search.html';


  echo "
  <h1 class='highl'>All Songs</h1>
  <div class='container'>
  <div class='card-container'>";

    try {
      // Create a new PDO instance
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Prepare the SQL statement to get all songs
      $stmt = $conn->prepare("SELECT songs.song_id, songs.title AS song_title, albums.title AS album_title, contributors.screenname AS singer_name, albums.album_art AS album_art FROM songs JOIN albums ON songs.album_id = albums.album_id JOIN contributor_role ON songs.song_id = contributor_role.song_id JOIN contributors ON contributor_role.cont_id = contributors.cont_id");
      // Execute the statement
      $stmt->execute();

      // Fetch the results as an associative array
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Close the database connection
      $conn = null;

      // Check if any results were found
      if ($results) {
        // Display the list of songs
        foreach ($results as $result) {
          echo "<a href='song.php?song_id=" . $result['song_id'] . "' class='card'>";
          echo "<img src='" . $result['album_art'] . "' alt='" . $result['brand'] . "' class='card-img'>";
          echo "<div class='card-body'>";
          echo "<h2 class='card-title'>" . ucwords($result['song_title']) . "</h2>";
          echo "<p class='card-text'>" . ucwords($result['album_title']) . " by " . ucwords($result['singer_name']) . "</p>";
          echo "</div>";
          echo "</a>";
        }
      } else {
        // Display a message if no results were found
        echo "<p class='erm'>No songs found.</p>";
      }
    } catch(PDOException $e) {
      // Display any errors that occur during database connection or query execution
      echo "Error: " . $e->getMessage();
    }

    echo "</div></div></div>";
    
    include "includes/footer.html";
    ?>
    </div>
</body>

</html>
