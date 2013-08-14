<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_templates extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up() {
		$fields = array(
			'template' => array(
				'type' => 'VARCHAR',
				'constraint' => 25
			)
		);

		$this->dbforge->add_column('pages', $fields);
	}

	public function down() {
		$this->dbforge->drop_column('pages', 'template');
	}

}

/* End of file 006_add_templates_to_pages.php */
/* Location: ./application/migrations/006_add_templates_to_pages.php */