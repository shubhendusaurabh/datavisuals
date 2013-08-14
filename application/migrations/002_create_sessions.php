<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Migration_Create_sessions extends CI_Migration {
	
		public function __construct()
		{
			$this->load->dbforge();
			$this->load->database();
		}
	
		public function up() {
			$fields = array(
				'session_id VARCHAR(40) Default \'0\' NOT NULL ',
				'ip_address VARCHAR(45) Default \'0\' NOT NULL',
				'user_agent VARCHAR(120) NOT NULL',
				'last_activity INT(10) unsigned DEFAULT 0 NOT NULL',
				'user_data text NOT NULL'
			);

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('session_id');
			$this->dbforge->create_table('ci_sessions');
			$this->db->query('ALTER TABLE `ci_sessions` ADD KEY `last_activity_idx` (`last_activity`) ');
			
		}
	
		public function down() {
			$this->dbforge->drop_table('ci_sessions');
		}
	
	}
	
	/* End of file 002_create_sessions.php */
	/* Location: ./application/migrations/002_create_sessions.php */