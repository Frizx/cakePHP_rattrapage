<h1>Ajouter un utilisateur</h1>
<?= $this->Form->create($user) ?>
<?= $this->Form->control('username', ['label' => 'Nom d\'utilisateur']) ?>
<?= $this->Form->control('nom', ['label' => 'Nom']) ?>
<?= $this->Form->control('prenom', ['label' => 'Prénom']) ?>
<?= $this->Form->control('email', ['label' => 'Email']) ?>
<?= $this->Form->control('password', ['label' => 'Mot de passe']) ?>
<?= $this->Form->control('type', ['label' => 'Type']) ?>
<?= $this->Form->button('Enregistrer') ?>
<?= $this->Form->end() ?>
