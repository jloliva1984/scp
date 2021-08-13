<?php namespace App\Libraries;

class ViewComponents
{
	
	public function getHeader()
	{
		return view('layouts/header');
	}

	public function getFooter()
	{
		return view('layouts/footer');
	}
	public function getMenu()
	{
		return view('admin_template/menu_navegacion');
	}
}