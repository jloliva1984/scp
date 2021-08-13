<?php 
namespace App\Models;

use CodeIgniter\Model;

class ResumenProrrateoMensualModel extends Model
{
    protected $table      = 'resumen_prorrateo_mensual';
    protected $primaryKey = 'id_resumen_prorrateo_mensual';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_resumen_prorrateo_mensual','saldo_inicial','costos_directos','costos_indirectos','produccion_proceso','id_proyecto','id_indice_prorrateo'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
  
   

}


?>