<?php 
namespace App\Models;

use CodeIgniter\Model;

class SistemasModel extends Model
{
    protected $table      = 'sistemas';
    protected $primaryKey = 'id_sistema';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_sistema','nombre','version'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
?>