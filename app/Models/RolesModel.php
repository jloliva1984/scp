<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class RolesModel extends Model{
    protected $table = 'roles';
    protected $allowedFields = ['rol'];

    public function GetAllowedActionsPerUserRol($id_usuario)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("
        SELECT
        actions.url
        FROM
        actions_roles
        Inner Join actions ON actions.id = actions_roles.id_action
        Inner Join roles ON roles.id_rol = actions_roles.id_rol
        Inner Join usuarios ON usuarios.id_rol = roles.id_rol
        WHERE
        usuarios.id_usuario =  $id_usuario

        ");
        if($db->affectedRows()>0) { return $query->getResultArray();} else { return 0;}
    }
}