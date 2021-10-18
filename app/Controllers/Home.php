<?php namespace App\Controllers;
use Illuminate\Cookie\CookieJar;
use App\Models\ProyectosModel;
class Home extends BaseController
{
	public function __construct()
	{
		helper(['url','form','form_validation']);
		
	}
	public function index()
	{
        $proyectosActivos=new ProyectosModel(); 
		$cantProyectosActivos=count($proyectosActivos->where('estado', 1)->findAll());
		$cantProyectosCerrados=count($proyectosActivos->where('estado', 0)->findAll());
		$indicesProrrateo=$proyectosActivos->reporte_indices_prorrateo();

		//proyectos proximos a vencer
		// $current_date=date("Y-m-d");
		// $current_date= new DateTime($current_date);
		$proyectosProximosVencimiento=$proyectosActivos->reporte_proyectosProximosVencimiento();
		if($proyectosProximosVencimiento!=0)
		{
			$cantProyectosProximosVencimiento=count($proyectosProximosVencimiento); 	
		}
		else
		{
			$cantProyectosProximosVencimiento=0;	
		}
		
		

		$proyectosVencidos=$proyectosActivos->reporte_proyectosVencidos();
		$cantProyectosVencidos=count($proyectosVencidos);
		if($cantProyectosVencidos!=0)
		{
			$cantProyectosVencidos=count($proyectosVencidos);	
		}
		else{
			$cantProyectosVencidos=0;
		}

        //end proyectos proximos a vencer

		$data=['cantProyectosActivos'=>$cantProyectosActivos,'cantProyectosCerrados'=>$cantProyectosCerrados,'indicesProrrateo'=>$indicesProrrateo,
		'proyectosProximosVencimiento'=>$proyectosProximosVencimiento,'proyectosVencidos'=>$proyectosVencidos,'cantProyectosProximosVencimiento'=>$cantProyectosProximosVencimiento,
	'cantProyectosVencidos'=>$cantProyectosVencidos];
		return view('admin_template/inicio',$data);
	}

	//--------------------------------------------------------------------

}
