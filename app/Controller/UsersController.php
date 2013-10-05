<?php 
class UsersController extends AppController{
	

	public function login(){
		if(!empty($this->request->data)){
			if($this->Auth->login()){

			}
		}
	}

	public function logout(){
		$this->Auth->logout();
	}
} ?>