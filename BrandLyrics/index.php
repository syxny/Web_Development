<!DOCTYPE html>
<html lang="en">

<head>
    <title>BrandLyrics - Home</title>
    <link rel="stylesheet" type="text/css" href="includes/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>

    <?php 
    	include 'includes/navbar.html';
	?>
    <!--Big search bar-->
    <div class="search-containerhp">
        <form action="../brandlyrics/results.php" method="get">
            <input class="search-inputhp" type="text" placeholder="Search..." name="search" autocomplete="off">
            <button class="search-buttonhp" type="submit">Search</button>
        </form>
    </div>

    <!--Website Description-->
    <div class="description">
        <p>Welcome to BrandLyrics! the ultimate destination for song lyrics and brand endorsements. Here, you can find lyrics for your favorite songs and discover new brands to love. Use the search bar to start exploring now!</p>
    </div>

    <?php
		include 'includes/footer.html';
	?>
</body>

</html>
