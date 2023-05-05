<!DOCTYPE html>
<html lang="en">

<head>
    <title>Brand Details</title>
    <link rel="stylesheet" type="text/css" href="includes/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>

    <div class="page-container">
        <?php
            //login.php
            require_once 'includes/login.php';

            echo "<div class='content-wrap'>";

            include 'includes/navbar.html';
            include 'includes/search.html';

            try {
                
  // Create a new PDO instance
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL statement to retrieve the brand with the given ID
  $stmt = $conn->prepare("SELECT * FROM brands JOIN categories ON brands.cat_id = categories.cat_id LEFT JOIN products ON brands.brand_id = products.brand_id JOIN snippets ON snippets.brand_id = brands.brand_id JOIN songs ON songs.song_id = snippets.song_id WHERE brands.brand_id = :id");
                
  // Bind the ID parameter
  $stmt->bindParam(':id', $_GET['brand_id']);
                
  // Execute the statement
  $stmt->execute();

  // Fetch the result as an associative array
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
  // Close the database connection
  $conn = null;

  // Check if a brand was found with the given ID
  if ($result) {
  // Display the brand details
      echo "<h1 class='highl'>" . ucwords($result[0]['brand']) . "</h1>";
      echo "<div class='info'>";
      echo "<div class='bd'><p> Brand Category: " . ucwords($result[0]['category']) . "</p><br><p>";
      echo $result[0]['description'] . "</p></div>";
      echo "<img class='bi' src='" . $result[0][' logo_img'] . "' alt='" . $result[0]['brand'] . " logo'>" ; echo "</div>" ; 
      // Display the related products, if any 
      echo "<h2 class='highl'>Related Products</h2>" ; $products=$result; if ($result[0]['product_id'] !==null) { echo "<div class='card-container'>" ; foreach ($products as $product) { echo "<div class='cardz'><img class='card-img' src='" . $product['product_img'] . "' alt='" . $product['name'] . "'><p class='card-text'>" . ucwords($product['name']) . "</p></div>" ; } echo "</div>" ;                     } else {
      // Display a message if no products were found related to the brand 
      echo "<div class='info'>" ; 
      echo "<p class='bd'>No related products were found.</p>" ; 
      echo "</div>" ; }
      
      // Display the songs related to the brand 
      $songs=$result; if ($songs){ 
          echo "<h2 class='highlm'>Songs related to '" . ucwords($result[0]['brand']) . "'</h2>" ; foreach ($songs as $song) { echo "<a class='listed' href='song.php?song_id=" . $song['song_id'] . "'>" . ucwords($song['title']) . "</a>" ; } } } else {
      // Display an error message if no brand was found 
      echo "<p class='erm'>Brand not found.</p>" ; }
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
