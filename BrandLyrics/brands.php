<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Brands</title>
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

    echo"<div class='container'>
  <h1 class='highl'>All Brands</h1>
  <div class='card-container'>";

    try {
      // Create a new PDO instance
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      // Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Prepare the SQL statement to get all brands and the number of songs for each brand
      $stmt = $conn->prepare("SELECT brands.brand_id, brands.brand, COUNT(*) AS num_songs, brands.logo_img FROM brands JOIN snippets ON brands.brand_id = snippets.brand_id GROUP BY brands.brand_id");
      // Execute the statement
      $stmt->execute();

      // Fetch the results as an associative array
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Close the database connection
      $conn = null;

      // Check if any results were found
      if ($results) {
        // Display the list of brands
        foreach ($results as $result) {
          echo "<a href='brand.php?brand_id=" . $result['brand_id'] . "' class='card'>";
          echo "<img src='" . $result['logo_img'] . "' alt='" . $result['brand'] . "' class='card-img'>";
          echo "<div class='card-body'>";
          echo "<h2 class='card-title'>" . ucwords($result['brand']) . "</h2>";
          echo "<p class='card-text'>Mentioned in " . $result['num_songs'] . " song(s)</p>";
          echo "</div>";
          echo "</a>";
        }
      } else {
        // Display a message if no results were found
        echo "<p class='erm'>No brands found.</p>";
      }
    } catch(PDOException $e) {
      // Display any errors that occur during database connection or query execution
      echo "Error: " . $e->getMessage();
    }
    echo "</div></div></div>";
    include 'includes/footer.html';

    ?>
    </div>

</body>

</html>
