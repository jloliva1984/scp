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
        $db      = \Config\Database::connect();
        $builder = $db->table('proyectos');

        $builder->selectSUM('proyectos_subelemento_gastos.valor','valor');
        $builder->select('proyectos.id_proyecto');
        $builder->join('proyectos_subelemento_gastos', 'proyectos.id_proyecto = proyectos_subelemento_gastos.id_proyecto');
        $builder->join('especialistas', 'proyectos_subelemento_gastos.id_especialista = especialistas.id_especialista');
        $builder->join('subelemento_gastos', 'proyectos_subelemento_gastos.id_subelemento_gasto = subelemento_gastos.id_subelemento_gasto');
        $builder->having('proyectos.id_proyecto',$id_proyecto);
        $query=$builder->get();
        if($db->affectedRows()>0) { return $query->getResult();} else { return 0;}
        
    }

}
?>