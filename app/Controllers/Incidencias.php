<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use CodeIgniter\HTTP\IncomingRequest;

class Incidencias extends BaseController

{
	public function incidencias_show($id_subsistema)
	{
        $request = service('request');
        
        $crud = new GroceryCrud();

        $crud->setTable('incidencias');
        $crud->setSubject('Incidencias');
        $crud->setRelation('id_subsistema','subsistemas','nombre');
        $crud->displayAs('id_subsistema','Subsistema');
        $crud->setRead();
       // $crud->callbackColumn('GESTION DE INCIDENCIAS', array($this, '_INCIDENCIAS'));
        //$crud->columns(['id_sistema', 'nombre','GESTION DE INCIDENCIAS']);
        

	    $output = $crud->render();

		return $this->_exampleOutput($output);
    }

	//--------------------------------------------------------------------
    private function _exampleOutput($output = null) {
        return view('incidencias_view', (array)$output);
    }
}