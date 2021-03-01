<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;

class Usuarios extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function Usuarios_management()
	{
        
	    $crud = new GroceryCrud();

        $crud->setTable('usuarios');
        $crud->setSubject('usuarios');
        
		$crud->columns(['user','password']);
		$crud->displayAs('user','Usuario');
	    $output = $crud->render();

		return $this->_exampleOutput($output);
	}



    private function _exampleOutput($output = null) {
        return view('usuarios_view', (array)$output);
    }
}
