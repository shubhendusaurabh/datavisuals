<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_Parent_id extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up() {
		$fields = array(
			'parent_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'default' => 0
			)
		);
		$this->dbforge->add_column('pages', $fields);
	}

	public function down() {
		$this->dbforge->drop_column('pages', 'parent_id');
	}

}

/* End of file 003_parent_id.php */
/* Location: ./application/migrations/003_parent_id.php */