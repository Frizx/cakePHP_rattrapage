
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../webroot/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= $this->Url->build('/users/login') ?>" class="login-btn">Se connecter</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>Bienvenue sur mon site CakePHP</h1>
            <p>Veuillez vous connecter pour accéder à votre espace.</p>
            <a href="<?= $this->Url->build('/users/login') ?>" class="btn-login">Se connecter</a>
        </div>
    </main>

   

</body>
</html>
