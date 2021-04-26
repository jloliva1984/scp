<?php 
namespace App\Models;

use CodeIgniter\Model;

class SubelementoGastosModel extends Model
{
    protected $table      = 'subelemento_gastos';
    protected $primaryKey = 'id_subelemento_gasto';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_subelemento_gasto','codigo','nombre'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function SubElementosGastosxProyecto($id_proyecto)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('proyectos');
        $builder->select('*');
        $builder->join('proyectos_subelemento_gastos', 'proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto');
        $builder->join('especialistas', 'proyectos_subelemento_gastos.id_especialista = especialistas.id_especialista');
        $builder->join('subelemento_gastos', 'proyectos_subelemento_gastos.id_subelemento_gasto = subelemento_gastos.id_subelemento_gasto');
        $builder->having('proyectos.id_proyecto',$id_proyecto);
        $builder->having('proyectos_subelemento_gastos.estado',1);// el que tenga estado 1 esta pendiente ,el 0 esta descargado
        //dd($builder->getCompiledSelect());
        $query = $builder->get();
        $useKint = true;//para debug
        return $query->getResult();
    }
    public function SubElementosGastosxId($inserted_id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('proyectos');
        $builder->select('*');
        $builder->join('proyectos_subelemento_gastos', 'proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto');
        $builder->join('especialistas', 'proyectos_subelemento_gastos.id_especialista = especialistas.id_especialista');
        $builder->join('subelemento_gastos', 'proyectos_subelemento_gastos.id_subelemento_gasto = subelemento_gastos.id_subelemento_gasto');
        $builder->having('proyectos_subelemento_gastos.id_proyectos_subelemento_gastos',$inserted_id);
        //echo ($builder->getCompiledSelect());die;
        $query = $builder->get();
        $useKint = true;//para debug
        return $query->getResult();
    }

    public function sumaSubelementosPorProyecto($id_proyecto)
    {
        //aqui no incluyo el subelemento salario
        $db      = \Config\Database::connect();
        $builder = $db->table('proyectos');

        $builder->selectSUM('proyectos_subelemento_gastos.valor','valor');
        //$builder->select('proyectos_subelemento_gastos.valor');
        $builder->select('proyectos.id_proyecto');
        //$builder->select('subelemento_gastos.nombre');
        $builder->join('proyectos_subelemento_gastos', 'proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto');
        $builder->join('especialistas', 'proyectos_subelemento_gastos.id_especialista = especialistas.id_especialista');
        $builder->join('subelemento_gastos', 'proyectos_subelemento_gastos.id_subelemento_gasto = subelemento_gastos.id_subelemento_gasto');
        $builder->where('proyectos.id_proyecto',$id_proyecto);
        $builder->where('proyectos_subelemento_gastos.estado',1);
        $builder->where('subelemento_gastos.nombre!=','salario');
        $query=$builder->get();
        
        if($builder->countAllResults()>0) { return $query->getResult();} else { return 0;}
        
    }

    public function gastoSalarioPorProyecto($id_proyecto)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
            especialistas.salario_diario,
        proyectos_subelemento_gastos.valor as gastosalario,
        (proyectos_subelemento_gastos.valor)*0.0909 as vacaciones,
        (proyectos_subelemento_gastos.valor)*0.0909+ (proyectos_subelemento_gastos.valor) as gastosalariocon909,
        proyectos_subelemento_gastos.valor,
        subelemento_gastos.nombre,
        especialistas.nombre_completo
        FROM
        proyectos
        Inner Join proyectos_subelemento_gastos ON proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto
        Inner Join subelemento_gastos ON subelemento_gastos.id_subelemento_gasto = proyectos_subelemento_gastos.id_subelemento_gasto
        Inner Join especialistas ON especialistas.id_especialista = proyectos_subelemento_gastos.id_especialista
        WHERE
        proyectos.id_proyecto =  '$id_proyecto' AND
        subelemento_gastos.nombre =  'salario'
        ");
        if($db->affectedRows()>0) { return $query->getResultArray();} else { return 0;}
        
    }
    public function totalGastoDescargado($id_proyecto)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        Sum(proyectos_subelemento_gastos_real.valor) AS totalDescargado
        FROM
        proyectos_subelemento_gastos
        Inner Join proyectos_subelemento_gastos_real ON proyectos_subelemento_gastos.id_proyectos_subelemento_gastos = proyectos_subelemento_gastos_real.id_proyectos_subelemento_gastos
        WHERE
                proyectos_subelemento_gastos.id_proyecto =  '$id_proyecto' AND
                proyectos_subelemento_gastos.estado =  '0'
        ");
        if($db->affectedRows()>0) { return $query->getResultArray();} else { return 0;}
        
    }

}
?>