<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\ProyectosModel;

class Planificacion extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function proyectos_management()
	{
        $imgDescarga=base_url().'/assets/images/descarga.png';
	    $crud = new GroceryCrud();
        $crud->setTable('proyectos');
        $crud->setSubject('Proyectos');
        $crud->setTexteditor(['descripcion']);
        $crud->fieldType('estado', 'hidden',1);
        
       
        $crud->setRead();
		//$crud->unsetAdd();
		$crud->unsetRead();
		$crud->unsetDelete();
		$crud->unsetEdit();

		$crud->where('estado',1);//solo los proyectos en ejecucion



        
        
        
        $crud->columns(['codigo','descripcion','valor','Plan']);

        $crud->callbackColumn('Plan', array($this, '_plan'));
        

	    $output = $crud->render();
        return $this->_exampleOutput($output);
    }

	public function _plan($value, $row)
    {
        $id_proyecto=$row->id_proyecto;
         $icono = base_url() . '/assets/images/descarga.png';
         
          return
          '
           <a href="' . base_url() . '/Planificacion/plan_show/' . $id_proyecto . '" style="align-content: center">
           <i class="fas fa-file-invoice-dollar fa-2x"></i>
           </a>--
           <a href="' . base_url() . '/Planificacion/plan_especialistas_show/' . $id_proyecto . '" style="align-content: center">
           <i class="fas fa-users fa-2x"></i>
           </a>
           ' ;
    }

	public function plan_show($id_proyecto)
	{
		$proyectos=new ProyectosModel();
		$proyectos=$proyectos->find($id_proyecto);
		
		$crud = new GroceryCrud();
        $crud->setTable('plan_proyectos_subelemento_gastos');
        
		$crud->setSubject('Planificación - <strong>Proyecto :</strong> $'.$proyectos['codigo'].' - '.$proyectos['descripcion']);
                
        $crud->setRelation('id_subelemento_gasto','subelemento_gastos','nombre');
        		
		$crud->displayAs('id_subelemento_gasto','Subelemento Gasto');

        $crud->columns(['id_subelemento_gasto','plan_valor']);

	   $crud->fieldType('id_proyecto', 'hidden',$id_proyecto);
 

		$crud->where('id_proyecto',$id_proyecto);//solo los proyectos en ejecucion
        //$crud->where('nombre!=','Salario');//solo los proyectos en ejecucion
        
          
        
       

       // $crud->callbackColumn('Plan', array($this, '_plan'));
        

	    $output = $crud->render();
        return $this->_exampleOutput($output);	
    }
    
    public function plan_especialistas_show($id_proyecto)
	{
		$proyectos=new ProyectosModel();
		$proyectos=$proyectos->find($id_proyecto);
		
		$crud = new GroceryCrud();
        $crud->setTable('plan_proyectos_especialistas');
        
		$crud->setSubject('Planificación || Especialistas - <strong>Proyecto :</strong> $'.$proyectos['codigo'].' - '.$proyectos['descripcion']);
                
        $crud->setRelation('id_especialista','especialistas','{nombre_completo}-{salario_diario}');
        		
		$crud->displayAs('id_especialista','Especialista');

        $crud->columns(['id_especialista','hombre_dia','fecha_inicio','fecha_fin']);

	   $crud->fieldType('id_proyecto', 'hidden',$id_proyecto);
 

		$crud->where('id_proyecto',$id_proyecto);//solo los proyectos en ejecucion
        //$crud->where('nombre!=','Salario');//solo los proyectos en ejecucion
        
          
        
       

       // $crud->callbackColumn('Plan', array($this, '_plan'));
        

	    $output = $crud->render();
        return $this->_exampleOutput($output);	
	}



    private function _exampleOutput($output = null) {
        return view('proyectos_view', (array)$output);
    }
}
