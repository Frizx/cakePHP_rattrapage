<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddUsersTable extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
{
    $table = $this->table('users');
    $table->addColumn('nom', 'string', ['limit' => 50])
          ->addColumn('prenom', 'string', ['limit' => 50])
          ->addColumn('email', 'string', ['limit' => 100])
          ->addColumn('password', 'string')
          ->addColumn('type', 'integer', ['default' => 1]) // 0 = admin, 1 = utilisateur simple
          ->addColumn('created', 'datetime')
          ->addColumn('modified', 'datetime')
          ->create();
}

}
