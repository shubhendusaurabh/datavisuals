<?php

	class Visual extends Admin_Controller{
		
		
		public function __construct(){
			parent::__construct();
			$this->data['title'] = 'Create or Edit Articles';
		}

		public function index()
		{
			# code...
			$this->data['visuals'] = $this->visual->get_all();
		}

		public function edit($id= null)
		{
			$this->load->library('form_validation');
			# code...
			if ($id) {
				$this->data['visual'] = $this->visual->get($id);
				count($this->data['visual']) || $this->data['errors'][] = 'visual could not be found';
			} else {
				$this->data['visual'] = $this->visual->get_new();
			}

			$rules = $this->visual->rules;

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				$data = $this->visual->array_from_post(array('title', 'slug', 'body', 'pubdate'));
				if ( $id ) {
					$data['modified'] = date('Y-m-d H:i:s');
					$this->visual->update($id, $data);
				} else {
					$data['modified'] = $data['created'] = date('Y-m-d H:i:s');
					$this->visual->insert($data);
				}
				redirect('admin/visual');
			}

		}


		public function delete($id)
		{
			$this->visual->delete($id);
			redirect('admin/visual');
		}



	}
