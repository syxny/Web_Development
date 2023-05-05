<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search Results</title>
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


echo "<h1 class='highl'>Search Results</h1>";

try {
  // Create a new PDO instance
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL statement to search for songs, albums, and brands
  $stmt = $conn->prepare("SELECT songs.song_id, songs.title AS song_title, albums.title AS album_title, snippets.lyrics, brands.brand AS brand_name FROM songs JOIN albums ON songs.album_id = albums.album_id JOIN snippets ON songs.song_id = snippets.song_id JOIN brands ON snippets.brand_id = brands.brand_id WHERE songs.title LIKE :search OR albums.title LIKE :search OR brands.brand LIKE :search OR snippets.lyrics LIKE :search");

  // Bind the search parameter
  $search = '%' . $_GET['search'] . '%';
  $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    
  // Execute the statement
  $stmt->execute();

  // Fetch the results as an associative array
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Close the database connection
  $conn = null;

  // Check if any results were found
  if ($results) {
    // Display the search results
    echo "<ul>";
    foreach ($results as $result) {
      echo "<li class='sr'>";
      echo "<p><a  class='searchl' href='song.php?song_id=" . $result['song_id'] . "'>" . ucwords($result['song_title']) . "</a></p>";
      echo "<p>Album: " . ucwords($result['album_title']) . "</p>";
      echo "<p>Brand: " . ucwords($result['brand_name']) . "</p>";
      echo "<p>Lyrics: " . $result['lyrics'] . "</p>";
      echo "</li>";
    }
    echo "</ul>";
  } else {
    // Display a message if no results were found
    echo "<p><span class='searchl'>No results found.</span></p>";
  }
} catch(PDOException $e) {
  // Display any errors that occur during database connection or query execution
  echo "Error: " . $e->getMessage();
}

echo "</div>";
include 'includes/footer.html';
?>
    </div>
</body>

</html>
