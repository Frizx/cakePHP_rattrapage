<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;


/**
 * User Entity
 *
 * @property int $id
 * @property int $username
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $password
 * @property int $type
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'username' => true,
        'nom' => true,
        'prenom' => true,
        'email' => true,
        'password' => true,
        'type' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];

    /**
     * Mutateur pour le mot de passe : il est automatiquement haché avant d'être enregistré
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) { // Si un mot de passe a été fourni
            return (new DefaultPasswordHasher())->hash($password); // Hachage du mot de passe
        }
        return $password; // Si aucun mot de passe, ne rien faire
    }
}
