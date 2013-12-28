<?php 
class FormationsController extends AppController{
	public function admin_index(){
		$listDept = $this->Formation->Department->find('all', array('recursive' => -1));
		$this->set('listDept', $listDept);
	}

	public function admin_edit($id){
		$listDept = $this->Formation->Department->find('all', array('recursive' => -1));
		$this->set('listDept', $listDept);

		$listFormations = $this->Formation->find('all', array('conditions' => array('Formation.department_id' => $id),
															'recursive' => -1));

		$this->set('listFormations', $listFormations);
		$this->set('department_id', $id);
	}

	public function admin_delete($id){
		$this->autoRender = false;
		echo $this->Formation->delete($id);
	}

	public function admin_add($id, $name){
		$this->autoRender = false;
		$tmp = array('Formation' => array('name' => $name, 'department_id' => $id));
		if($this->Formation->save($tmp)){
			echo json_encode(current($this->Formation->find('all', array('conditions' => array('id' => $this->Formation->id), 'recursive' => -1))));
		}else{
			echo 0;
		}
	}

	public function admin_update($id, $name, $department_id){
		$this->autoRender = false;
		$this->Formation->id = $id;
		$tmp = array('Formation' => array('name' => $name, 'department_id' => $department_id));
		if($this->Formation->save($tmp)){
			echo json_encode(current($this->Formation->find('all', array('conditions' => array('id' => $this->Formation->id), 'recursive' => -1))));
		}else{
			echo 0;
		}
	}


}
 ?>