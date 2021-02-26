<?php 
namespace App\Models;

use CodeIgniter\Model;

class EspecialistasModel extends Model
{
    protected $table      = 'especialistas';
    protected $primaryKey = 'id_especialista';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_especialista','nombre_completo','salario_diario'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
?>