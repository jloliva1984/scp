<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;


class SubElementosGastos extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function subelementosgastos_management()
	{
       
	    $crud = new GroceryCrud();

        $crud->setTable('subelemento_gastos');
        $crud->setSubject('Subelementos de Gasto');
        

	    $output = $crud->render();

		return $this->_exampleOutput($output);
	}



    private function _exampleOutput($output = null) {
        return view('subelementos_gastos_view', (array)$output);
    }
}
