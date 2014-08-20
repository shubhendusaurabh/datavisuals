<?php
/**
 *
 */
class Visual_model extends MY_Model {

	protected $_order_by 	= 'pubdate desc, id desc';
	protected $_timestamps	= true;

	public $rules			= array(
		'pubdate' => array(
			'field' 	=> 'pubdate',
			'label'		=> 'Publication Date',
			'rules' 	=> 'trim|required|exact_length[10]|xss_clean'
		),
		'title' => array(
			'field' 	=> 'title',
			'label'		=> 'Title',
			'rules' 	=> 'required|trim|max_length[100]|xss_clean'
		),
		'slug' => array(
			'field' 	=> 'slug',
			'label'		=> 'Slug',
			'rules' 	=> 'required|trim|max_length[100]|xss_clean'
		),
		'filename' => array(
			'field' 	=> 'filename',
			'label'		=> 'Filename',
			'rules' 	=> 'required|trim|xss_clean'
		),
		'library' => array(
			'field' 	=> 'library',
			'label'		=> 'Library',
			'rules' 	=> 'required|trim|xss_clean'
		),
		'body' => array(
			'field' 	=> 'body',
			'label'		=> 'Body',
			'rules' 	=> 'required|trim'
		)
	);
	

	function __construct() {
		parent::__construct();
	}

	public function get_new()
	{
		# code...
		$visual = new stdClass();
		$visual->title = '';
		$visual->slug = '';
		$visual->filename = '';
		$visual->library = '';
		$visual->body = '';
		$visual->pubdate = date('Y-m-d');
		return $visual;
	}

	public function set_published(){
		//TODO Replace all instances of pubdate
		$this->db->where('pubdate <= ', date('Y-m-d'));
	}

	public function get_recent($limit = 3){
		$limit = (int)$limit;
		$this->set_published();
		$this->db->order_by('pubdate', 'desc');
		$this->db->limit($limit);
		return parent::get_all();
	}
	
	public function get_comments($id = null){
		$this->db->where('for', 'visual');
		return $this->db->get_where('postID', $id);
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
