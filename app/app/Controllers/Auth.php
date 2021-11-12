<?php

namespace App\Controllers;


class Auth extends BaseController
{
	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{
		if ($this->session->get('logged_in') == TRUE) {
			return redirect()->to('/menu');
		}

		helper(['form', 'url']);

		$this->validation->setRule('username', 'Username', 'required');
		$this->validation->setRule('password', 'Password', 'required');

		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$data = [
			'username'  => $username,
			'password'  => $password
		];

		$data2 =
			[
				'username'  => 'menu',
				'password'  => '$2b$10$.61V1N2eeV4.pRdiadI1JeQTxCcJjUERxXTDWCVVphxAeYbJKQ6ZC'
			];

		if ($this->validation->run($data)) {

			if ($data['username'] == $data2['username']) {

				$pass = $data2['password'];
				$verify_pass = password_verify($password, $pass);
				if ($verify_pass) {
					$ses_data = [
						'username'  => $data['username'],
						'logged_in' => TRUE
					];
					$this->session->set($ses_data);
					return redirect()->to('/menu');
				} else {
					$this->data['errors'] = 'Password Tidak Sesuai';
					return view('login', $this->data);
				}
			} else {
				$this->data['errors'] = 'Username Tidak Sesuai';
				return view('login', $this->data);
			}
		} else {
			// false case
			return view('login');
		}
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/');
	}
}
