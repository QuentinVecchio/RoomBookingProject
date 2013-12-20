<?php 
class Loan extends AppModel{

	public $belongsTo = array('Department', 'Room', 'Status');



	public $validate = array(
		'department_id' => array(
			'rule' =>'alphaNumeric',
			'required' => true
		),
		'start_time' => array(
			'rule' =>'/^(0[7-9]|1[0-9]):([03]0|[14]5)$/',
			'required' => true,
		),
		'end_time' => array(
			'rule' =>'/^(0[7-9]|1[0-9]):([03]0|[14]5)$/',
			'required' => true
		),
		'date' => array(
			'rule' =>'/^((0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(20[0-9][0-9]))$/',
			'required' => true
		));


	public function beforeSave($options = array()) {

	    if (!empty($this->data['Loan']['date'])){
	        $this->data['Loan']['date'] = $this->dateFormatBeforeSave($this->data['Loan']['date']);
	        $this->data['Loan']['start_time'] = $this->data['Loan']['start_time'].':00';
	        $this->data['Loan']['end_time'] = $this->data['Loan']['end_time'].':00';

	    }
	    return true;
	}

	public function dateFormatBeforeSave($dateString) {
	   return date('Y-m-d', strtotime($dateString));
	}
}
 ?>