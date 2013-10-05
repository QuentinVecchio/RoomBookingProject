<?php 
class Loan extends AppModel{

	public $belongsTo = array('Department', 'Room', 'Status');
}
 ?>