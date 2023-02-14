<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Code Homework 1</title>
        <style>
            h2 {
                padding-left: 15px;
                font-family: verdana;
                font-size: 1.6rem;
            }
            p {
                padding-left: 25px;
                font-family: baskerville;
                font-size: 1.25rem;
                margin: 0;
            }
        </style>
</head>
<body>
    <?php
    echo "<h2>Challenge: Correct Change</h2>";
//Problem 1: Correct Change
        $a=594;
        //input the amount of change
        echo "<p>You are due $a cents back in change total.</p>";

        $b=$a % 100;
        //get the remainder
        $qb=($a-$b)/100;
        //get the quotient
        if ($qb==1){
            $fb= "1 Dollar,";
        }
        elseif ($qb==0){
            $fb="";
        }
        else {$fb= "$qb Dollars,";};
        //tidy up text

        $c=$b % 25;
        $qc=($b-$c)/25;
        if ($qc==1){
            $fc= "1 Quarter,";
        }
        elseif ($qc==0){
            $fc="";
        }
        else {$fc= "$qc Quarters,";};
        //Quarters

        $d=$c % 10;
        $qd=($c-$d)/10;
        if ($qd==1){
            $fd= "1 Dime,";
        }
        elseif ($qd==0){
            $fd="";
        }
        else {$fd= "$qd Dimes,";};
        //Dimes

        $e=$d % 5;
        $qe=($d-$e)/5;
        if ($qe==1){
            $fe= "1 Nickel,";
        }
        elseif ($qe==0){
            $fe="";
        }
        else {$fe= "$qe Nickels,";};
        //Nickels

        if ($e==1){
            $ff= "1 Cent,";
        }
        elseif ($e==0){
            $ff="";
        }
        else {$ff= "$e Cents,";};
        //Cents

        echo "<p>$fb $fc $fd $fe $ff</p>";


//Problem 2: 99 Bottles of beer!
        $x=9; 
        //specify the starting number of bottles
        echo "<h2>Challenge: $x Bottles of Beer</h2>";
        //title changes with the number of bottles specified

        echo "<p>";
        //start paragraph
        for ($i=$x; $i>=1; $i--) {
            // here i = number of bottles, more than or equal to 1, decrement fn
            
            $j=$i-1;
            // here j = remaining bottles, j goes down to 0

            echo "$i bottles of beer on the wall, $i bottles of beer!<br> 
            Take one down, pass it around, $j bottles of beer on the wall!<br>"; 
        };
        echo "</p>";
        //end paragraph
    ?>
</body>
</html>