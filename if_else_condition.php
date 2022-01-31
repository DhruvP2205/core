<?php
    $age = 60;

    if ($age < 5) {
        echo "Baby";
    } else if($age < 15) {
        echo "Child";
    }else if($age < 25) {
        echo "Teenage";
    }else if($age < 45) {
        echo "Adult";
    }else if($age > 45){
        echo "Eldery";
    }

    echo "<br>";

    $num = 7;

    if($num % 2 == 0){
        echo "$num is divide by 2.";
    }else if($num % 3 == 0){
        echo "$num is divide by 3.";
    }else if($num % 4 == 0){
        echo "$num is divide by 4.";
    }else{
        echo "$num is not divide by 2,3 and 4.";
    }
?>
