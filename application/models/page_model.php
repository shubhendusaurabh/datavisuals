<?php
/**
 *
 */
class Page_model extends MY_Model {

	protected $_order_by 	= 'parent_id, order';
	public $rules			= array(
		'parent_id' => array(
			'field' 	=> 'parent_id',
			'label'		=> 'Parent',
			'rules' 	=> 'trim|intval'
		),
		'order' => array(
			'field' 	=> 'order',
			'label'		=> 'Order',
			'rules' 	=> 'trim|intval'
		),
		'template' => array(
			'field' 	=> 'template',
			'label'		=> 'Template',
			'rules' 	=> 'required|trim|xss_clean'
		),
		'title' => array(
			'field' 	=> 'title',
			'label'		=> 'Title',
			'rules' 	=> 'required|trim|max_length[100]|xss_clean'
		),
		'slug' => array(
			'field' 	=> 'slug',
			'label'		=> 'Slug',
			'rules' 	=> 'required|trim|max_length[100]|url_title|callback__unique_slug|xss_clean'
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
		$page = new stdClass();
		$page->title = '';
		$page->slug = '';
		$page->body = '';
		$page->parent_id = 0;
		$page->order = 5;
		$page->template = 'page';
		return $page;
	}

	public function delete($id)
	{
		parent::delete($id);

		$this->db->set(array('parent_id' => 0))->where('parent_id', $id)->update($this->_table);
	}

	public function get_no_parents()
	{
		$pages = parent::get_many_by('parent_id', 0);

		$array = array(0 => 'No Parent');
		if (count($pages)) {
			foreach ($pages as $page) {
				$array[$page->id] = $page->title;
			}
		}
		return $array;
	}

	public function get_with_parent($id = null, $single = false){
		$this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
		$this->db->join('pages as p', 'pages.parent_id=p.id', 'left');
		if ( $id ) {
			return parent::get($id);
		} else {
			return parent::get_all();
		}
		
	}

	public function get_nested()
	{
		$this->db->order_by($this->_order_by);
		$pages = $this->db->get('pages')->result_array();

		$array = array();
		foreach ($pages as $page) {
			if (!$page['parent_id']) {
				$array[$page['id']] = $page;
			} else {
				$array[$page['parent_id']]['children'][] = $page;
			}
		}
		return $array;
	}

	public function save_order($pages){
		if (count($pages)) {
			foreach ($pages as $order => $page) {
			
				if ($page['item_id'] != '') {
					$id = $page['item_id'];
					$data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
					//$this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
					$this->update($id, $data);
				}
			}
		}
	}

	public function get_archive_link(){
		$page = parent::get_by(array('template' => 'news_archive'), true);
		return isset($page->slug) ? $page->slug : '';
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
