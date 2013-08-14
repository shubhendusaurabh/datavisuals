<?php

	/**
	 * Model for page
	 */
	class User_model extends MY_Model {
		
		public $rules			= array(
			'email' => array(
				'field' 	=> 'email',
				'label'		=> 'Email',
				'rules' 	=> 'required|trim|valid_email|xss_clean'
			),
			'password' => array(
				'field' 	=> 'password',
				'label' 	=> 'Password',
				'rules' 	=> 'trim|required'
			)
		);

		public $rules_admin	= array(
			'name' => array(
				'field' 	=> 'name',
				'label'		=> 'Name',
				'rules' 	=> 'required|trim|xss_clean'
			),
			'email' => array(
				'field' 	=> 'email',
				'label'		=> 'Email',
				'rules' 	=> 'required|trim|valid_email|callback__unique_email|xss_clean'
			),
			'password' => array(
				'field' 	=> 'password',
				'label' 	=> 'Password',
				'rules' 	=> 'trim'
			),
			'password_confirm' => array(
				'field' 	=> 'password_confirm',
				'label' 	=> 'Confirm Password',
				'rules' 	=> 'trim|matches[password]'
			)
		);
		
		function __construct() {
			parent::__construct();
		}

		public function login(){
			$email = $this->input->post('email');
			$password = $this->hash($this->input->post('password'));
			$array = array('email' => $email, 'password' => $password);
			$user = $this->get_by($array);

			if (count($user)) {
				# code...
				$data = array(
					'name' => $user->name,
					'email' => $user->email,
					'id'	=> $user->id,
					'loggedin' => true
				);
				
				$this->session->set_userdata( $data );
			}
		}

		public function loggedin(){
			return (bool) $this->session->userdata('loggedin');
		}

		public function logout(){
			$this->session->sess_destroy();
		}

		public function hash($string){
			return hash('sha1', $string );
		}

		public function get_new()
		{
			# code...
			$user = new stdClass();
			$user->name = '';
			$user->email = '';
			$user->password = '';
			return $user;
		}

		public function array_from_post($fields)
		{
			# code...
			$data = array();
			foreach ($fields as $field) {
				# code...
				$data[$field] = $this->input->post($field);
			}
			return $data;
		}
	}
	