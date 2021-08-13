<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsuariosModel extends Model{
    protected $table = 'usuarios';
    protected $primaryKey = ['id_usuario'];
    protected $allowedFields = ['user','password','id_rol'];

    public function userInfo($username)
    {
        $db      = \Config\Database::connect();

        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->join('roles', 'usuarios.id_rol = roles.id_rol');
        $builder->where('user',$username);
        $query = $builder->get();

        if($db->affectedRows()>0) { return $query->getResult();} else { return 0;}   
    }
}