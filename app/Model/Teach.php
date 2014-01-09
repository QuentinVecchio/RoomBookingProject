<?php 
class Teach extends AppModel{
	
	public $belongsTo = array('Formation', 'User');
		public $actsAs = array('Containable');
}

 ?>