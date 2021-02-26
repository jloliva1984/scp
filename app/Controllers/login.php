<?php namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;

class Login extends BaseController
{
	public function index()
	{
		$request = service('request');	
		
		if($request->getMethod()=="post")
		{
		// $username = "jorge.oliva";
		// $password = "Godblessourfate1.***";

		$username=$request->getPost('username');
		$password=$request->getPost('password');
		
		
		
		
		$ldapconfig['host'] = 'vzeus.sc.azcuba.cu';
		$ldapconfig['port'] = '389';
		$ldapconfig['basedn'] = 'dc=sc,dc=azcuba,dc=cu';
		$ldapconfig['usersdn'] = 'cn=ESISC';
		$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
		
		ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
		ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);
		
		$dn="cn=".$username.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
		die($dn);
		if(isset($username)){
		if (@ldap_bind($ds, $dn, $password)) {
		  echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
		} else {
		
		 echo "Login Failed: Please check your username or password";
		}
		}
			
      // Credenciales de prueba
	/*	$user = "userproxy";
		$pass = "123probando.";

		// Datos de acceso al servidor LDAP
		//$host = "172.28.2.20";
		$host = "vzeus.sc.azcuba.cu";
		$port = "389";

		// Conexto donde se encuentran los usuarios
		$basedn = "ou=Internet,dc=sc,dc=azcuba,dc=cu";
		

		// Atributos a recuperar
		$searchAttr = array("dn", "cn", "sn", "givenName");

		// Atributo para incorporar en la respuesta
		$displayAttr = "cn";

		// Respuesta por defecto
		$status = 1;
		$msg = "";
		$userDisplayName = "null";

		// Recuperar datos del POST
		if (isset($_POST['user'])) {
				$user = $_POST['user'];
		}
		if (isset($_POST['pass'])) {
				$pass = $_POST['pass'];
		}
       
		// Establecer la conexión con el servidor LDAP
		$ad = ldap_connect("ldap://{$host}:{$port}") or die("No se pudo conectar al servidor LDAP.");
		echo ("buscando a ".$user. " en ".$basedn);die;
		// Autenticar contra el servidor LDAP
		ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
		// $a=ldap_bind($ad);
        // die($a);
		// die("cn={$user},{$basedn}");
		if (@ldap_bind($ad, "cn={$user},{$basedn}", $pass)) {die("entro");
				// En caso de éxito, recuperar los datos del usuario
				$result = ldap_search($ad, $basedn, "(uid={$user})", $searchAttr);
				//var_dump($result);die;
				$entries = ldap_get_entries($ad, $result);
				if ($entries["count"]>0) {
						// Si hay resultados en la búsqueda
						$status = 0;
						if (isset($entries[0][$displayAttr])) {
								// Recuperar el atributo a incorporar en la respuesta
								$userDisplayName = $entries[0][$displayAttr][0];
								$msg = "Autenticado como {$userDisplayName}";
						}
						else {
								// Si el atributo no está definido para el usuario
								$userDisplayName = "-";
								$msg = "Atributo no disponible ({$displayAttr})";
						}
				}
				else {
						// Si no hay resultados en la búsqueda, retornar error
						$msg = "Error desconocido";
				}
		}
		else {
				// Si falla la autenticación, retornar error
				$msg = "Usuario y/o contraseña inválidos";
		}
     die($msg);
		// Respuesta en formato JSON
		header('Content-Type: application/json');
		echo "{\"uid\": \"{$user}\", \"estado\": \"{$status}\", \"nombre\": \"{$userDisplayName}\", \"debug\": \"{$msg}\"}";
	*/

		}
		else{
		return view('login_view');
	    }
	}

	//--------------------------------------------------------------------

}