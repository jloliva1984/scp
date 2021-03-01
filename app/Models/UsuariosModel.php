<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsuariosModel extends Model{
    protected $table = 'usuarios';
    protected $allowedFields = ['user','password'];
}