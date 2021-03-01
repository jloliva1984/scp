<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;

class Cuentas extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function Cuentas_management()
	{
        
	    $crud = new GroceryCrud();

        $crud->setTable('cuentas');
        $crud->setSubject('Cuentas');
        $crud->columns(['codigo','descripcion','valor']);

	    $output = $crud->render();

		return $this->_exampleOutput($output);
	}



    private function _exampleOutput($output = null) {
        return view('cuentas_view', (array)$output);
    }
}
