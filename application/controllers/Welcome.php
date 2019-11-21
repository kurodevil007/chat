<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo 'Under Maintenance!';
		// return $this->load->view('webchat');
		// var_dump($this);
		// echo base64_decode('N3hEcSJCCZhkNdesoi3ijwNOoW+sL+hbgao4IqfkX9U9QhdcSysTOlppocSQEo+BgLI=');
		// $a = $this->encryption->create_key(32);
		// $b = bin2hex($a);
		// echo 'Key : ' . $a;
		// echo '<br>';
		// echo 'Hex : ' . $b;
	}
}
