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
    public function insert_descarga($id_proyecto,$id_subelemento_gasto,$id_especialista,$valor,$fecha)
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

}
?>