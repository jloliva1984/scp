<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\RolesModel;

class CheckIfLoggedFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //  $url=current_url(); //devuelve la url actual
        //  die($url.' desde filtro');
        //dd(session()->get('loggedUser'));
        if(!session()->has('loggedUserName'))
        {
            return redirect()->to(base_url().'/login/index')->with('fail','Debe estar auntenticado en el sistema.');
        }
        else //if(session()->has('loggedUser'))
        {
            helper('array');
           // $url=current_url(); //devuelve la url actual
            $url='/'.uri_string();//devuelve la url despues del base_url ej 
            //dd($url);
            $alloweActions= new RolesModel();
            $alloweActions=  $alloweActions->GetAllowedActionsPerUserRol(session()->get('loggedUser'));
            //dd($alloweActions);
            $resultado = array_search($url, array_column( $alloweActions, 'url'));//devuelve false si no encuentra ,el indice numerico si encuentra
            //dd($resultado);
            if($resultado===false)
            { //dd('no tiene privilegios para realizar esta accion');
                return redirect()->to(base_url().'/login/index')->with('fail','Ud. no tiene privilegios para realizar esta acción');    
            }
            else
            {

            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}