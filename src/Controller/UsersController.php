<?php



declare(strict_types=1);


namespace App\Controller;


use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Http\Exception\NotFoundException;



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
        return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
    }

    public function profile()
    {
        $result = $this->Authentication->getResult();
        if (!$result->isValid()) {
            $this->Flash->error(__('Vous devez être connecté pour accéder à cette page.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }

        $user = $this->Authentication->getIdentity();
        $this->set(compact('user'));
    }

     /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    
  
    
     /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
