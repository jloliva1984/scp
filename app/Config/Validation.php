<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	public $usuarios = [
		'usuario'          => 'required|min_length[4]|is_unique[usuarios.user]',
	    'password '        => 'required|min_length[5]',
	    'verify_password'  => 'required|min_length[5]|matches[password]',
	    'rol'              => 'required',
	];

	
	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
