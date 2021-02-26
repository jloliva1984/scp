<?php 
namespace app\Models;
use CodeIgniter\Model;

class SubsistemasModel extends Models
{
    protected $table      = 'subsistemas';
    protected $primaryKey = 'id_subsistema';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_subsistema','id_sistema','nombre'];
    
}

?>