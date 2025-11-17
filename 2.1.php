<?php

function calcmoy($nombres) {
    if (empty($nombres)) {
        return 0;
    }
    
    $somme = 0;
    $count = 0;
    
    foreach ($nombres as $nombre) {
        $somme += $nombre;
        $count++;
    }
    
    return $somme / $count;
}

echo "test calcul moyenne\n";
$nombres1 = [12, 25, 31, 48, 56];
echo "Moyenne de [12, 25, 31, 48, 56] : " . calcMoy($nombres1) . "\n";

$nombres2 = [3, 14, 28];
echo "Moyenne de [3, 14, 28] : " . calcMoy($nombres2) . "\n\n";
?>