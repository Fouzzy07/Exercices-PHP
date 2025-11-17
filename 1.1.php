<?php

function school($age) {
    if ($age < 3) {
        return "crèche";
    } elseif ($age < 6) {
        return "maternelle";
    } elseif ($age < 11) {
        return "primaire";
    } elseif ($age < 16) {
        return "collège";
    } elseif ($age < 18) {
        return "lycée";
    } else {
        return "université ou autre";
    }
}
echo "2 ans:" . school(2) . "\n";
echo "5 ans:" . school(5) . "\n";
echo "10 ans:" . school(10) . "\n";
echo "14 ans:" . school(14) . "\n";
echo "17 ans:" . school(17) . "\n";
echo "20 ans:" . school(20) . "\n\n";