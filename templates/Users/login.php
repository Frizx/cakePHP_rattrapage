<?= $this->Form->create() ?>
<?= $this->Form->control('email', ['label' => 'Email']) ?>
<?= $this->Form->control('password', ['type' => 'password', 'label' => 'Mot de passe']) ?>
<?= $this->Form->button('Se connecter') ?>
<?= $this->Form->end() ?>
