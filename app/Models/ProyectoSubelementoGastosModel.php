<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProyectoSubelementoGastosModel extends Model
{
    protected $table      = 'proyectos_subelemento_gastos';
    protected $primaryKey = 'id_proyectos_subelemento_gastos';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_proyectos_subelemento_gastos','fecha','id_proyecto','id_subelemento_gasto','id_especialista','valor'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    

}
?>