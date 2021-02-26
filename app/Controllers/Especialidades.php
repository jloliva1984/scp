<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;

class Especialidades extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function Especialidades_management()
	{
        
	    $crud = new GroceryCrud();

        $crud->setTable('especialidades');
        $crud->setSubject('Especialidades');
        

	    $output = $crud->render();

		return $this->_exampleOutput($output);
	}



    private function _exampleOutput($output = null) {
        return view('especialidades_view', (array)$output);
    }
}
