<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;

class Especialistas extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function Especialistas_management()
	{
        
	    $crud = new GroceryCrud();

        $crud->setRelation('id_especialidad','especialidades','nombre');
        $crud->displayAs('id_especialidad','Especialidad');
        $crud->setTable('especialistas');
        $crud->setSubject('Especialista');
        
        

	    $output = $crud->render();

		return $this->_exampleOutput($output);
	}



    private function _exampleOutput($output = null) {
        return view('especialistas_view', (array)$output);
    }
}
