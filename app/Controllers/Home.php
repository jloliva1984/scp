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
		$data=['cantProyectosActivos'=>$cantProyectosActivos,'cantProyectosCerrados'=>$cantProyectosCerrados,'indicesProrrateo'=>$indicesProrrateo];
		return view('admin_template/inicio',$data);
	}

	//--------------------------------------------------------------------

}
