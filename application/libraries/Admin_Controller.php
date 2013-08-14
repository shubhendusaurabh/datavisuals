<?php
    /**
     * 
     */
    class Admin_Controller extends MY_Controller {
        
        function __construct() {
            parent::__construct();
			$this->data['title'] = config_item('site_name');			
			$this->load->model('user_model');

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
    