<?php
declare(strict_types=1);

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize(): void
{
    parent::initialize();
    $this->loadComponent('Authentication.Authentication');
}


public function login()
{
    // Vérifier si l'utilisateur est déjà connecté
    if ($this->Authentication->getIdentity()) {
        // Rediriger l'utilisateur vers la page d'accueil ou autre page
        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
    }

    $this->set('title', 'Se connecter');

    // Si la requête est POST (l'utilisateur soumet le formulaire de connexion)
    if ($this->request->is('post')) {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            // Rediriger l'utilisateur vers la page des utilisateurs après connexion réussie
            return $this->redirect($this->Authentication->getLoginRedirect() ?: ['controller' => 'Users', 'action' => 'index']);
        }

        // Si la connexion échoue
        $this->Flash->error('Nom d\'utilisateur ou mot de passe incorrect.');
    }
}

    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('Vous avez été déconnecté.'));
        }
        return $this->redirect(['action' => 'login']);
    }

    public function profile()
    {
        $result = $this->Authentication->getResult();
        if (!$result->isValid()) {
            $this->Flash->error(__('Vous devez être connecté pour accéder à cette page.'));
            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Authentication->getIdentity();
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('L\'utilisateur a été ajouté avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter l\'utilisateur. Veuillez réessayer.'));
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Les informations de l\'utilisateur ont été mises à jour.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour l\'utilisateur. Veuillez réessayer.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('L\'utilisateur a été supprimé avec succès.'));
        } else {
            $this->Flash->error(__('Impossible de supprimer l\'utilisateur. Veuillez réessayer.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Permettre l'accès sans authentification à login et logout
    $this->Authentication->addUnauthenticatedActions(['login', 'logout']);
}
}
