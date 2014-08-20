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

			//$this->data['header'] = 'Page';
			$slug = $this->uri->segment(1);
			if ( $slug ) {
				$this->data['page'] = $this->page->get_by(array('slug' => $slug));			
				count($this->data['page']) || show_404(current_url());
				$this->data['title'] = $this->data['page']->title . ' - ' . config_item('site_name');
			} else {
				$this->_news_archive();
			}
			
		}

		private function _news_archive(){
			$this->data['title'] = 'Index - ' . config_item('site_name');
			$this->data['header'] = 'All Visuals';
			$count = $this->visual_model->count_by('pubdate <= ', date('Y-m-d'));
			
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
			
			$this->data['visuals'] = $this->visual_model->limit($perpage, $offset)->order_by('pubdate', 'DESC')->get_all();
			$this->view = 'page/homepage';
			
		}
		
	}
	