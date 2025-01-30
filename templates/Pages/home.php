<?php
$this->loadHelper('Authentication.Identity');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../webroot/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
        
            height: 100vh;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
        }
        p {
            color: #6c757d;
        }
        .btn-login {
            display: inline-block;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

    <main>
        <div class="container">
            <h1>Bienvenue sur mon site CakePHP</h1>
           
            
            <?php if (!$this->Identity->isLoggedIn()): ?>
                <p>Veuillez vous connecter pour accéder à votre espace.</p>
                <a href="<?= $this->Url->build('/users/login') ?>" class="btn-login">Se connecter</a>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>
