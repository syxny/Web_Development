<!DOCTYPE html>
<html lang="en">

<head>
    <title>Song Details</title>
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


try {
  // Create a new PDO instance
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL statement to retrieve the song with the given ID
  $stmt = $conn->prepare("SELECT songs.song_id, songs.title AS title, albums.title AS albumname, albums.album_art, albums.year, languages.language, languages.origin, languages.dialect, snippets.lyrics, brands.brand_id, brands.brand, contributors.screenname, contributors.fname, contributors.mname, contributors.lname FROM songs JOIN albums ON songs.album_id = albums.album_id JOIN languages ON songs.lang_id = languages.lang_id JOIN snippets ON songs.song_id = snippets.song_id JOIN brands ON snippets.brand_id = brands.brand_id JOIN contributor_role ON songs.song_id = contributor_role.song_id JOIN contributors ON contributor_role.cont_id = contributors.cont_id WHERE songs.song_id = :id");
  // Bind the ID parameter
  $stmt->bindParam(':id', $_GET['song_id']);
  // Execute the statement
  $stmt->execute();

  // Fetch all the rows as an associative array
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Close the database connection
  $conn = null;

  // Check if a song was found with the given ID
  if ($rows) {
    // Display the song details
    $result = $rows[0];
    echo "<h1 class='highl'>" . ucwords($result['title']) . "</h1>";
    echo "<div class='info'>";
    echo "<div class'bd'><p> Album: " . ucwords($result['albumname']) . "</p><br><p>" . ucwords($result['title']) . " is part of the album " . ucwords($result['albumname']) . " released in " . $result['year'] . ". It is sung by " . ucwords($result['screenname']) . " who is also known by the name " . ucwords($result['fname']) . " " . ucwords($result['mname']) . " " . ucwords($result['lname']) . ". The song is sung in " . ucwords($result['dialect']) . " dialect of the " . ucwords($result['language']) ." language. The " . ucwords($result['language']) . " language originated in " . ucwords($result['origin']) . ".</p></div>";
    echo "<img class='bi' src='" . $result['album_art'] . "' alt='" . $result['albumname'] . " cover'>";
    echo "</div>";

    echo "<h2 class='highl'>Snippets featured from this song</h2>";
    echo "<div class='info'><ul>";
    foreach ($rows as $row) {
        echo "<li class='bd'>" . $row['lyrics'] . "</li>";
    }
    echo "</ul></div>";
    
    echo "<h2 class='highlm'>Brands related to '" . ucwords($result['title']) . "'</h2>";
      foreach ($rows as $row) {
        echo "<a class='listed' href='brand.php?brand_id=" . $row['brand_id'] . "'>" . ucwords($row['brand']) . "</a>";
      }

  } else {
    // Display an error message if no song was found
    echo "<p class='erm'>Sorry! This song doesn't exist, Yet!</p>";
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
