<?php 
class UsersController extends AppController{
	
	public function index(){		
		$user = $this->User->findById($this->Auth->user('id'));
		$this->set('user',$user);
	}


	public function edit(){
		if(!empty($this->request->data)){
			$this->User->id = $this->Auth->user('id');
			$updated = $this->User->save($this->request->data);
			if($updated){
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
		if(!empty($this->request->data)){
			debug($this->request->data);
			die();
			$this->User->id = $this->Auth->user('id');
			$this->User->save($this->request->data);
		}


		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Edition du profils:');
		}
	}


	public function login(){
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