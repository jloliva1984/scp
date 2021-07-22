<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\RolesModel;
use App\Models\UsuariosModel;
use App\libraries\Hash; 


class Usuarios extends BaseController
{
   public function __construct()
   {
	   helper(['url','form','form_validation']);
	   
   }

	public function index()
	{
		return view('welcome_message');
	}
    public function Usuarios_management()
	{
        
	    $crud = new GroceryCrud();

        $crud->setTable('usuarios');
		$crud->setSubject('usuarios');
		$crud->unsetAdd();
        
		$crud->columns(['user','password']);
		$crud->displayAs('user','Usuario');
	    $output = $crud->render();

		return $this->_exampleOutput($output);
	}
	public function addUserShow()
	{
		$rolesModel = new RolesModel();
		$roles = $rolesModel->findAll();

		helper('form');
		helper('url');

		$validation =  \Config\Services::validation();
		$validation=$this->validate('usuarios');
		
		$data=array('roles'=>$roles,'validation'=>$validation);
		return view('addUser_view',$data);
	}
	public function addUser()
	{  session();

		$rolesModel = new RolesModel();
		$roles = $rolesModel->findAll();
 
		if(isset($_POST))
		{ 
			$validation =  \Config\Services::validation();
			
				if(!$this->validate('usuarios')){
					
					return view('addUser_view',['validation'=>$validation,'roles'=>$roles]);
				}
				else
				{
					$usuario=$this->request->getPost('usuario');
					$password=$this->request->getPost('password');
					$rol=$this->request->getPost('rol');

					//Hash::hash_password($this->request->getPost('password') es una libreria que cree en libraries con el metodo hash_password para encriptar la contraseña
					$values=['user'=>$this->request->getPost('usuario'),'password'=>Hash::hash_password($this->request->getPost('password')),'id_rol'=>$this->request->getPost('rol')];
					$usuariosModel = new UsuariosModel();
					$query = $usuariosModel->insert($values);

					if(!$query)
					{
						return redirect()->back()->with('error','Hubo un error al insertar los datos');
					}
					else
					{
						return redirect()->to('addUser')->with('success','Datos Insertados correctamente');	
					}
				}
		}
		else
		{   
			$rolesModel = new RolesModel();
			$roles = $rolesModel->findAll();
	
			helper('form');
			helper('url');
	
			$validation =  \Config\Services::validation();
			$validation=$this->validate('usuarios');
			
			$data=array('roles'=>$roles,'validation'=>$validation);
			return view('addUser_view',$data);
		}	
	}
	
	public function GestionarUsuariosShow()
	{

	//buscar los roles para pasarlos a la vista
	$rolesModel = new RolesModel();
	$roles = $rolesModel->findAll();
	var_dump($roles);die;
	//mostrar la vista	
	}
   




	public function GestionarUsuarios($id_user)
	{
		helper('form');
		helper('url');
  
	 $rolesModel = new RolesModel();
	 $roles = $rolesModel->findAll();
	 
	 $data=array('roles'=>$roles,'action'=>'add');
	  if($id_user=='I')
	  {//dd($_POST);
		if(!isset($_POST) && count($_POST)==0){echo 'no eviando';die;}
			//$this->load->library('form_validation');
			helper('form');
			helper('url');
			session();
			$validation =  \Config\Services::validation();
			  
			if (! $this->validate('usuarios')) {
				//dd($validation->getErrors());
                  if(isset($_POST)&& count($_POST)>0){
				     return redirect()->back()->withInput()->with('validation',$validation->getErrors());
			      }   
				$data=array('roles'=>$roles,'action'=>'add','validation'=>$validation);
			  return view('gestionar_usuarios_view',$data);
			 
			}
			else {
			  $encrypted_pass=$this->encrypt_password($this->input->post('password'));
			  $this->Contabilidad_model->insert_user($this->input->post('unidad'),$this->input->post('usuario'),$encrypted_pass,$this->input->post('rol'));
			  redirect('/contabilidad/usuarios_show', 'refresh');
			}
	  }
	  else //esta recibiendo un id como parametro ,estonces estoy modificando
	  {
	   $user_entity=$this->Contabilidad_model->user_unidad($id_user);
	   // var_dump($user_entity);die;
	   $user=$this->Contabilidad_model->user_data($id_user);
	   $usuario=$user[0]->username;
	   $pass=$user[0]->password;
	   $password=$this->decrypt_password($pass);
	   $rol=$user[0]->rol;
  
  
		$data=array('usuario'=>$usuario,'password'=>$password,'rol'=>$rol,'unidades'=>$unidades,'user_entity'=>$user_entity,'action'=>'edit');
  
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
  
		$this->form_validation->set_rules('unidad', 'Unidad', 'callback_unity_validate');
		$this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('verify_password', 'Confirmar Password', 'required|matches[password]');
		$this->form_validation->set_rules('rol', 'Rol', 'required');
  
		if ($this->form_validation->run() == FALSE) {
		  $this->load->view('template/header.html');
		  $this->load->view('usuarios/modificar_usuario_view',$data);
		  $this->load->view('template/footer.php');
		}
		else {
		  $encrypted_pass=$this->encrypt_password($this->input->post('usuario'));
		  $this->Contabilidad_model->update_user($id_user,$this->input->post('usuario'),$encrypted_pass,$this->input->post('rol'));
		  redirect('/contabilidad/usuarios_show', 'refresh');
		}
	  }
	}
	function encrypt_password($password)
	{
	  $this->load->library('encrypt');
	  //$key = 'super-secret-key';
	  $password = $this->encrypt->encode($password);
	  return $password;
	}
	public function decrypt_password($password)
	{
	  $this->load->library('encrypt');
	  //$key = 'super-secret-key';
	  $password = $this->encrypt->decode($password);
	  return $password;
	}


    private function _exampleOutput($output = null) {
        return view('usuarios_view', (array)$output);
    }
}
