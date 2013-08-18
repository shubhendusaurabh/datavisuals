<?php

/**
* visual
*/
class Visual extends Frontend_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->data['recent_news'] = $this->visual->get_recent();
		$this->data['title'] = 'Data Visualization';
		
	}

	public function index($id, $slug){
		$this->db->where('pubdate <=', date('Y-m-d'));
		$this->data['visual'] = $this->visual->get($id);
		
		count($this->data['visual']) || show_404(uri_string());
		$this->data['title'] = 'Data Visualization - ' . $this->data['visual']->title;
		$requested_slug = $this->uri->segment(3);
		$set_slug = $this->data['visual']->slug;
		
		if ($requested_slug != $set_slug) {
			redirect('visual/' . $this->data['visual']->id . '/' . $this->data['visual']->slug);
			
		}
		
	
	}

}