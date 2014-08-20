<?php

	class User extends Admin_Controller{
		
		
		public function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
			$this->data['title'] = 'Welcome User';
		}

		public function index()
		{
			$this->data['users'] = $this->user->get_all();
			
		}

		public function edit($id= null)
		{
			# code...
			if ($id) {
				$this->data['user'] = $this->user->get($id);
				count($this->data['user']) || $this->data['errors'][] = 'User could not be found';
			} else {
				$this->data['user'] = $this->user->get_new();
			}
//XXX: Not working for editing existing users
			$rules = $this->user->rules_admin;
			$id || $rules['password']['rules'] .= '|required';
			
			$this->form_validation->set_rules($rules);
			
			if ($this->form_validation->run() == TRUE) {
				$data = $this->user->array_from_post(array('name', 'email', 'password'));
				$data['password'] = $this->user->hash($data['password']);
				if ( $id ) {
					$this->user->update($id, $data);
				} else {
					$this->user->insert($data);
				}
				redirect('admin/user');
			}
		}

		public function delete($id)
		{
			$this->user->delete($id);
			redirect('admin/user');
		}
		
		public function login(){

			$dashboard = 'admin/user';
			$this->user->loggedin() == false || redirect($dashboard);

			$rules = $this->user->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				// we can login
				if ($this->user->login() == true) {
					# code...
					redirect($dashboard);
				} else {
					$this->session->set_flashdata('error', 'The email/password combination is not valid!');
					redirect('admin/user/login', 'refresh');
				}
			}
		}

		public function logout()
		{
			# code...
			$this->user->logout();
			redirect('admin/user/login');
		}

		public function _unique_email($str)
		{
			# code...
			$id = $this->uri->segment(4);
			$email = $this->input->post('email');
			if( ! $id ){
				$user = $this->user->get_by(array('email', $email));
			}

			if (count($user)) {
				# code...
				$this->form_validation->set_message('_unique_email', '%s should be unique');
				return false;
			}
			return true;
		}



	}
