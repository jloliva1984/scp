<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\ProyectosModel;
use App\Models\SubelementoGastosModel;
use App\Models\EspecialistasModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class Proyectos extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function proyectos_management()
	{
        $imgDescarga=base_url().'/assets/images/descarga.png';
	    $crud = new GroceryCrud();
        //$crud->setSkin('bootstrap-v4');
        $crud->setTable('proyectos');
        $crud->setSubject('Proyectos');
        $crud->setTexteditor(['descripcion']);
       
        $crud->setRead();
        //$crud->setActionButton('Descarga', "$imgDescarga", 'Proyectos/descarga');
        // $crud->setActionButton('Descarga', 'el el-file', function ($primaryKey) { 
        //     return site_url('Proyectos/descarga/' . $primaryKey); 
        // }, true);

        
        
        
        $crud->columns(['codigo','descripcion','valor','Prod./Proc.','fecha_fin','descarga']);

        $crud->callbackColumn('descarga', array($this, '_INCIDENCIAS'));
        $crud->callbackColumn('Prod./Proc.', array($this, '_produccionProceso'));

	    $output = $crud->render();

		return $this->_exampleOutput($output);
    }

    public function _INCIDENCIAS($value, $row)
    {
        $id_proyecto=$row->id_proyecto;
         $icono = base_url() . '/assets/images/descarga.png';
         
          return
          '
           <a href="' . base_url() . '/Proyectos/descarga_show/' . $id_proyecto . '" style="align-content: center">
           <i class="el el-file-edit el-2x"></i>
           </a>' ;
    }
    public function _produccionProceso($value, $row)
    { 
        $useKint = true;//para debug
        //sumar todos los elementos de gasto de un proyecto
         $id_proyecto=$row->id_proyecto;
         $subelementos = new SubelementoGastosModel();
         $produccionProceso=$subelementos->sumaSubelementosPorProyecto($id_proyecto);

         //$produccionProceso->valor;
        // $icono = base_url() . '/assets/images/descarga.png';
        // return '<a>'.$valor.'</a>';
        if($produccionProceso!=0)
        {
          return
          '<a href="' . base_url() . '/Proyectos/descarga_show/' . $produccionProceso[0]->id_proyecto . '" style="align-content: center">
          $'.$produccionProceso[0]->valor.'
           </a>' ;
        }
        else
        {
            return '0';
        }
    }

    public function descarga_show($id_proyecto)
    {   
        $useKint = true;//para debug
        $proyecto = new ProyectosModel();
        $subelementos = new SubelementoGastosModel();
        $especialistas = new EspecialistasModel();

        $datos= $subelementos->SubElementosGastosxProyecto($id_proyecto);

        $data = ['proyecto' => $proyecto->find($id_proyecto),'subelementos'=>$subelementos->findAll(),'especialistas'=>$especialistas->findAll(),
                 'datos'=>$datos];
        //dd($datos);
        echo view('descargas_view', $data);
    }

    public function delete_descarga($id_proyectos_subelemento_gastos)
    {  
     if ($this->request->isAJAX())
     {
        $proyecto = new ProyectosModel();
            // echo($id_proyectos_subelemento_gastos);die;
            $delete=$proyecto->delete_descarga($id_proyectos_subelemento_gastos);
            if($delete==1){echo 'ok';}else{echo 'error';}
     }     
    }

    public function insertar_descarga($id_proyecto)
    {  
        
         $request = service('request');//para poder usar $request->getPost
         $useKint = true;//para debug
         helper('text');
        if ($this->request->isAJAX())//funcion de codeigniter -servicio CodeIgniter\HTTP\RequestInterface;
        { 
           $subelemento=$request->getPost('subelementos');
           $especialista=$request->getPost('especialistas');
           $valor=$request->getPost('valor');
           $fecha=$request->getPost('fecha');
           if(isset($subelemento) && $subelemento!=NULL && isset($valor) && $valor!=NULL && isset($fecha) && $fecha!=NULL)
           {
            $validation =  \Config\Services::validation();
		    $validation->setRules(['subelementos' => 'required|integer|greater_than[0]','especialistas' => 'required|integer|greater_than[0]','valor' => 'required','fecha' => 'required']);   
            $html='';   
            for($count=0;$count<count($subelemento);$count++)
            {
                $proyecto = new ProyectosModel(); 
                $inserted_id=$proyecto->insert_descarga($id_proyecto,$subelemento[$count], $especialista[$count],$valor[$count],$fecha[$count]);

                if($inserted_id !=0)//buscando los datos de la descarga una vez insertada para mostrarla concatenando la variale html
				{
                 $subelementos = new SubelementoGastosModel();
                 $datos= $subelementos->SubElementosGastosxId($inserted_id);
                 //var_dump($datos);die;
                 $html.='<tr><td>'.$datos[0]->nombre.'</td><td>'.$datos[0]->nombre_completo.'</td><td class="mat-price">'.$datos[0]->valor.'</td><td>'.$datos[0]->fecha.'</td><td><button type="button" name="remove_descarga" class="btn btn-danger  btn-sm" value="'.$datos[0]->id_proyectos_subelemento_gastos.'" remove_descarga" id="'.$datos[0]->id_proyectos_subelemento_gastos.'" onclick="eliminar_descarga('.$datos[0]->id_proyectos_subelemento_gastos.')"><i class="fa fa-minus-circle"></i></td></tr>';
 
                 //echo($html)	;die;
				//busco el real total de los materiales de ese proyecto	
				
				//$total_real_materiales=$this->proyecto->get_total_materiales_real($project_id);
				//$total_real_materiales=$total_real_materiales[0]->total_materiales_real;
				//$html[1]=$total_real_materiales;	
				}
              
            }
           }
           $html=strip_slashes($html);
           //$html = quotes_to_entities($html); 
           $html = str_replace ('"\"',' ', $html);
           echo ($html)  ; 

        } 
    }
    
   
    private function _exampleOutput($output = null) {
        return view('proyectos_view', (array)$output);
    }
}
