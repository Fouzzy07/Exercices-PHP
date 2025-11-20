<?php
session_start();

$users_db = [
    'walid' => 'walid1902',
    'mathieu' => 'louvel',
    'BTC28.1' => 'ippsi'
];

$errors = [];
$success = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['register_username'] ?? '');
    $password = trim($_POST['register_password'] ?? '');
    
    if (empty($username)) {
        $errors[] = "Le champ username de l'inscription est vide";
    }
    if (empty($password)) {
        $errors[] = "Le champ password de l'inscription est vide";
    }
    
    if (!empty($username) && isset($users_db[$username])) {
        $errors[] = "Le username existe déjà dans la base de données";
    }
    
    if (empty($errors)) {
        $users_db[$username] = $password;
        $success = "Compte créé";
    }
}

if (isset($_POST['login'])) {
    $username = trim($_POST['login_username'] ?? '');
    $password = trim($_POST['login_password'] ?? '');
    
    if (empty($username)) {
        $errors[] = "Le champ username de la connexion est vide";
    }
    if (empty($password)) {
        $errors[] = "Le champ password de la connexion est vide";
    }
    
    if (!empty($username) && !empty($password)) {
        if (!isset($users_db[$username])) {
            $errors[] = "Le username n'existe pas dans la base de données";
        } elseif ($users_db[$username] !== $password) {
            $errors[] = "Le mot de passe est invalide";
        } else {
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #000;
            color: #fff;
            padding: 50px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #1a1a1a;
            padding: 30px;
            border: 1px solid #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: normal;
        }
        .welcome {
            text-align: center;
            padding: 30px;
        }
        .welcome h2 {
            margin-bottom: 20px;
        }
        .logout-btn {
            background: #fff;
            color: #000;
            padding: 10px 30px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        .logout-btn:hover {
            background: #ddd;
        }
        .forms {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .form-box {
            border: 1px solid #333;
            padding: 20px;
        }
        .form-box h2 {
            margin-bottom: 20px;
            font-weight: normal;
            font-size: 18px;
        }
        .field {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 10px;
            background: #000;
            border: 1px solid #333;
            color: #fff;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: #666;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #fff;
            color: #000;
            border: none;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px;
        }
        button:hover {
            background: #ddd;
        }
        .errors {
            background: #2a1a1a;
            border: 1px solid #500;
            padding: 15px;
            margin-bottom: 20px;
        }
        .errors strong {
            color: #f55;
        }
        .errors ul {
            margin: 10px 0 0 20px;
            color: #faa;
        }
        .success {
            background: #1a2a1a;
            border: 1px solid #050;
            padding: 15px;
            margin-bottom: 20px;
            color: #afa;
        }
        .hint {
            margin-top: 15px;
            padding: 10px;
            background: #222;
            border: 1px solid #333;
            font-size: 12px;
        }
        @media (max-width: 768px) {
            .forms {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <div class="welcome">
                <h2>Connecté en tant que : <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                <p>Session active</p>
                <br>
                <a href="?logout" class="logout-btn">Déconnexion</a>
            </div>
        <?php else: ?>
            <h1>Formulaire de login</h1>
            
            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <strong>Erreurs :</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            
            <div class="forms">
                <div class="form-box">
                    <h2>Inscription</h2>
                    <form method="POST">
                        <div class="field">
                            <label>Username</label>
                            <input type="text" name="register_username" 
                                   value="<?php echo htmlspecialchars($_POST['register_username'] ?? ''); ?>">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="register_password">
                        </div>
                        <button type="submit" name="register">S'inscrire</button>
                    </form>
                </div>
                
                <div class="form-box">
                    <h2>Connexion</h2>
                    <form method="POST">
                        <div class="field">
                            <label>Username</label>
                            <input type="text" name="login_username"
                                   value="<?php echo htmlspecialchars($_POST['login_username'] ?? ''); ?>">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="login_password">
                        </div>
                        <button type="submit" name="login">Connexion</button>
                    </form>
                    
                    <div class="hint">
                        Comptes de test :<br>
                        walid / walid1902<br>
                        mathieu / louvel <br>
                        BTC28.1 / ippsi<br>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>