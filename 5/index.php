<?php
$connexion = new PDO('mysql:host=localhost;dbname=jo;charset=utf8', 'root', '');
 
$colonnes = ['nom','pays','course','temps'];
$colonneTri = in_array($_GET['sort'] ?? '', $colonnes) ? $_GET['sort'] : 'nom';
$ordreTri = (strtolower($_GET['order'] ?? '') === 'desc') ? 'DESC' : 'ASC';
 
$resultats = $connexion->query("SELECT * FROM `100` ORDER BY $colonneTri $ordreTri")->fetchAll();
 
function fleche($col,$colTri,$ordre) {
    return $col === $colTri ? ($ordre==='ASC' ? ' ↑' : ' ↓') : '';
}
 
function lienTri($col,$colTri,$ordre) {
    $nouvelOrdre = ($col === $colTri && $ordre==='ASC') ? 'desc' : 'asc';
    return "<a href='?sort=$col&order=$nouvelOrdre'>$col" . fleche($col,$colTri,$ordre) . "</a>";
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><h1>ajouter un résultat : </h1>
<form method="post">
<label>nom : </label>
<input type="text" name= "nom"></br>
 
<label>pays : </label>
<input type="text" name= "pays"></br>
 
<label>course : </label>
<input type="text" name= "course"></br>
 
<label>temps : </label>
<input type="float" name= "temps"></br>
 
<button>submit</button>
 
</form>
   
</body>
</html>
 
<?php
 
function ajouter($liste){
 
    if (!isset($liste['nom'], $liste['pays'], $liste['course'], $liste['temps'])) {
        return;
    }
 
    $newguy = [
        "nom"    => $liste["nom"],
        "pays"   => $liste["pays"],
        "course" => $liste["course"],
        "temps"  => $liste["temps"]
    ];
 
    array_push($newguy);
}
 
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ajouter($_POST);
}
 
?>
 
 
<table border="10">
    <tr>
        <th><?= lienTri('nom',$colonneTri,$ordreTri) ?></th>
        <th><?= lienTri('pays',$colonneTri,$ordreTri) ?></th>
        <th><?= lienTri('course',$colonneTri,$ordreTri) ?></th>
        <th><?= lienTri('temps',$colonneTri,$ordreTri) ?></th>
    </tr>
    <?php foreach($resultats as $ligne): ?>
    <tr>
        <td><?= $ligne['nom'] ?></td>
        <td><?= $ligne['pays'] ?></td>
        <td><?= $ligne['course'] ?></td>
        <td><?= $ligne['temps'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>