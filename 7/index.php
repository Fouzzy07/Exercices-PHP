<?php
session_start();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
}

if (isset($_SESSION['username'])) {
    echo "<h1>Bonjour " . $_SESSION['username'] . "</h1>";
    echo '<a href="logout.php">Se déconnecter</a>';
} else {
    ?>
    <h1>login</h1>
    <form method="post" action="">
        <label for="username">username: </label>
        <input type="text" name="username" id="username">
        <input type="submit" value="Valider">
    </form>
    <?php
}
?>