<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Code Homework 2</title>
        <style>
            img {
                width: 100px;
                height: 100px;
            }
            /* fix size for coin images */
        </style>
</head>
<body>
    <h2>Challenge: ISBN Validator</h2>
    <?php
    
    $isbn;

function isbn_validator($isbn) {
    $sum = 0;

    for ($i = 0; $i < 9; $i++) {
        $sum += (int)$isbn[$i] * (10 - $i);
        //using integer and array selector on $isbn and multiply by required number
    }

    if ($isbn[9] == "X") {
        $sum += 10;
        } else {
        $sum += (int)$isbn[9];
    }
    //replace "X" by the number 10 if required

    return ($sum % 11 == 0) ? "Valid" : "Invalid";
    //
}

$isbn = "1616899778";
//^^^input isbn number here^^^

$validity = isbn_validator($isbn);
echo "Checking ISBN: $isbn for validity...<br>$test is: <b>$validity!</b><br>";
//display the number being checked and the result

echo ($validity == "Valid") ?
    "You can find out more about the book here: ".'<a href="http://www.isbnsearch.org/isbn/'.$isbn.'" target="_blank">Click Me!</a>' ."<br>" : "<br>" ;
//if valid isbn provide a detail page


echo "<h2>Challenge: Coin Toss! (a)</h2>";

function coinflip(){
    $result = rand(0, 1);
    
    if ($result == 0) {
    $imgfile = "heads.png";
    //specify heads image for 0
    } else {
    $imgfile = "tails.png";
    }
    //specify tails image for 1
    
    
    echo "<img src='img/$imgfile' alt='Coin Flip Result'>";
    //displaying the image
    }
    
function fliptimes($j){
        $j;
        echo "Flippin coin $j times...<br>";
        for ($i=0; $i<$j; $i++){
        coinflip();
        }
        //looping coinflip funtion multiple times
        echo "<br>";
}
    
for ($i=1; $i<=9; $i+=2){
    fliptimes($i);
    //using fliptimes() function in a loop till 9 flips with increase as odd number.
}

echo "<h2>Challenge: Coin Toss (b)</h2>";

$heads = 0;
//number of heads flipped
$tossn = 0;
//number of tosses

echo "Beginning the coin flipping...<br>";
while ($heads < 2) {
    // flipping the coin until heads reach 2
  $result = rand(0, 1);
  $tosses++;

  if ($result == 0) {
    $imgfile = "heads.png";
    $heads++;
    //if heads, increase heads count
    echo "<img src='img/$imgfile' alt='Coin Flip Result'>";
  } else {
    $imgfile = "tails.png";
    $heads=0;
    //if tails, reset the heads count 
    echo "<img src='img/$imgfile' alt='Coin Flip Result'>";
  };
}
echo "<br>Flipped two heads in a row, in $tosses flips.";
//display the result

?>
</body>
</html>