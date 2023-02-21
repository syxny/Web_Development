<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Code Homework 3</title>
        <style>
            img {
                width: 5rem;
                height: 5rem;
            }
            /* fix size for coin images */

            table {
                border-collapse: collapse;
                width: 95%;
                margin: auto;
            }
            tr:hover {
                background-color: #FFEB3B;
            }
            tr:nth-child(1) {
                background-color: #00ACC1 !important;
                color: #E0F7FA !important;
                font-weight: bold;
            }
            tr {
                background-color: #E0F7FA;
                color: #006064;
            }
            td {
                border: 1px solid #00ACC1;
                padding: .5rem;
            }
            .total {
                box-sizing: border-box;
                width: 30%;
                margin: auto;
                padding: 2rem;
                background-color: #E0F7FA;
                color: #006064;
                font-size: 1.5rem;
                font-weight: bold;
                border: 1px solid #00ACC1;
                border-radius: 2rem;
                text-align: center;
            }
        </style>
</head>
<body>
    <?php
        echo "<h2>Challenge: Book Lists</h2>";

        $bookdata = array(
            array("Title","Author","Number of Pages","Type","Price ($)"),
            array("PHP and MySQL Web Development","Luke Welling",144,"Paperback", 31.63),
            array("Web Design with HTML, CSS, JavaScript and jQuery", "Jon Duckett", 135, "Paperback", 41.23),
            array("PHP Cookbook: Solutions & Examples for PHP Programmers", "David Sklar", 14, "Paperback", 40.88),
            array("JavaScript and JQuery: Interactive Front-End Web Development", "Jon Duckett", 251, "Paperback", 22.09),
            array("Modern PHP: New Features and Good Practices", "Josh Lockhart", 7, "Paperback", 28.49),
            array("Programming PHP", "Kevin Tatroe", 26, "Paperback", 28.96)
        );

        echo "<table>";
		$keys = array_keys($bookdata);
		for($i = 0; $i < count($bookdata); $i++) {
		    echo "<tr>";
		    foreach($bookdata[$keys[$i]] as $key => $value) {
		        echo "<td>" . $value . "</td>";
		    }
		    echo "</tr>";
		}
        echo "</table>";

        $total = 0.00;
        foreach ($bookdata as $data) {
            $total += floatval($data[4]);
        }
        
        echo "<br><div class='total'>Your total price is $" . $total . "</div>";

        echo "<h2>Challenge: Coin Toss</h2>";

        function headtimes($count){
            $heads = 0;
            //number of heads flipped
            $tossn = 0;
            //number of tosses
            if ($count > 10) {
                echo "<p>Please enter a number less than 10</p>";
            }
            else {
                echo "Beginning the coin flipping...<br>";
                while ($heads < $count) {
                    // flipping the coin until heads reach 2
                    $result = rand(0, 1);
                    $tossn++;

                    if ($result == 0) {
                        $imgfile = "heads.png";
                        $heads++;
                        //if heads, increase heads count
                       echo "<img src='img/$imgfile' alt='Coin Flip Result'>";
                    }
                    else {
                        $imgfile = "tails.png";
                        $heads=0;
                        //if tails, reset the heads count 
                        echo "<img src='img/$imgfile' alt='Coin Flip Result'>";
                    };
                }
                echo "<br>Flipped $count heads in a row, in $tossn flips.";
                //display the result
            }
        }

        headtimes(8);
        //Calling the function with 8 heads in a row requested
    ?>
</body>
</html>