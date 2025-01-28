<h1>Connexion</h1>

<?= $this->Form->create(null) ?>
    <?= $this->Form->control('username', ['label' => 'Nom d’utilisateur']) ?>
    <?= $this->Form->control('password', ['label' => 'Mot de passe']) ?>
    <?= $this->Form->button('Se connecter') ?>
<?= $this->Form->end() ?>

<p>Pas encore inscrit ? <a href="#">Créer un compte</a></p>
