<?php namespace App\Controllers;
use Illuminate\Cookie\CookieJar;
class Home extends BaseController
{
	public function __construct()
	{
		helper(['url','form','form_validation']);
		
	}
	public function index()
	{
		return view('admin_template/inicio');
	}

	//--------------------------------------------------------------------

}
