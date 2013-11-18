<?php 
class UsersController extends AppController{
	
	public function index(){		
		$this->set('title_for_layout', 'Votre profil');
		$user = $this->User->findById($this->Auth->user('id'));
		$this->set('user',$user);
	}


	public function edit(){
		if(!empty($this->request->data)){
			$this->User->id = $this->Auth->user('id');
			$updated = $this->User->save($this->request->data);
			if($updated){
				$this->Session->setFlash('Mise à jour de vos données personnels', 'flash_message', array('type'=>'success'));
				$this->redirect(array('controller'=>'users', 'action' =>'index'));	
			}
		}


		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Edition du profils:');
		}

		$this->request->data = $this->User->findById($this->Auth->user('id'));
	}

	public function password(){
		$this->User->id = AuthComponent::user('id');

		if (!empty($this->data)) {
	        if ($this->User->save($this->data, false)) {
	            $this->Session->setFlash('Password has been changed.');
	            $this->redirect(array('controller' => 'Users', 'action' => 'index'));
	        } else {
	            $this->Session->setFlash('Password could not be changed.');
	        }
	    }


		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Edition du profils:');
		}
	}

	public function admin_index() {
		$this->set('title_for_layout', 'Gestion des utilisateurs');
	}

	public function admin_add() {
		$this->set('title_for_layout', 'Importer');
		if(!empty($this->request->data)){

			App::import('Vendor', 'ImportUtil');
			$ImportUtil = new ImportUtil();
			$newName = str_replace('.tmp', '.xlsx', $this->request->data['User']['fichier']['tmp_name']);
			rename($this->request->data['User']['fichier']['tmp_name'], $newName);;

			$listDpt = $this->User->Department->find('list');

			$res = $ImportUtil->initUtil($newName, $listDpt);

			$this->set('list', $res);
			unlink($newName);
		}
	}

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

	public function admin_view(){	
		$this->set('title_for_layout', 'Liste des utilisateurs');
		$listUtil = $this->User->find('all', array('order' => 'User.firstname'));
		$this->set('listUtil',$listUtil);
	}

	public function admin_delete($id){
		$this->User->delete($id);
		$this->Session->setFlash('Supression effectuée', 'flash_message', array('type'=>'secondary'));
		$this->redirect(array('controller'=>'users', 'action' =>'view'));			
	}

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


	public function login(){
		$this->set('title_for_layout', 'Connexion');
		if(!empty($this->request->data)){
			if($this->Auth->login()){
				if($this->Auth->user('Role.name') == 'administrators'){
					$this->redirect(array('controller' => 'departments', 'action' => 'index', 'admin' => true));
				}else if($this->Auth->user('Role.name') == 'managers'){
					$this->redirect(array('controller' => 'departments', 'action' => 'index', 'manager' => true));
				}else{
					$this->redirect('/');
				}
			}
		}
	}

	public function logout(){
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}
} ?>