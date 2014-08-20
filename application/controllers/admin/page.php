<?php

	class Page extends Admin_Controller{
		
		protected $_table = 'pages';
		
		public function __construct(){
			parent::__construct();
		}

		public function index()
		{
			# code...
			$this->data['pages'] = $this->page->get_with_parent();
		}

		public function edit($id= null)
		{
			$this->load->library('form_validation');
			# code...
			if ($id) {
				$this->data['page'] = $this->page->get($id);\
				count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
			} else {
				$this->data['page'] = $this->page->get_new();
			}

			$rules = $this->page->rules;

			$this->data['pages_no_parent'] = $this->page->get_no_parents();

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				$data = $this->page->array_from_post(array('title', 'slug', 'body', 'parent_id', 'template', 'order'));
				if ( $id ) {
					$this->page->update($id, $data);
				} else {
					$this->page->insert($data);
				}
				redirect('admin/page');
			}
		}

		public function order(){
			$this->data['sortable'] = true;
			
			
		}

		public function order_ajax(){
			$this->view = FALSE;

			if (isset($_POST['sortable'])) {
				$this->page->save_order($_POST['sortable']);
			}

			$pages = $this->page->get_nested();
			echo get_ol($pages);
			//XXX:: Refactor Here
			echo "<script>
					$(function(){
					
						$('.sortable').nestedSortable({
							handle: 'div',
							items: 'li',
							toleranceElement: '> div',
							maxLevels: 2
						});
					})
				 </script>";
		}

		public function delete($id)
		{
			$this->page->delete($id);
			redirect('admin/page');
		}

		public function _unique_slug($str)
		{
			$page = null;
			$id = $this->uri->segment(4);
			$slug = $this->input->post('slug');
			if( ! $id ){
				$page = $this->page->get_by(array('slug'=> $slug ));
			}

			if (count($page)) {
				$this->form_validation->set_message('_unique_slug', '%s should be unique');
				return false;
			}
			return true;
		}



	}
