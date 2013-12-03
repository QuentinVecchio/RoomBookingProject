<?php 
class UsersController extends AppController{
	
	/**
	*	Connexion de l'utilisateur
	*	Redirige après connexion:
	*			1) Gestion des départements pour les administrateurs
	*			2) Liste des salles du département pour les manageurs
	*			3) Le profil pour les utilisateurs simples
	*/
	public function login(){
		$this->set('title_for_layout', 'Connexion');
		if(!empty($this->request->data)){
			if($this->Auth->login()){
				if($this->Auth->user('Role.name') == 'administrators'){
					$this->redirect(array('controller' => 'departments', 'action' => 'index', 'admin' => true));
				}else if($this->Auth->user('Role.name') == 'managers'){
					$this->redirect(array('controller' => 'departments', 'action' => 'index', 'manager' => true));
				}else{
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
			}
		}
	}

	/**
	*	Déconnexion de l'utilisateur
	*	Redirection vers la page de connexion
	*/
	public function logout(){
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}


	/**
	*	Visualisation du profil de l'utilisateur
	*/
	public function index(){		
		$this->set('title_for_layout', 'Votre profil');
		$user = $this->User->findById($this->Auth->user('id'));
		$this->set('user',$user);
	}


	/**
	*	Mise à jour des données personnels de l'utilisateur
	*/
	public function edit(){
		if(!empty($this->request->data)){
			$this->User->id = $this->Auth->user('id');
			$updated = $this->User->save($this->request->data);
			if($updated){
				$this->Session->setFlash('Mise à jour de vos données personnels', 'flash_message', array('type'=>'success'));
				$this->redirect(array('controller'=>'users', 'action' =>'index'));	
			}
		}else{
			$this->request->data = $this->User->findById($this->Auth->user('id'));
		}


		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Edition du profil:');
		}

		
	}

	/**
	*	Changement de mot de passes pour l'utilisateur
	*/
	public function password(){
		$this->User->id = AuthComponent::user('id');

		if (!empty($this->data)) {
			$this->User->set($this->request->data);
			if($this->User->validates(array('fieldList' => array('password', 'password2', 'passwordOld')))){
		       if ($this->User->saveField('password', current(current($this->User->data)))) {
		            $this->Session->setFlash('Mot de passe mis à jour');
		            $this->redirect(array('controller' => 'Users', 'action' => 'index'));

		        } else {
		            $this->Session->setFlash('Erreur lors de la mise à jour du mot de passe');
		        }
			}
	    }

		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Edition du profil:');
		}
	}

	/**
	*	Page de gestion des utilisateurs pour les administrateurs (affichages de la side_bar des options)
	*/
	public function admin_index() {
		$this->set('title_for_layout', 'Gestion des utilisateurs');
	}

	/**
	*	Page d'importation des utilisateurs a partir d'un fichier
	*/
	public function admin_add() {
		$this->set('title_for_layout', 'Importer');
		if(!empty($this->request->data)){

			try {
				App::import('Vendor', 'ImportUsers/ImportUtil');
				$ImportUtil = new ImportUtil();
				$newName = str_replace('.tmp', '.'.pathinfo ($this->request->data['User']['fichier']['name'],PATHINFO_EXTENSION),
												$this->request->data['User']['fichier']['tmp_name']);
				rename($this->request->data['User']['fichier']['tmp_name'], $newName);;

				$listDpt = $this->User->Department->find('list');

				$res = $ImportUtil->initUtil($newName, $listDpt);

				if($this->User->saveMany($res, array('deep' => true, 'validate' => false))){
					$this->Session->setFlash('L\'importation a réussie', 'flash_message', array('type'=>'success'));
				}else{
					$this->Session->setFlash('L\'importation a échouée', 'flash_message', array('type'=>'alert'));

				}
				$this->set('list', $res);
				unlink($newName);
			} catch (Exception $e) {
				$this->Session->setFlash('Erreur interne, veuillez retenter votre chance !</br>'.$e->getMessage(), 'flash_message', array('type'=>'alert'));
			}
		}
	}

	/**
	*	Edition d'un utilisateur par l'administrateur
	*/
	public function admin_edit($id) {
		if($this->request->is('Ajax')){
			$this->layout = null;
			$user = $this->User->findById($id);
			$this->set('user', $user);
			$this->set('list', $this->User->Department->find('list'));
			$this->set('listRole', $this->User->Role->find('list'));
		}
		if(!empty($this->request->data)){
				$this->User->id = $id;
				$this->User->updateAll(current($this->request->data), array('User.id' => $id));
				$this->Session->setFlash('Mise à jour effectuée', 'flash_message', array('type'=>'success'));
				$this->redirect(array('controller'=>'users', 'action' =>'view'));					
		}
	}

	/**
	*	Visualisation de l'ensemble des utilisateurs par l'administrateur
	*/
	public function admin_view(){	
		$this->set('title_for_layout', 'Liste des utilisateurs');
		$listUtil = $this->User->find('all', array('order' => 'User.firstname'));
		$this->set('listUtil',$listUtil);
	}

	/**
	*	Suppression d'un utilisateur particulier
	*/
	public function admin_delete($id){
		$this->User->delete($id);
		$this->Session->setFlash('Supression effectuée', 'flash_message', array('type'=>'secondary'));
		$this->redirect(array('controller'=>'users', 'action' =>'view'));			
	}

	/**
	*	Ajouter un utilisateur via le formulaire (si ajout ponctuel)
	*/
	public function admin_addUser(){
		$this->set('title_for_layout', 'Ajouter un utilisateur');
		if(!empty($this->request->data)){
			$this->User->create();
			$this->User->save($this->request->data);
			$this->Session->setFlash('Ajout de l\'utilisateur effectué', 'flash_message', array('type'=>'success'));
			$this->redirect(array('controller'=>'users', 'action' =>'view'));			
		}
		$this->set('list', $this->User->Department->find('list'));
		$this->set('listRole', $this->User->Role->find('list'));
	}
} ?>