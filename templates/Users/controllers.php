<?php
/**
 * @var \Cake\View\View $this
 */
use Cake\Routing\Router;

// Chemin vers les vues du dossier "Users"
$viewPath = ROOT . DS . 'templates' . DS . 'Users' . DS;

$views = [];

// Lister les fichiers .php dans le dossier Users
foreach (glob($viewPath . '*.php') as $file) {
    $viewName = basename($file, '.php');
    $views[] = $viewName;
}
?>

<h2>Liste des Vues Disponibles</h2>

<!-- Champ de recherche -->
<input type="text" id="search" placeholder="Rechercher une vue..." onkeyup="filterTable()">

<!-- Tableau des vues -->
<table border="1" id="viewsTable">
    <thead>
        <tr>
            <th>Nom de la Vue</th>
            <th>Lien</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($views as $view) : ?>
            <tr>
                <td><?= h($view) ?></td>
                <td><a href="<?= Router::url(['controller' => 'Users', 'action' => $view]) ?>">Accéder</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Script pour filtrer les résultats -->
<script>
function filterTable() {
    let input = document.getElementById("search").value.toLowerCase();
    let table = document.getElementById("viewsTable");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        let cell = rows[i].getElementsByTagName("td")[0];
        if (cell) {
            let text = cell.textContent || cell.innerText;
            rows[i].style.display = text.toLowerCase().includes(input) ? "" : "none";
        }
    }
}
</script>
