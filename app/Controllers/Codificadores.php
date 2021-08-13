<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;

class Codificadores extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function actions_management()
	{
        
	    $crud = new GroceryCrud();
        $crud->setTable('actions');
		$crud->setSubject('Acciones del sistema');
		$crud->setClone('Acciones del sistema');
		  
        

		$output = $crud->render();
		$data['title']='Acciones del sistema';
		 
		 $output->data = $data;

		return $this->_exampleOutput($output);
	}

	public function user_rol_show()
  {
	   
	
	  $crud = new GroceryCrud();

		$crud->setTable('roles')
		->setSubject('Roles');
		//->columns(['rol','actions','url'])
		//->displayAs('description','Descripción')
		//->displayAs('actions','Acciones')
		//->displayAs('rol','Rol');
		 
		 $crud->setRelationNtoN('actions','actions_roles','actions','id_rol','id_action','url');

		 $output = $crud->render();
		 $data['title']='Acciones por roles';
		 
		 $output->data = $data;

		 return $this->_exampleOutput($output);
			
	
  }



    private function _exampleOutput($output = null) {
        return view('especialistas_view', (array)$output);
    }
}
