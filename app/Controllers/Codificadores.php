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
		  
        

	    $output = $crud->render();

		return $this->_exampleOutput($output);
	}

	public function user_rol_show()
  {
	   
	 //if($this->validation()!=0 )
	 if(1==1 )
	 {
	  // $this->validate_access();
		 
	  $crud = new GroceryCrud();

		$crud->setTable('roles')
		->setSubject('Roles');
		//->columns(['rol','actions','url'])
		//->displayAs('description','Descripción')
		//->displayAs('actions','Acciones')
		//->displayAs('rol','Rol');
		 
		 $crud->setRelationNtoN('actions','actions_roles','actions','id_rol','id_action','url');

		 $output = $crud->render();

		 return $this->_exampleOutput($output);
			
	 }
	  else
	  {
	    $this->load->view('login/bootstrap/login.php');
	  }
  }



    private function _exampleOutput($output = null) {
        return view('especialistas_view', (array)$output);
    }
}
