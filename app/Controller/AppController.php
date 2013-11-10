<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'authorize' => array('Controller'))
		);

	public function isAuthorized($user = null){
		return true;
	}


	public function beforeRender()
	{

	    // only compile it on development mode
	    if (Configure::read('debug') > 0)
	    {
	        // import the file to application
	        App::import('Vendor', 'lessc');
	 
	 		$less_repertory = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'less';
	 		$css_repertory = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'css';
	        if(file_exists($less_repertory) && is_dir($less_repertory)){
	        	$dir = opendir($less_repertory);

	        	while($file = readdir($dir)){
	        		if(!is_dir($file)){
	        			if(strtolower(pathinfo($file, PATHINFO_EXTENSION)) ==="less"){
	        				$name = $less_repertory. DS. $file;
	        				$nameOut = $css_repertory. DS. pathinfo($file, PATHINFO_FILENAME). '.css';
	        				lessc::ccompile($name, $nameOut);
	        			}
	        		}
	        	}
	        }
	    }
	    parent::beforeRender();
	}
}
