  <?php

function my_str_contains($haystack, $needle) {
    if (strlen($needle) === 0) {
        return true;
    }
    
    $haystackLen = strlen($haystack);
    $needleLen = strlen($needle);
    
    if ($needleLen > $haystackLen) {
        return false;
    }
    
    for ($i = 0; $i <= $haystackLen - $needleLen; $i++) {
        $found = true;
        
        for ($j = 0; $j < $needleLen; $j++) {
            if ($haystack[$i + $j] !== $needle[$j]) {
                $found = false;
                break;
            }
        }
        
        if ($found) {
            return true;
        }
    }
    
    return false;
}

echo "test my_str_contains\n";
$phrase = "je suis etudiant a l'ippsi";
$recherche1 = "etudiant";
echo "Est-ce que '$phrase' contient '$recherche1' ? " . (my_str_contains($phrase, $recherche1) ? "oui" : "non") . "\n";

$recherche2 = "PHP";
echo "Est-ce que '$phrase' contient '$recherche2' ? " . (my_str_contains($phrase, $recherche2) ? "oui" : "non") . "\n";

$recherche3 = "je";
echo "Est-ce que '$phrase' contient '$recherche3' ? " . (my_str_contains($phrase, $recherche3) ? "oui" : "non") . "\n";

?>