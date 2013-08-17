<?php
    /**
     * 
     */
    class Frontend_Controller extends MY_Controller {
        
        function __construct() {
            parent::__construct();

            $this->load->model('page_model');

            $this->data['menu'] = get_menu($this->page_model->get_nested());
			$this->data['header'] = ucwords(get_class($this));
            $this->data['news_archive_link'] = $this->page_model->get_archive_link();
            $this->data['meta_title'] = config_item('site_name');
             	
        }

        public function index(){

        }
    }