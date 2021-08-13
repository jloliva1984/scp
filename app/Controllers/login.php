<?php namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\UsuariosModel;
use App\libraries\Hash;

class Login extends BaseController
{

	public function __construct()
	{
		helper(['url','form','form_validation']);
		
	}
	public function index()
	{
		session();

		$request = service('request');	
		
		// if($request->getMethod()=="post")
		if(!empty($_POST))
		{
		// $username = "jorge.oliva";
		// $password = "Godblessourfate1.***";


		$validation = $this->validate([
			'usuario'          => [
					  'rules'=>'required|min_length[4]|is_not_unique[usuarios.user]',
					  'errors'=>[
								'required'=>'El campo usuario es obligatorio',
								'min_length'=>'El campo usuario debe tener al menos 4 caracteres',
								'is_not_unique'=>'El usuario no existe en el sistema',
  					            ]
					  ],
			
			'password'          => [
						'rules'=>'required|min_length[4]',
						'errors'=>[
								  'required'=>'El campo password es obligatorio',
								  'is_not_unique'=>'El campo password debe tener al menos 4 caracteres',
									]
						]		  

			


	

		]);

		if (! $validation)
		{
		
          return view('login/login_view',['validation'=>$this->validator]);
		}
		else
		{
			$username=$request->getPost('usuario');
			$password=$request->getPost('password');
			
			$userInfo = new UsuariosModel();
			$userInfo = $userInfo->userInfo($username);
			//$userInfo = $userInfo->where('user',$username)->first();
			$checkPassword=Hash::check_password($password,$userInfo[0]->password);
			
			if(!$checkPassword)
			{
			  session()->setFlashdata('fail','Credenciales incorrectas');
			  //redirect()->to('/login')->withInput();
			  return view('login\login_view');
			}
			else
			{
				$userId=$userInfo[0]->id_usuario;
				$userName=$userInfo[0]->user;
				$rol=$userInfo[0]->rol;
				session()->set('loggedUser',$userId);
				session()->set('loggedUserName',$userName);
				session()->set('loggedrol',$rol);
				return redirect()->to(base_url().'/Home');
			}

		}

		
		//verificar que el usaurio exista

		//verificar que la contraseña sea correcta
		
		
		
		
		// $ldapconfig['host'] = 'vzeus.sc.azcuba.cu';
		// $ldapconfig['port'] = '389';
		// $ldapconfig['basedn'] = 'dc=sc,dc=azcuba,dc=cu';
		// $ldapconfig['usersdn'] = 'cn=ESISC';
		// $ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
		
		// ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
		// ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
		// ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);
		
		// $dn="cn=".$username.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
		// //die($dn);
		// if(isset($username)){
		// if (@ldap_bind($ds, $dn, $password)) {
		//   echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
		// } else {
		
		//  echo "Login Failed: Please check your username or password";
		// }
		// }
			
 

		}
		else{
		return view('login\login_view');
		}
		
		
	}

	function logout()
		{
			if(session()->has('loggedUserName'))
			{ 
				session()->remove('loggedUserName');
				return redirect()->to(base_url().'/Login/index?access=out')->with('fail','Sesion Cerrada con éxito');
			} 
		}

	//--------------------------------------------------------------------

}