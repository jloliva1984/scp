<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\ProyectosModel;
use App\Models\SubelementoGastosModel;
use App\Models\EspecialistasModel;
use App\Models\ResumenProrrateoMensualModel;
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
        $crud->setTable('proyectos');
        $crud->setSubject('Proyectos');
        $crud->setTexteditor(['descripcion']);
        $crud->fieldType('estado', 'hidden',1);

        $crud->setActionButton('Cerrar', 'fa fa-check cerrar_proyecto', function ($row) {;
            // return base_url().'/Proyectos/cerrar_proyecto/' . $row;
          //  return true;
        }, false);
        
       
        $crud->setRead();


        
        
        
        $crud->columns(['codigo','descripcion','valor','Insert./Descar.','fecha_fin','descarga','Cerrar']);

        $crud->callbackColumn('descarga', array($this, '_INCIDENCIAS'));
        $crud->callbackColumn('Insert./Descar.', array($this, '_produccionProceso'));
        $crud->callbackColumn('Cerrar', array($this, '_desglose'));

	    $output = $crud->render();
        return $this->_exampleOutput($output);
    }
    public function cerrar_proyecto($idProyecto)
    {   $session = \Config\Services::session(); 
        $proyecto = new ProyectosModel();
        $proyecto = $proyecto->cerrarProyecto($idProyecto);
        ($proyecto==1)? $session->setFlashdata('confirmacion', 'Proyecto cerrado correctamente') :$session->setFlashdata('confirmacion', 'Error al cerrar proyecto');
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
    public function _desglose($value, $row)
    {
        $id_proyecto=$row->id_proyecto;
        
         
          return
          '
         
           <i data-nombre_proyecto="'.$id_proyecto.'" class="fas fa-check fa-2x cerrar_proyecto"></i>
           
          
           ' ;
    }
    public function _produccionProceso($value, $row)
    { 
        $useKint = true;//para debug
        //sumar todos los elementos de gasto de un proyecto
         $id_proyecto=$row->id_proyecto;
         $subelementos = new SubelementoGastosModel();
         //para determinar lo real descargado para mostrar en el grid
         $totalRealDescargado=$subelementos->totalGastoDescargado($id_proyecto);

         $produccionProceso=$subelementos->sumaSubelementosPorProyecto($id_proyecto);
         //dd($produccionProceso);
         $gastosalariototalarray=$subelementos->gastoSalarioPorProyecto($id_proyecto);
         //dd($gastosalariototalarray);
         $totalSalarioCon909=0;
         //recorro el arreglo que me devuelve la cnsulta sumando el valor de salario909 de cada fila
        //  for($i=0;$i < count($gastosalariototalarray);$i++)
        if($gastosalariototalarray!=0)
        {
            for($i=0;$i<count($gastosalariototalarray);$i++)
            {
            
            $totalSalarioCon909+=$gastosalariototalarray[$i]['gastosalario'];    
                    
                
                // foreach($gastosalariototalarray[$i] as $array)
                //     {
                //         dd($array[1]);
                        
                //         $totalSalarioCon909+=$array['gastosalariocon909'];
                        
                //     }
            }
            //dd( $totalSalarioCon909);
        }
        else
        {
            $totalSalarioCon909+=0;   
        }
        
         //sumandole el salario ya con 909 a la suma de los otros subelemetos de gasto!=de salario
         $gastoTotal=$totalSalarioCon909 + $produccionProceso[0]->valor;
        //   var_dump($gastoTotal);die;

         //$produccionProceso->valor;
        // $icono = base_url() . '/assets/images/descarga.png';
        // return '<a>'.$valor.'</a>';
        if($produccionProceso!=0)
        {//dd($gastoTotal);
          if($gastoTotal!=0){  
          return  
          '<a href="' . base_url() . '/Proyectos/resumen_show/' . $produccionProceso[0]->id_proyecto . '" style="align-content: center">
          '.round($gastoTotal,2).'
          
        </a>
          
          ' ;
          }
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
        //dd($datos);
        //reccoriendo arreglo ,verificando sis existe indice para el mes de la fecha y creando indice con 0 o 1 dependiende de si existe el IP o no
        for($i=0;$i<count($datos);$i++)
        {                    
           $existeIndice=$proyecto->existe_indice_prorrateo(substr($datos[$i]['fecha'],5,2),substr($datos[$i]['fecha'],0,4));
           $datos[$i]['existeIndice']= $existeIndice;
        }
  // TODO: ssssssssssssssssssssssssssssssssssssssssssss
  
        $data = ['proyecto' => $proyecto->find($id_proyecto),'subelementos'=>$subelementos->findAll(),'especialistas'=>$especialistas->findAll(),
                 'datos'=>$datos];
        //dd($datos);
        echo view('descargas_view', $data);
    }

    public function descarga_carga_inicial()
   {   $request = service('request'); //die($_POST['contactFrmSubmit']);isset($_POST['contactFrmSubmit']) &&
if(!empty($request->getPost('monto')) && !empty($request->getPost('fecha')) )
{
    
    // Submitted form data
    $monto=$request->getPost('monto');
    $fecha=$request->getPost('fecha');$anno=substr($fecha,0,4);$mes=substr($fecha,5,2);
    $id_proyecto_subelemento_gasto=$request->getPost('id_proyecto_subelemento_gasto');
    $especialista=$request->getPost('especialista');
    $monto_original=$request->getPost('monto_original');
    $proyectos=new ProyectosModel();
    $existeIp=$proyectos->existe_indice_prorrateo($mes,$anno);

    if($monto>$monto_original)
    {
        echo 'errorMonto';exit();
    }
    if($existeIp==0)
    {
        echo 'noIp';exit();
    }
    else
    {
      $ip=$proyectos->buscar_indice_prorrateo($mes,$anno) ;
      $id_ip=$ip[0]['id_indice_prorrateo'];
      $valorReal=$monto*$ip[0]['valor_indice_prorrateo'];
      $proyectos->insert_descarga_real($id_proyecto_subelemento_gasto,$id_ip,$valorReal);
      //modificar el valor en el proyecto subelemento degasto ,seria monto original - monto
      $proyectos->modificar_monto_subelemento_gasto_carga_inicial($id_proyecto_subelemento_gasto,$monto_original,$monto);
      echo 'ok';
    }
    
    //guardar un ip en la tabla de ips con valor 1 y mes y anno especidicado por el usuario
    
    // try
    // {
    // $insertedId=$proyectos->insert_indice_prorrateo_descarga_inicial($mes,$anno,0,1);
    
    // }
    // catch(\Exception $e)
    // {
    //  echo -1;die; 
    // }

    // //insertar en descarga real los datos de la descarga de la carga inicial con el id del ip insertado
    // $proyectos->insert_descarga_real($id_proyecto_subelemento_gasto,$insertedId,$monto);

    // //tengo que restarle al valor del subelemento de gasto lo que se descargo ,comparar cuando se haga 0 y cambiarle el estado a descargado
    
    // echo 'ok';
}}

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
            $html[0]=''; 
            $htmlfilatotales='';
            $total=0;  
            for($count=0;$count<count($subelemento);$count++)
            {
                $subelem=new SubelementoGastosModel();
                $subelem=$subelem->find($subelemento[$count]);
                $subelem=$subelem['nombre'];  
                $proyecto = new ProyectosModel();
                //verificar si el subelemento es salario,si lo es coger el esp. buscar su salario ,multiplicarlo y ese es el valor
                if($subelem=='Salario')
                {
                $especialistas = new EspecialistasModel();  
                $esp=$especialistas->find($especialista[$count]);
                $valorEsp=($esp['salario_diario'])*$valor[$count];
                $valor909 =$valorEsp*0.0909;
                $valorEsp=$valorEsp+ $valor909;
                //estados = 1 pendiente ,0 descargado
                $inserted_id=$proyecto->insert_descarga($id_proyecto,$subelemento[$count], $especialista[$count], $valorEsp,$fecha[$count],1);
               
                if($inserted_id !=0)//buscando los datos de la descarga una vez insertada para mostrarla concatenando la variale html
                {
                $subelementos = new SubelementoGastosModel();
                $datos= $subelementos->SubElementosGastosxId($inserted_id);
                $nombre_completo='';
               
                $html[0].='<tr><td>'.$datos[0]->nombre.'</td><td>'.$nombre_completo.'</td><td class="valor">'.$datos[0]->valor.'</td><td>'.$datos[0]->fecha.'</td><td><button type="button" name="remove_descarga" class="btn btn-danger  btn-sm" value="'.$datos[0]->id_proyectos_subelemento_gastos.'" remove_descarga" id="'.$datos[0]->id_proyectos_subelemento_gastos.'" onclick="eliminar_descarga('.$datos[0]->id_proyectos_subelemento_gastos.')"><i class="fa fa-minus-circle"></i></td></tr>';
                }
                }
                else
                {
                    $inserted_id=$proyecto->insert_descarga($id_proyecto,$subelemento[$count], $especialista[$count],$valor[$count],$fecha[$count],1);
                    
                    if($inserted_id !=0)//buscando los datos de la descarga una vez insertada para mostrarla concatenando la variale html
                    {
                    $subelementos = new SubelementoGastosModel();
                    $datos= $subelementos->SubElementosGastosxId($inserted_id);
                   // echo($datos);die;
                    $html[0].='<tr><td>'.$datos[0]->nombre.'</td><td>'.'$datos[0]->nombre_completo'.'</td><td class="valor">'.$datos[0]->valor.'</td><td>'.$datos[0]->fecha.'</td><td><button type="button" name="remove_descarga" class="btn btn-danger  btn-sm" value="'.$datos[0]->id_proyectos_subelemento_gastos.'" remove_descarga" id="'.$datos[0]->id_proyectos_subelemento_gastos.'" onclick="eliminar_descarga('.$datos[0]->id_proyectos_subelemento_gastos.')"><i class="fa fa-minus-circle"></i></td></tr>';
                    }
                }
              
            }

           }
           $html=strip_slashes($html[0]);
           //$html = quotes_to_entities($html); 
           $html[0] = str_replace ('"\"',' ', $html[0]);
           echo ($html)  ; 

        } 
    }

    public function desglose_show($id_proyecto)
    {
        $useKint = true;//para debug
        //sumar todos los elementos de gasto de un proyecto
        $gastosalario=0;
         $subelementos = new SubelementoGastosModel();
         $produccionProceso=$subelementos->sumaSubelementosPorProyecto($id_proyecto);
         $gastosalariototalarray=$subelementos->gastoSalarioPorProyecto($id_proyecto);
         //dd($gastosalariototalarray);
         $totalSalarioCon909=0;
         $vacaciones909=0;
         //recorro el arreglo que me devuelve la cnsulta sumando el valor de salario909 de cada fila
        //  for($i=0;$i < count($gastosalariototalarray);$i++)
        if($gastosalariototalarray!=0)
        {
            for($i=0;$i<count($gastosalariototalarray);$i++)
            {
            
            $gastosalario+=$gastosalariototalarray[$i]['gastosalario'];    
            $vacaciones909+=$gastosalariototalarray[$i]['vacaciones'];  
            }
        }
        else
        {
            $gastosalario+=0; $vacaciones909+=0;  
        }

        $gastoTotal=$totalSalarioCon909 + $produccionProceso[0]->valor;
    }
    
   public function resumen_show($id_proyecto)
   {
    $useKint = true;//para debug
    $resultArray= Array();   
    $subelementos = new SubelementoGastosModel();
    $proyectos = new ProyectosModel();
    $datosproyectos=$proyectos->find($id_proyecto);
    $resultArray[0]=$datosproyectos;
    $subelementos = $subelementos->findAll();
    
   // dd($subelementos);
    foreach($subelementos as $subelem)
    {
      $result=$proyectos->resumen_proyecto_subelemento($id_proyecto,$subelem['id_subelemento_gasto']);
      $resultArray[$subelem['nombre']]=$result[0]['valor'];
    }
    $data=['resultados'=> $resultArray];
    
    return view('resumen_view',$data);
   }
    private function _exampleOutput($output = null) {
        return view('proyectos_view', (array)$output);
    }

    public function prorrateo_show()
    {
        
        if(!empty($_POST))//si hay evio de datos se procesa
        {
            $request = service('request');//para poder usar $request->getPost
            $useKint = true;//para debug 
            $mes=$request->getPost('mes') ;
            $anno=$request->getPost('anno') ;
            $saldoInicio=array();
            
            $valor731=$request->getPost('valor731') ;
            $cantDias = cal_days_in_month(CAL_GREGORIAN, $mes, $anno); // determiandno la cantidad de dias del mes y año seleccionado
            $fechaInicio=$anno.'-'.$mes.'-01';
            $fechaFin=$anno.'-'.$mes.'-'.$cantDias;
            $proyectos=new ProyectosModel();
            $resultados=$proyectos->prorrateo($fechaInicio,$fechaFin);
            $totalProduccionProceso=0;
            if(isset($resultados) && $resultados!=0)
            {
            foreach($resultados as $resultado)
            {
                $totalProduccionProceso+=$resultado['produccionProceso'];
                $saldoInicio[]=$this->saldoInicial($resultado['id_proyecto'],$mes,$anno);
            }
            
            }else{$totalProduccionProceso=0;}
            $data=['resultados'=>$resultados,'mes'=>$mes,'anno'=>$anno,'valor731'=>$valor731,'totalProduccionProceso'=>$totalProduccionProceso,'saldosInicio'=>$saldoInicio];
            
            // return view('prorrateo_datatable_view',$data);
            return view('prorrateo_view',$data);

            

            
           
        
        }
        else // si no hay envio de datos muestro la vista inicial
        {
          return view('prorrateo_view');
        }
    }
    public function reporte_prorrateo()
    {
        
        if(!empty($_POST))//si hay evio de datos se procesa
        {
            $request = service('request');//para poder usar $request->getPost
            $useKint = true;//para debug 
            $mes=$request->getPost('mes') ;
            $anno=$request->getPost('anno') ;
            $saldoInicio=array();
            
            // $valor731=$request->getPost('valor731') ;
            $cantDias = cal_days_in_month(CAL_GREGORIAN, $mes, $anno); // determiandno la cantidad de dias del mes y año seleccionado
            $fechaInicio=$anno.'-'.$mes.'-01';
            $fechaFin=$anno.'-'.$mes.'-'.$cantDias;
            $proyectos=new ProyectosModel();
            // $resultados=$proyectos->prorrateo($fechaInicio,$fechaFin);
            $resultados=$proyectos->reporte_prorrateo($mes,$anno);
            
            // $totalProduccionProceso=0;
           
            $data=['resultados'=>$resultados,'mes'=>$mes,'anno'=>$anno];
            // return view('prorrateo_datatable_view',$data);
            return view('reportes/prorrateo_view',$data);

            

            
           
        
        }
        else // si no hay envio de datos muestro la vista inicial
        {
          return view('reportes/prorrateo_view');
        }
    }
    public function saldoInicial($id_proyecto,$mes,$anno)
    {
     $fecha=$this->mesAnterior($mes,$anno);
     $proyectos = new ProyectosModel();
      //determinando la cantidad de dias del mes anterior para determinar la fechainicio y fin para la consulta de busqueda
      $cantDias = cal_days_in_month(CAL_GREGORIAN,substr($fecha,5,2),substr($fecha,0,4)); // determiandno la cantidad de dias del mes y año seleccionado
      $fechaInicio=$anno.'-'.$mes.'-01';
      $fechaFinMesAnterior=substr($fecha,0,4).'-'.substr($fecha,5,2).'-'.$cantDias;
      $saldo_inicio=$proyectos->saldoInicial($id_proyecto,$fechaFinMesAnterior);
      if($saldo_inicio[0]['saldoInicial']!=0){return $saldo_inicio[0]['saldoInicial'];}else {return 0;}
     // return ($saldo_inicio[0]['saldoInicial']);//tengo que devolver 0 si no me trae nada
    //  saldoInicio($mes,$anno,$id_proyecto);

    }
//todo revisar prrotateo por meses
    public function reportes_dashboard()
    {
        return view('reportes/reportes_dashboard');
    }
    public function reporte_especialista_show()
    {
        if(!empty($_POST))
        {
            $request = service('request');
            $especialistas = $request->getPost('especialistas');
            

            $resultRow = array();
            if(isset($especialistas) && $especialistas!='')
            {
                // foreach($especialistas as $especialista)
                // {

                // }
                $resultados = new ProyectosModel();
                $resultados = $resultados->reporte_resumen_especialista($especialistas);

                $especialistas = new EspecialistasModel();
                $especialistas=$especialistas->findAll();

                $data=['resultados'=>$resultados,'especialistas'=> $especialistas];
               return view('reportes/reporte_especialista_view',$data);
                

            }
        }
        else
        {
            $especialistas = new EspecialistasModel();
            $especialistas=$especialistas->findAll();
            $data=['especialistas'=>$especialistas];
            return view('reportes/reporte_especialista_view',$data);
        }
    }

    public function mesAnterior($mes,$anno)
    {  
        $fecha=$anno.'-'.$mes.'-01';
        $date=date_create($fecha);
        date_sub( $date,date_interval_create_from_date_string("1 MONTH"));
        return date_format($date,"Y-m");
    }

    public function descargados($id_proyecto)
    {
        $proyectos=new ProyectosModel();
        $subelementos = new SubelementoGastosModel();
        $proyectos= $proyectos->find($id_proyecto);
        $resumenDescargardosPorProyecto= $subelementos->resumenDescargardosPorProyecto($id_proyecto);
      
        $data=['resumenDescargardosPorProyecto'=>$resumenDescargardosPorProyecto];
        return view('descargados_view',$data);
    }
    public function getSubelementoGasto($value, $row)
    { 
        $id_proyectos_subelemento_gastos_real=$row->id_proyectos_subelemento_gastos_real;
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        subelemento_gastos.nombre,
        subelemento_gastos.codigo
        FROM
        proyectos_subelemento_gastos_real
        Inner Join proyectos_subelemento_gastos ON proyectos_subelemento_gastos.id_proyectos_subelemento_gastos = proyectos_subelemento_gastos_real.id_proyectos_subelemento_gastos
        Inner Join subelemento_gastos ON subelemento_gastos.id_subelemento_gasto = proyectos_subelemento_gastos.id_subelemento_gasto
        WHERE
        proyectos_subelemento_gastos_real.id_proyectos_subelemento_gastos_real =  ' $id_proyectos_subelemento_gastos_real'
        ");

         return ($query->getResult()[0]->codigo.' - '.$query->getResult()[0]->nombre);
     
    }
    public function getEspecialista($value, $row)
    { 
        $id_proyectos_subelemento_gastos_real=$row->id_proyectos_subelemento_gastos_real;
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        especialistas.nombre_completo
        FROM
        proyectos_subelemento_gastos_real
        Inner Join proyectos_subelemento_gastos ON proyectos_subelemento_gastos.id_proyectos_subelemento_gastos = proyectos_subelemento_gastos_real.id_proyectos_subelemento_gastos
        Inner Join especialistas ON especialistas.id_especialista = proyectos_subelemento_gastos.id_especialista
        WHERE
        proyectos_subelemento_gastos_real.id_proyectos_subelemento_gastos_real =  ' $id_proyectos_subelemento_gastos_real'
        ");

         return ($query->getResult()[0]->nombre_completo);
     
    }

    public function descarga_real()
    {
        $request = service('request');//para poder usar $request->getPost
        $useKint = true;//para debug
        $proyectos = new ProyectosModel();
        $insercion=0;
        $noInsercion=0;
        $resultadoGeneral=array();
        // var_dump($_POST);
        // print_r(json_decode($_POST["ids"],TRUE));
        $result=0;
        $ids=json_decode($request->getPost('ids'));
        $totalids=count( $ids);
          foreach ($ids as $id) 
          {
           $resultado=$proyectos->validar_existencia_indice($id->value);  //function que veririfica que exista el Indice de prorrateo para las fechas de las descargas seleccionadas
          
           if($resultado!=0)
           {
                if($proyectos->descarga_real($id->value)!=0)//1 pasado ,0 descargado,-1 descargando
                {
                        //cambio el estado a descargado del registro
                        $result+=1;//cambio el estado a descargado del registro y cuento para despues comparar si se inserrtaron todos
                        //aqui insertare en la tabla descarga real el valor * indice de prorrateo
                        $r=$proyectos->insert_descarga_real($id->value,$resultado['result'][0]['id_indice_prorrateo'],$resultado['valor']*$resultado['result'][0]['valor_indice_prorrateo']);
                        
                        
                        if($r!=0){$insercion+=1;}//cuento cada vez que inserto
                }  
           }
           else
           {
            $noInsercion+=1;//devuelvo 2 sin no existe indice de prorrateo para la descarga que se intenta pasar
           }   
        }
        $resultadoGeneral['insertados']=$insercion;
        $resultadoGeneral['noInsertados']=$noInsercion;
        //var_dump($resultadoGeneral);die;
        echo json_encode($resultadoGeneral);
        //if($result==$totalids){echo 1;}else{echo 0;}//aqui valido que todos los ids enviados fueron modificados
    }

    public function guardar_prorrateo()
    {
        $request = service('request');
        $mes=$request->getPost('mes');$anno=$request->getPost('anno');$valor_indice_prorrateo=$request->getPost('indice_prorrateo');
        $valor731=$request->getPost('valor731');
        
         $generalResult = json_decode($request->getPost('generalResult'));//  reciviendolo como array
         
         $generalResult=array_chunk($generalResult, 6);//divide el resultado en arreglos de 6 posiciones wue son los datos que envio desde html
      
        
         $db      = \Config\Database::connect();
         $db->transBegin(); 
         
        $proyectos=new ProyectosModel();
        try
        {
        $insertedId=$proyectos->insert_indice_prorrateo($mes,$anno,$valor731,$valor_indice_prorrateo);
        
        }
        catch(\Exception $e)
        {
         echo -1;die; 
        }
        if($insertedId!=0)//inserto
        {
            $resumen=new ResumenProrrateoMensualModel();

            foreach($generalResult as $resultRow)
            {

            //    var_dump($resultRow);
            $data = ['saldo_inicial'=>$resultRow[2],'costos_directos'=>$resultRow[3],'costos_indirectos'=>$resultRow[4],
            'produccion_proceso'=>$resultRow[5],'id_proyecto'=>$resultRow[0],'id_indice_prorrateo'=>$insertedId];//
            try
            {
                $result=$resumen->insert($data);
            }
            catch (\Exception $e)
            {
               echo -1;die;
            }
           
          
            if($result!=0){echo 1;}else{echo 0;}
             }
            
         
        }
        {
            echo 0;       
        } 
        if ($db->transStatus() === FALSE)
        {
           $db->transRollback();
           echo (-1);
        }
        else
        {
            $db->transCommit();
            
        }  
       
    }

    public function verificar_prorrateo()
    {
        $request = service('request');
        $mes=$request->getPost('mes');$anno=$request->getPost('anno');

        $proyectos=new ProyectosModel();
        $result=$proyectos->verificar_prorrateo($mes,$anno);
        if($result==1)//ya exsite el indice para el mes y ano enviado
        {
         echo 1;
        }
        else
        {
            echo 0;       
        } 
    }

    public function reporte_resumen_especialista()
    {
                  
            $request = service('request');
            $especialistas = $request->getPost('especialistas');
            

            $resultRow = array();
            if(isset($especialistas) && $especialistas!='')
            {
                // foreach($especialistas as $especialista)
                // {

                // }
                $resultados = new ProyectosModel();
                $resultados = $resultados->reporte_resumen_especialista($especialistas);
                dd($resultados);
                

            }

            
    }
}
