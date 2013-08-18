<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_filename extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up() {
		$fields = array(
			'filename' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			)
		);

		$this->dbforge->add_column('visuals', $fields);
	}

	public function down() {
		$this->dbforge->drop_column('visuals', 'filename');
	}

}

/* End of file 006_add_templates_to_pages.php */
/* Location: ./application/migrations/006_add_templates_to_pages.php */