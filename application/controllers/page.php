<?php

	/**
	 * 
	 */
	class Page extends Frontend_Controller {
		
		function __construct() {
			parent::__construct();
			$this->load->model('visual_model');
			$this->data['recent_news'] = $this->visual_model->get_recent();
		}
		
		public function index($offset = null){

			$this->data['title'] = 'Index';
			$slug = $this->uri->segment(1);
			if ( $slug ) {
				$this->data['page'] = $this->page->get_by(array('slug' => $slug));			
				count($this->data['page']) || show_404(current_url());
			} else {
				$this->_news_archive();
			}
			

			
			
		}

		private function _news_archive(){
			
			$this->db->where('pubdate <= ', date('Y-m-d'));
			$count = $this->visual_model->count_all();
			
			$perpage = 4;
			if ($count >= $perpage) {

				$this->load->library('pagination');
				//FIXME:: pagination uri
				$config['base_url'] = site_url($this->uri->segment(1,0) . '/');
				$config['total_rows'] = $count;
				$config['per_page'] = $perpage;
				$config['uri_segment'] = 2;

				$this->pagination->initialize($config); 

				$this->data['pagination'] = $this->pagination->create_links();
				$offset = $this->uri->segment(2);
			} else {
				$this->data['pagination'] = '';
				$offset = 0;
			}
		
			$this->db->where('pubdate <= ', date('Y-m-d'));
			
			$this->data['visuals'] = $this->visual_model->limit($perpage, $offset)->get_all();
			$this->view = 'page/homepage';
			
			$this->data['header'] = 'Index';
		}
		
	}
	