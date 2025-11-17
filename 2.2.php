<?php

function my_strrev($chaine) {
    $resultat = '';
    $longueur = strlen($chaine);
    
    for ($i = $longueur - 1; $i >= 0; $i--) {
        $resultat .= $chaine[$i];
    }
    
    return $resultat;
}

echo "test my_strrev\n";
$texte1 = "Bonjour";
echo "inverse de '$texte1' : " . my_strrev($texte1) . "\n";

$texte2 = "PHP";
echo "inverse de '$texte2' : " . my_strrev($texte2) . "\n\n";
?>