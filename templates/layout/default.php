<?php
$this->loadHelper('Authentication.Identity');
use Cake\Routing\Router;

$cakeDescription = 'CakePHP: the rapid development php framework';

// Menu dynamique
$menuItems = [
    ['title' => 'Accueil', 'link' => Router::url(['controller' => 'Pages', 'action' => 'display', 'home']), 'order' => 1]
];

if ($this->Identity->isLoggedIn()) {
    $menuItems[] = ['title' => 'Utilisateurs', 'link' => Router::url(['controller' => 'Users', 'action' => 'index']), 'order' => 2];
    $menuItems[] = [
        'title' => 'Vues',
        'link' => Router::url(['controller' => 'Users', 'action' => 'controllers']),
        'order' => 3
    ];
}

usort($menuItems, fn($a, $b) => $a['order'] <=> $b['order']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'custom']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #495057;
            border-radius: 5px;
        }
        .content-wrapper {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            transition: margin-left 0.3s ease-in-out;
       
        }
        .top-nav {
            background: white;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .toggle-menu {
            display: none;
            background: #343a40;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .menu {
    list-style: none;
    padding: 0;
}

.menu li {
    padding-left: 10px;
    position: relative;
}

.menu li::before {
    content: "•";
    color: white;
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
}

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .toggle-menu {
                display: block;
            }

            
        }
    </style>
</head>
<body>
    <button class="toggle-menu" onclick="toggleSidebar()">☰</button>
    <nav class="sidebar">
        <div class="sidebar-title">
            <a href="<?= $this->Url->build('/') ?>">
            <img src="<?= $this->Url->image('logo.jpg') ?>" alt="Logo" style="width: 100%; max-width: 150px;">

            </a>
        </div>
        <ul class="menu">
            <?php foreach ($menuItems as $item): ?>
                <li><a href="<?= $item['link'] ?>"> <?= $item['title'] ?> </a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="content-wrapper">
        <nav class="top-nav">
            <div class="top-nav-title">
                <a href="<?= $this->Url->build('/') ?>" style="color: #343a40; font-size: 24px; font-weight: bold;">
                    <span style="color: #dc3545;">Cake</span>PHP
                </a>
            </div>
            <div class="top-nav-links">
                <?php if ($this->Identity->isLoggedIn()): ?>
                    <a href="<?= Router::url(['controller' => 'Users', 'action' => 'logout']) ?>" class="btn-danger">Déconnexion</a>
                <?php endif; ?>
            </div>
        </nav>
        <main class="main">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>
    <br>
    <br>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>
