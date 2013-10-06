<?php 
class UsersController extends AppController{
	

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