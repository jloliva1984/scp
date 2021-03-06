<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProyectosModel extends Model
{
    protected $table      = 'proyectos';
    protected $primaryKey = 'id_proyecto';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_proyecto','codigo','descripcion','valor','fecha_inicio','fecha_fin','estado'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
  
    function delete_descarga($id_proyectos_subelemento_gastos)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('proyectos_subelemento_gastos');
        $query   = $builder->get();  // Produces: SELECT * FROM mytable   
         
        $builder->where('id_proyectos_subelemento_gastos', $id_proyectos_subelemento_gastos);
        $builder->delete(); 

        if($db->affectedRows()>0){return 1;}else{return 0;}
            
    }
    public function insert_descarga($id_proyecto,$id_subelemento_gasto,$id_especialista,$valor,$fecha,$estado)
    {   
        $db      = \Config\Database::connect();
        $builder = $db->table('proyectos_subelemento_gastos');

        //$this->db->transStart(true); // Query will be rolled back
        $data = [
            'id_subelemento_gasto' => $id_subelemento_gasto,
            'id_especialista' => $id_especialista,
            'valor' => $valor,
            'fecha'  => $fecha,
            'id_proyecto'  => $id_proyecto,
            'estado'=>$estado,
        ];
        
        $builder->insert($data);
       // $this->db->transComplete();
        if($db->affectedRows()>0)
            {
            return $db->insertID();	
            }
            else
            {
                return 0;
            }
    }


    public function resumen_proyecto_subelemento($id_proyecto,$id_subelemento)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        Sum(proyectos_subelemento_gastos.valor) AS valor
        FROM
        proyectos_subelemento_gastos
        Inner Join subelemento_gastos ON subelemento_gastos.id_subelemento_gasto = proyectos_subelemento_gastos.id_subelemento_gasto
        Inner Join proyectos ON proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto
        WHERE
        proyectos.id_proyecto =  '$id_proyecto' AND
        subelemento_gastos.id_subelemento_gasto =  '$id_subelemento'
        
        ");
        if($db->affectedRows()>0) { return $query->getResultArray();} else { return 0;}
    }
    public function prorrateo($fechaInicio,$fechaFin)
    {//busca la suma de los subelem de gasto sin descargar(prod en proceso) de todos los proyectos por meses de los proyectos activos
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        Sum(proyectos_subelemento_gastos.valor) AS produccionProceso,
        proyectos.codigo,
        proyectos.descripcion,
        proyectos.id_proyecto
        FROM
        proyectos_subelemento_gastos
        Inner Join proyectos ON proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto
        Inner Join subelemento_gastos ON subelemento_gastos.id_subelemento_gasto = proyectos_subelemento_gastos.id_subelemento_gasto
        WHERE
        proyectos_subelemento_gastos.estado =  '1' AND
        proyectos.estado =  '1' AND
        proyectos_subelemento_gastos.fecha BETWEEN  '$fechaInicio' AND '$fechaFin'
        GROUP BY
        proyectos.codigo,
        proyectos.descripcion
        ");
        if($db->affectedRows()>0) { return $query->getResultArray();} else { return 0;}
    }
    public function saldoInicial($id_proyecto,$fechaFinMesAnterior)//buscar el saldo inicio de un proyecto ,que es lo quedo sin descargar dle mes anterior
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        Sum(proyectos_subelemento_gastos.valor) as saldoInicial
        FROM
        proyectos_subelemento_gastos
        Inner Join proyectos ON proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto
        WHERE
        proyectos_subelemento_gastos.fecha <=  '$fechaFinMesAnterior' AND
        proyectos.id_proyecto =  '$id_proyecto' AND
        proyectos_subelemento_gastos.estado =  '1'
        
        ");
        if($db->affectedRows()>0) { return $query->getResultArray();} else { return 0;}
    }
    public function descarga_real($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('proyectos_subelemento_gastos');
        $data = ['estado' => 0];//pendiente 1 ,descargado 0
        
        $builder->where('id_proyectos_subelemento_gastos', $id);
        $builder->update($data);

        if($db->affectedRows()>0){return 1;}else{return 0; }//retorna 1 si la consulta de modificacion fue ok ,0 si no
    }
    public function buscar_indice_prorrateo($mes,$anno)//function que busca si esta definido el indice para un mes  y anno
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        indices_prorrateo.valor_indice_prorrateo,
        indices_prorrateo.id_indice_prorrateo
        FROM
        indices_prorrateo
        WHERE
        indices_prorrateo.mes =  '$mes' AND
        indices_prorrateo.anno =  '$anno'
        
        ");
        if($db->affectedRows()>0) { return $query->getResultArray();} else { return 0;}    
    }

    public function validar_existencia_indice($id)
    {
//aqui cojo el id del gasto registrado y valido que este el indice de prorrqateo definido para su fecha
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        proyectos_subelemento_gastos.fecha,
        proyectos_subelemento_gastos.valor

        FROM
        proyectos_subelemento_gastos
        WHERE
        proyectos_subelemento_gastos.id_proyectos_subelemento_gastos =  '$id'
        ");
        if($db->affectedRows()>0) {
             $fecha= $query->getResultArray();
             $valor= $fecha[0]['valor'];
             $fecha= $fecha[0]['fecha'];
             $data=array();
             $fechaComoEntero = strtotime($fecha);//convirtiendo la fecha a formato entero para poder buscar mes y anno
             $anno = date("Y", $fechaComoEntero);
             $mes = date("m", $fechaComoEntero);
             $result=$this->buscar_indice_prorrateo($mes,$anno);
             
            if($result!=0)
            {
                $data['result']=$result;$data['valor']=$valor;//aqui devuielvo el valor del gasto y el resultado de buscar prorrateo
                return $data;
            }
            else {return 0;}
            }
         else { return 0;}

    }
    
    public function insert_indice_prorrateo($mes,$anno,$valor731,$valor_indice_prorrateo)
    {   
       
        $db      = \Config\Database::connect();
        $builder = $db->table('indices_prorrateo');

        //$this->db->transStart(true); // Query will be rolled back
        $data = [
            'mes' => $mes,
            'anno' => $anno,
            'valor731' => $valor731,
            'valor_indice_prorrateo'  => $valor_indice_prorrateo,
         ];
        
        $builder->insert($data);
       // $this->db->transComplete();
        if($db->affectedRows()>0)
            {
            return $db->insertID();	
            }
            else
            {
                return 0;
            }
    }

    public function insert_descarga_real($id_proyectos_subelemento_gastos,$id_indice_prorrateo,$valorReal)
    {
        
        // $result=$this->descarga_real($id_proyectos_subelemento_gastos);//antes de insertar la descarga real le cambio el estado a la descarga
        // if($result==1)//si efectivamente se cambio el estado
        // {
            $db      = \Config\Database::connect();
            $builder = $db->table('proyectos_subelemento_gastos_real');

            //$this->db->transStart(true); // Query will be rolled back
            $data = [
                'id_proyectos_subelemento_gastos' => $id_proyectos_subelemento_gastos,
                'id_indice_prorrateo' => $id_indice_prorrateo,
                'valor' => round($valorReal,2),
            ];
            
            $builder->insert($data);
        // $this->db->transComplete();
            if($db->affectedRows()>0)
                {
                return $db->insertID();	
                }
                else
                {
                    return 0;
                }
        // } 
        // else
        // {
        //     return 0;
        // }   
    }

    

}


?>