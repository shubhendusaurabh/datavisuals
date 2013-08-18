<?php
    /**
     * 
     */
    class Admin_Controller extends MY_Controller {
        
		public $menu = array(
			'page' => 'Pages',
			'user' => 'Users',
			'page/order' => 'Order Pages',
			'visual' => 'Visuals',
		);
		
        function __construct() {
            parent::__construct();
			$this->data['title'] = config_item('site_name');
			$this->data['menu'] = admin_menu($this->menu);			
			$this->load->model('user_model');
			$this->data['header'] = 'Admin - ' . ucwords(get_class($this));
			$this->data['public'] = FALSE;
            $exception_urls = array('admin/user/login', 'admin/user/logout' );
            if (in_array(uri_string(), $exception_urls) == false) {
                # code...
                if ($this->user_model->loggedin() == false) {
                    # code...
                    redirect('admin/user/login');
                }
            }
			if ($this->user_model->loggedin()) {
				$id = $this->session->userdata('id');
				$this->data['curr_user'] = $this->user_model->get($id, TRUE);
			}
			
        }
		
    }
    